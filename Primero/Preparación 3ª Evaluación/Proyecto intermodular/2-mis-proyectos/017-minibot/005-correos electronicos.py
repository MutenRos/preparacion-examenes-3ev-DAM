import requests
import sqlite3
import time
import sys
import re
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse, urlunparse
from collections import deque

DEFAULT_START_URL = "https://josevicentecarratala.com"
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
            title TEXT,
            emails TEXT
        )
    """)
    conn.commit()

    # Intentar añadir la columna emails si la tabla ya existía sin ella
    try:
        cur.execute("ALTER TABLE pages ADD COLUMN emails TEXT")
        conn.commit()
    except sqlite3.OperationalError:
        pass

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

    if path != "/" and path.endswith("/"):
        path = path[:-1]

    normalized = urlunparse((
        scheme,
        netloc,
        path,
        parsed.params,
        parsed.query,
        ""
    ))
    return normalized


def is_valid_http_url(url):
    parsed = urlparse(url)
    return parsed.scheme in ("http", "https")


def is_same_domain(url, base_domain):
    return urlparse(url).netloc.lower() == base_domain.lower()


def save_page(conn, url, title, emails):
    cur = conn.cursor()
    cur.execute("""
        INSERT INTO pages (url, title, emails)
        VALUES (?, ?, ?)
        ON CONFLICT(url) DO UPDATE SET
            title = excluded.title,
            emails = excluded.emails
    """, (url, title, emails))
    conn.commit()


def extract_title(soup):
    if soup.title and soup.title.string:
        return soup.title.string.strip()
    return ""


def extract_emails(html):
    """
    Extract emails from:
    - visible HTML text
    - mailto: links
    Returns a sorted, deduplicated comma-separated string
    """
    emails = set()

    # Emails in visible/raw html
    pattern = r'[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}'
    for match in re.findall(pattern, html, flags=re.IGNORECASE):
        emails.add(match.lower())

    # Emails from mailto:
    soup = BeautifulSoup(html, "html.parser")
    for a in soup.find_all("a", href=True):
        href = a["href"].strip()
        if href.lower().startswith("mailto:"):
            mail = href[7:].split("?")[0].strip()
            if mail:
                emails.add(mail.lower())

    return ", ".join(sorted(emails))


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
    queued = set([start_url])
    queue = deque([start_url])

    while queue:
        current_url = queue.popleft()

        if current_url in visited:
            continue

        print(f"Crawling: {current_url}")
        visited.add(current_url)

        try:
            response = session.get(
                current_url,
                timeout=REQUEST_TIMEOUT,
                allow_redirects=True
            )
            time.sleep(DELAY_SECONDS)

            content_type = response.headers.get("Content-Type", "").lower()
            if "text/html" not in content_type:
                print("  Skipped (not HTML)")
                continue

            final_url = normalize_url(response.url)

            if final_url in visited and final_url != current_url:
                print("  Skipped (redirected duplicate)")
                continue

            html = response.text
            soup = BeautifulSoup(html, "html.parser")
            title = extract_title(soup)
            emails = extract_emails(html)

            save_page(conn, final_url, title, emails)

            print(f"  Title: {title}")
            print(f"  Emails: {emails if emails else '(none)'}")

            links = get_links(html, final_url, base_domain)

            for link in links:
                if link not in visited and link not in queued:
                    queue.append(link)
                    queued.add(link)

        except requests.RequestException as e:
            print(f"  Error: {e}")

    conn.close()
    print(f"\nDone. Data saved in {DB_FILE}")


if __name__ == "__main__":
    start_url = DEFAULT_START_URL

    if len(sys.argv) > 1:
        start_url = sys.argv[1].strip()

    if not is_valid_http_url(start_url):
        print("Error: please provide a valid URL starting with http:// or https://")
        sys.exit(1)

    crawl(start_url)
