import requests
import sqlite3
import time
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse, urlunparse
from collections import deque

START_URL = "https://josevicentecarratala.com"
DB_FILE = "crawler.sqlite"
DELAY_SECONDS = 1
REQUEST_TIMEOUT = 15

session = requests.Session()
session.headers.update({
    "User-Agent": "Mozilla/5.0 (compatible; SimpleRecursiveCrawler/1.0)"
})


def init_db():
    conn = sqlite3.connect(DB_FILE)
    cur = conn.cursor()
    cur.execute("""
        CREATE TABLE IF NOT EXISTS pages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            url TEXT UNIQUE,
            title TEXT
        )
    """)
    conn.commit()
    return conn


def normalize_url(url):
    """
    Normalize URL to reduce duplicates:
    - remove fragment
    - lowercase scheme and domain
    - remove trailing slash except root
    - keep query string
    """
    parsed = urlparse(url)

    scheme = parsed.scheme.lower()
    netloc = parsed.netloc.lower()
    path = parsed.path or "/"

    # remove duplicate trailing slash unless root
    if path != "/" and path.endswith("/"):
        path = path[:-1]

    normalized = urlunparse((
        scheme,
        netloc,
        path,
        parsed.params,
        parsed.query,
        ""  # fragment removed
    ))
    return normalized


def is_valid_http_url(url):
    parsed = urlparse(url)
    return parsed.scheme in ("http", "https")


def is_same_domain(url, base_domain):
    return urlparse(url).netloc.lower() == base_domain.lower()


def save_page(conn, url, title):
    cur = conn.cursor()
    cur.execute("""
        INSERT OR IGNORE INTO pages (url, title)
        VALUES (?, ?)
    """, (url, title))
    conn.commit()


def extract_title(soup):
    if soup.title and soup.title.string:
        return soup.title.string.strip()
    return ""


def get_links(html, current_url, base_domain):
    soup = BeautifulSoup(html, "html.parser")
    found_links = []

    for a in soup.find_all("a", href=True):
        href = a["href"].strip()

        if not href:
            continue
        if href.startswith("#"):
            continue
        if href.startswith("mailto:"):
            continue
        if href.startswith("tel:"):
            continue
        if href.startswith("javascript:"):
            continue

        full_url = urljoin(current_url, href)
        full_url = normalize_url(full_url)

        if not is_valid_http_url(full_url):
            continue

        if not is_same_domain(full_url, base_domain):
            continue

        found_links.append(full_url)

    return found_links


def crawl(start_url):
    start_url = normalize_url(start_url)
    base_domain = urlparse(start_url).netloc.lower()

    conn = init_db()

    visited = set()
    queue = deque([start_url])

    while queue:
        current_url = queue.popleft()

        if current_url in visited:
            continue

        print(f"Crawling: {current_url}")
        visited.add(current_url)

        try:
            response = session.get(current_url, timeout=REQUEST_TIMEOUT, allow_redirects=True)
            time.sleep(DELAY_SECONDS)

            content_type = response.headers.get("Content-Type", "").lower()
            if "text/html" not in content_type:
                print("  Skipped (not HTML)")
                continue

            final_url = normalize_url(response.url)

            # if redirected to an already visited page, avoid reprocessing
            if final_url in visited and final_url != current_url:
                print("  Skipped (redirected duplicate)")
                continue

            html = response.text
            soup = BeautifulSoup(html, "html.parser")
            title = extract_title(soup)

            save_page(conn, final_url, title)
            print(f"  Title: {title}")

            links = get_links(html, final_url, base_domain)

            for link in links:
                if link not in visited:
                    queue.append(link)

        except requests.RequestException as e:
            print(f"  Error: {e}")

    conn.close()
    print(f"\nDone. Data saved in {DB_FILE}")


if __name__ == "__main__":
    crawl(START_URL)
