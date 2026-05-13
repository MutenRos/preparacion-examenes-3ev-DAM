import fitz  # pip install pymupdf


def pdf_to_structured_txt(input_pdf, output_txt):
    doc = fitz.open(input_pdf)

    with open(output_txt, "w", encoding="utf-8") as f:
        for page_number, page in enumerate(doc, start=1):
            f.write(f"\n\n=== PAGE {page_number} ===\n\n")

            data = page.get_text("dict")

            for block in data["blocks"]:
                if block["type"] != 0:
                    continue

                paragraph_lines = []

                for line in block["lines"]:
                    line_text = ""

                    for span in line["spans"]:
                        line_text += span["text"]

                    line_text = line_text.strip()

                    if line_text:
                        paragraph_lines.append(line_text)

                if paragraph_lines:
                    paragraph = " ".join(paragraph_lines)
                    f.write(paragraph)
                    f.write("\n\n")


pdf_to_structured_txt("manual mysql.pdf", "manual mysql.txt")
