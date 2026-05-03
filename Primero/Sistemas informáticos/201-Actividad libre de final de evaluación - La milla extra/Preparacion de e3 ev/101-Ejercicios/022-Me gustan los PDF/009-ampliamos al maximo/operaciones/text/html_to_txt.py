<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>jocarsa-conversion</title>

<style>
body {
    font-family: Ubuntu, Arial, sans-serif;
    background: #0f172a;
    color: #e2e8f0;
    margin: 0;
}

header {
    padding: 20px;
    background: #1e293b;
    text-align: center;
}

h1 {
    margin: 0;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    padding: 20px;
}

.card {
    background: #1e293b;
    border-radius: 12px;
    padding: 20px;
    text-decoration: none;
    color: #e2e8f0;
    transition: 0.2s;
}

.card:hover {
    background: #334155;
}

.icon {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.pill {
    background: #4f46e5;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 12px;
}

.arrow {
    margin: 0 6px;
    color: #f97316;
}

.title {
    font-weight: bold;
    text-align: center;
}
</style>
</head>

<body>

<header>
    <h1>jocarsa-conversion</h1>
</header>

<div class="grid">

<a class="card" href="action.php?a=images_resize">
    <div class="icon"><span class="pill">IMG</span><span class="arrow">→</span><span class="pill">IMG</span></div>
    <div class="title">Resize Images</div>
</a>

<a class="card" href="action.php?a=images_to_pdf">
    <div class="icon"><span class="pill">IMG</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">Images to PDF</div>
</a>

<a class="card" href="action.php?a=jpg_to_png">
    <div class="icon"><span class="pill">JPG</span><span class="arrow">→</span><span class="pill">PNG</span></div>
    <div class="title">JPG to PNG</div>
</a>

<a class="card" href="action.php?a=png_to_jpg">
    <div class="icon"><span class="pill">PNG</span><span class="arrow">→</span><span class="pill">JPG</span></div>
    <div class="title">PNG to JPG</div>
</a>

<a class="card" href="action.php?a=webp_to_png">
    <div class="icon"><span class="pill">WEBP</span><span class="arrow">→</span><span class="pill">PNG</span></div>
    <div class="title">WEBP to PNG</div>
</a>

<a class="card" href="action.php?a=docx_to_pdf">
    <div class="icon"><span class="pill">DOCX</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">DOCX to PDF</div>
</a>

<a class="card" href="action.php?a=docx_to_txt">
    <div class="icon"><span class="pill">DOCX</span><span class="arrow">→</span><span class="pill">TXT</span></div>
    <div class="title">DOCX to TXT</div>
</a>

<a class="card" href="action.php?a=txt_to_docx">
    <div class="icon"><span class="pill">TXT</span><span class="arrow">→</span><span class="pill">DOCX</span></div>
    <div class="title">TXT to DOCX</div>
</a>

<a class="card" href="action.php?a=xlsx_to_csv">
    <div class="icon"><span class="pill">XLSX</span><span class="arrow">→</span><span class="pill">CSV</span></div>
    <div class="title">XLSX to CSV</div>
</a>

<a class="card" href="action.php?a=extract_images_from_pdf">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">IMG</span></div>
    <div class="title">Extract Images</div>
</a>

<a class="card" href="action.php?a=extract_pages_pdf">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">Extract Pages</div>
</a>

<a class="card" href="action.php?a=join_pdf">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">Join PDFs</div>
</a>

<a class="card" href="action.php?a=pdf_to_jpg">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">JPG</span></div>
    <div class="title">PDF to JPG</div>
</a>

<a class="card" href="action.php?a=pdf_to_png">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">PNG</span></div>
    <div class="title">PDF to PNG</div>
</a>

<a class="card" href="action.php?a=pdf_to_text">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">TXT</span></div>
    <div class="title">PDF to TXT</div>
</a>

<a class="card" href="action.php?a=remove_pages_pdf">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">Remove Pages</div>
</a>

<a class="card" href="action.php?a=reverse_pdf">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">Reverse PDF</div>
</a>

<a class="card" href="action.php?a=rotate_pdf">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">Rotate PDF</div>
</a>

<a class="card" href="action.php?a=split_pdf">
    <div class="icon"><span class="pill">PDF</span><span class="arrow">→</span><span class="pill">PDF</span></div>
    <div class="title">Split PDF</div>
</a>

<a class="card" href="action.php?a=csv_to_json">
    <div class="icon"><span class="pill">CSV</span><span class="arrow">→</span><span class="pill">JSON</span></div>
    <div class="title">CSV to JSON</div>
</a>

<a class="card" href="action.php?a=html_to_md">
    <div class="icon"><span class="pill">HTML</span><span class="arrow">→</span><span class="pill">MD</span></div>
    <div class="title">HTML to MD</div>
</a>

<a class="card" href="action.php?a=html_to_txt">
    <div class="icon"><span class="pill">HTML</span><span class="arrow">→</span><span class="pill">TXT</span></div>
    <div class="title">HTML to TXT</div>
</a>

<a class="card" href="action.php?a=json_to_csv">
    <div class="icon"><span class="pill">JSON</span><span class="arrow">→</span><span class="pill">CSV</span></div>
    <div class="title">JSON to CSV</div>
</a>

<a class="card" href="action.php?a=json_to_xml">
    <div class="icon"><span class="pill">JSON</span><span class="arrow">→</span><span class="pill">XML</span></div>
    <div class="title">JSON to XML</div>
</a>

<a class="card" href="action.php?a=md_to_html">
    <div class="icon"><span class="pill">MD</span><span class="arrow">→</span><span class="pill">HTML</span></div>
    <div class="title">MD to HTML</div>
</a>

<a class="card" href="action.php?a=txt_to_html">
    <div class="icon"><span class="pill">TXT</span><span class="arrow">→</span><span class="pill">HTML</span></div>
    <div class="title">TXT to HTML</div>
</a>

<a class="card" href="action.php?a=xml_to_json">
    <div class="icon"><span class="pill">XML</span><span class="arrow">→</span><span class="pill">JSON</span></div>
    <div class="title">XML to JSON</div>
</a>

</div>

</body>
</html>
