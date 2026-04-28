<?php
declare(strict_types=1);

/*
 * action.php
 *
 * Reusable operation form page.
 * Uses the common styles.css of the project.
 *
 * Usage:
 *   action.php?a=images_resize
 */

$action = isset($_GET['a']) ? trim((string)$_GET['a']) : '';

if ($action === '') {
    http_response_code(400);
    echo 'Missing action parameter.';
    exit;
}

$operations = [

    // IMAGE
    'images_resize' => [
        'title' => 'Resize Images',
        'description' => 'Resize one or many images, optionally preserving ratio and avoiding enlargement.',
        'accept' => '.jpg,.jpeg,.png,.webp,.bmp,.tiff,.tif',
        'multiple' => true,
        'icon_from' => 'IMG',
        'icon_to' => 'IMG',
        'fields' => [
            ['name' => 'width', 'label' => 'Width (px)', 'type' => 'number', 'placeholder' => 'e.g. 800'],
            ['name' => 'height', 'label' => 'Height (px)', 'type' => 'number', 'placeholder' => 'e.g. 600'],
            ['name' => 'keep_ratio', 'label' => 'Keep ratio', 'type' => 'checkbox', 'checked' => true],
            ['name' => 'no_enlarge', 'label' => 'Do not enlarge', 'type' => 'checkbox'],
        ],
    ],

    'images_to_pdf' => [
        'title' => 'Images to PDF',
        'description' => 'Build a PDF document from one or more images.',
        'accept' => '.jpg,.jpeg,.png,.webp,.bmp,.tiff,.tif',
        'multiple' => true,
        'icon_from' => 'IMG',
        'icon_to' => 'PDF',
        'fields' => [
            [
                'name' => 'page_mode',
                'label' => 'Page mode',
                'type' => 'select',
                'options' => [
                    'original' => 'Original size',
                    'a4' => 'A4 portrait',
                    'a4_auto' => 'A4 auto',
                ],
                'value' => 'original',
            ],
            ['name' => 'auto_rotate', 'label' => 'Auto rotate', 'type' => 'checkbox'],
        ],
    ],

    'jpg_to_png' => [
        'title' => 'JPG to PNG',
        'description' => 'Convert JPG or JPEG images into PNG files.',
        'accept' => '.jpg,.jpeg',
        'multiple' => true,
        'icon_from' => 'JPG',
        'icon_to' => 'PNG',
    ],

    'png_to_jpg' => [
        'title' => 'PNG to JPG',
        'description' => 'Convert PNG images into JPEG files with configurable quality.',
        'accept' => '.png',
        'multiple' => true,
        'icon_from' => 'PNG',
        'icon_to' => 'JPG',
        'fields' => [
            ['name' => 'quality', 'label' => 'Quality (1-100)', 'type' => 'number', 'value' => '95', 'min' => '1', 'max' => '100'],
        ],
    ],

    'webp_to_png' => [
        'title' => 'WEBP to PNG',
        'description' => 'Convert WEBP images into PNG files.',
        'accept' => '.webp',
        'multiple' => true,
        'icon_from' => 'WEBP',
        'icon_to' => 'PNG',
    ],

    // OFFICE
    'docx_to_pdf' => [
        'title' => 'DOCX to PDF',
        'description' => 'Convert Word documents into PDF format.',
        'accept' => '.docx',
        'multiple' => true,
        'icon_from' => 'DOCX',
        'icon_to' => 'PDF',
    ],

    'docx_to_txt' => [
        'title' => 'DOCX to TXT',
        'description' => 'Extract plain text from DOCX documents.',
        'accept' => '.docx',
        'multiple' => true,
        'icon_from' => 'DOCX',
        'icon_to' => 'TXT',
    ],

    'txt_to_docx' => [
        'title' => 'TXT to DOCX',
        'description' => 'Create DOCX files from plain text files.',
        'accept' => '.txt',
        'multiple' => true,
        'icon_from' => 'TXT',
        'icon_to' => 'DOCX',
    ],

    'xlsx_to_csv' => [
        'title' => 'XLSX to CSV',
        'description' => 'Export XLSX spreadsheet sheets into CSV files.',
        'accept' => '.xlsx',
        'multiple' => true,
        'icon_from' => 'XLSX',
        'icon_to' => 'CSV',
    ],

    // PDF
    'extract_images_from_pdf' => [
        'title' => 'Extract Images from PDF',
        'description' => 'Extract embedded images from uploaded PDF files.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'IMG',
    ],

    'extract_pages_pdf' => [
        'title' => 'Extract Pages',
        'description' => 'Keep only selected pages from a PDF.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'PDF',
        'fields' => [
            ['name' => 'pages', 'label' => 'Pages (e.g. 1-3,5)', 'type' => 'text', 'placeholder' => 'e.g. 1-3,5'],
        ],
    ],

    'join_pdf' => [
        'title' => 'Join PDFs',
        'description' => 'Merge several PDF files into one output PDF.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'PDF',
        'fields' => [
            ['name' => 'range', 'label' => 'Range (or all)', 'type' => 'text', 'value' => 'all', 'placeholder' => 'all or e.g. 1-3,5'],
        ],
    ],

    'pdf_to_jpg' => [
        'title' => 'PDF to JPG',
        'description' => 'Export PDF pages as JPG images.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'JPG',
        'fields' => [
            ['name' => 'dpi', 'label' => 'DPI', 'type' => 'number', 'value' => '200'],
            ['name' => 'quality', 'label' => 'Quality', 'type' => 'number', 'value' => '90', 'min' => '1', 'max' => '100'],
        ],
    ],

    'pdf_to_png' => [
        'title' => 'PDF to PNG',
        'description' => 'Export PDF pages as PNG images.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'PNG',
        'fields' => [
            ['name' => 'dpi', 'label' => 'DPI', 'type' => 'number', 'value' => '200'],
        ],
    ],

    'pdf_to_text' => [
        'title' => 'PDF to TXT',
        'description' => 'Extract readable text from PDF files.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'TXT',
    ],

    'remove_pages_pdf' => [
        'title' => 'Remove Pages',
        'description' => 'Delete selected pages from PDF files.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'PDF',
        'fields' => [
            ['name' => 'pages', 'label' => 'Pages to remove', 'type' => 'text', 'placeholder' => 'e.g. 2,4-6'],
        ],
    ],

    'reverse_pdf' => [
        'title' => 'Reverse PDF',
        'description' => 'Reverse the page order of PDF files.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'PDF',
    ],

    'rotate_pdf' => [
        'title' => 'Rotate PDF',
        'description' => 'Rotate all pages in a PDF.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'PDF',
        'fields' => [
            ['name' => 'angle', 'label' => 'Angle (90, 180, 270)', 'type' => 'number', 'value' => '90'],
        ],
    ],

    'split_pdf' => [
        'title' => 'Split PDF',
        'description' => 'Split a PDF into single pages or ranges.',
        'accept' => '.pdf',
        'multiple' => true,
        'icon_from' => 'PDF',
        'icon_to' => 'PDF',
        'fields' => [
            [
                'name' => 'mode',
                'label' => 'Mode',
                'type' => 'select',
                'options' => [
                    'pages' => 'Pages',
                    'ranges' => 'Ranges',
                ],
                'value' => 'pages',
            ],
            ['name' => 'ranges', 'label' => 'Ranges (if mode = ranges)', 'type' => 'text', 'placeholder' => 'e.g. 1-3,5,8-10'],
        ],
    ],

    // TEXT / DATA
    'csv_to_json' => [
        'title' => 'CSV to JSON',
        'description' => 'Convert CSV tabular data into JSON.',
        'accept' => '.csv',
        'multiple' => true,
        'icon_from' => 'CSV',
        'icon_to' => 'JSON',
    ],

    'html_to_md' => [
        'title' => 'HTML to MD',
        'description' => 'Convert HTML files into Markdown.',
        'accept' => '.html,.htm',
        'multiple' => true,
        'icon_from' => 'HTML',
        'icon_to' => 'MD',
    ],

    'html_to_txt' => [
        'title' => 'HTML to TXT',
        'description' => 'Extract plain text from HTML files.',
        'accept' => '.html,.htm',
        'multiple' => true,
        'icon_from' => 'HTML',
        'icon_to' => 'TXT',
    ],

    'json_to_csv' => [
        'title' => 'JSON to CSV',
        'description' => 'Convert JSON arrays of objects into CSV files.',
        'accept' => '.json',
        'multiple' => true,
        'icon_from' => 'JSON',
        'icon_to' => 'CSV',
    ],

    'json_to_xml' => [
        'title' => 'JSON to XML',
        'description' => 'Convert JSON data into XML.',
        'accept' => '.json',
        'multiple' => true,
        'icon_from' => 'JSON',
        'icon_to' => 'XML',
    ],

    'md_to_html' => [
        'title' => 'MD to HTML',
        'description' => 'Convert Markdown files into HTML.',
        'accept' => '.md',
        'multiple' => true,
        'icon_from' => 'MD',
        'icon_to' => 'HTML',
    ],

    'txt_to_html' => [
        'title' => 'TXT to HTML',
        'description' => 'Convert plain text files into HTML.',
        'accept' => '.txt',
        'multiple' => true,
        'icon_from' => 'TXT',
        'icon_to' => 'HTML',
    ],

    'xml_to_json' => [
        'title' => 'XML to JSON',
        'description' => 'Convert XML data into JSON.',
        'accept' => '.xml',
        'multiple' => true,
        'icon_from' => 'XML',
        'icon_to' => 'JSON',
    ],
];

if (!isset($operations[$action])) {
    http_response_code(404);
    echo 'Unknown action.';
    exit;
}

$op = $operations[$action];

$title       = $op['title'];
$description = $op['description'] ?? '';
$accept      = $op['accept'] ?? '';
$multiple    = $op['multiple'] ?? false;
$fields      = $op['fields'] ?? [];
$from        = $op['icon_from'] ?? 'IN';
$to          = $op['icon_to'] ?? 'OUT';

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($title) ?> · jocarsa-conversion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="topbar">
    <div class="topbar-inner">
        <div class="brand">
            <div class="brand-mark">jc</div>
            <div class="brand-text">
                <h1>jocarsa-conversion</h1>
                <p>Document format transformations</p>
            </div>
        </div>

        <div class="search-panel">
            <a href="index.html" class="button-like back-link">← Back to operations</a>
        </div>
    </div>
</header>

<main class="page">
    <section class="category-section">
        <div class="category-header">
            <div class="category-badge"><?= h($from) ?> → <?= h($to) ?></div>
            <h2><?= h($title) ?></h2>
        </div>

        <div class="card operation-form-card">
            <div class="icon operation-hero-icon">
                <span class="pill"><?= h($from) ?></span>
                <span class="arrow">→</span>
                <span class="pill"><?= h($to) ?></span>
            </div>

            <?php if ($description !== ''): ?>
                <p class="operation-description"><?= h($description) ?></p>
            <?php endif; ?>

            <form action="back.php" method="post" enctype="multipart/form-data" class="operation-form">
                <input type="hidden" name="action" value="<?= h($action) ?>">

                <div class="form-block">
                    <label for="files" class="form-label">Files</label>
                    <input
                        id="files"
                        class="search-input form-input"
                        type="file"
                        name="files[]"
                        accept="<?= h($accept) ?>"
                        <?= $multiple ? 'multiple' : '' ?>
                        required
                    >
                    <div class="form-help">
                        Accepted: <?= h($accept) ?><?= $multiple ? ' · Multiple files allowed' : '' ?>
                    </div>
                </div>

                <?php foreach ($fields as $field): ?>
                    <?php
                    $fieldName  = (string)$field['name'];
                    $fieldId    = 'field_' . preg_replace('/[^a-zA-Z0-9_-]+/', '_', $fieldName);
                    $fieldLabel = (string)($field['label'] ?? $fieldName);
                    $fieldType  = (string)($field['type'] ?? 'text');
                    $fieldValue = (string)($field['value'] ?? '');
                    $placeholder = (string)($field['placeholder'] ?? '');
                    $min = isset($field['min']) ? (string)$field['min'] : null;
                    $max = isset($field['max']) ? (string)$field['max'] : null;
                    ?>

                    <div class="form-block">
                        <?php if ($fieldType === 'checkbox'): ?>
                            <label class="checkbox-row" for="<?= h($fieldId) ?>">
                                <input
                                    id="<?= h($fieldId) ?>"
                                    type="checkbox"
                                    name="<?= h($fieldName) ?>"
                                    value="1"
                                    <?= !empty($field['checked']) ? 'checked' : '' ?>
                                >
                                <span><?= h($fieldLabel) ?></span>
                            </label>

                        <?php elseif ($fieldType === 'select'): ?>
                            <label for="<?= h($fieldId) ?>" class="form-label"><?= h($fieldLabel) ?></label>
                            <select
                                id="<?= h($fieldId) ?>"
                                name="<?= h($fieldName) ?>"
                                class="search-input form-input"
                            >
                                <?php foreach (($field['options'] ?? []) as $optionValue => $optionLabel): ?>
                                    <option value="<?= h((string)$optionValue) ?>" <?= ((string)$optionValue === $fieldValue) ? 'selected' : '' ?>>
                                        <?= h((string)$optionLabel) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        <?php else: ?>
                            <label for="<?= h($fieldId) ?>" class="form-label"><?= h($fieldLabel) ?></label>
                            <input
                                id="<?= h($fieldId) ?>"
                                class="search-input form-input"
                                type="<?= h($fieldType) ?>"
                                name="<?= h($fieldName) ?>"
                                value="<?= h($fieldValue) ?>"
                                placeholder="<?= h($placeholder) ?>"
                                <?= $min !== null ? 'min="' . h($min) . '"' : '' ?>
                                <?= $max !== null ? 'max="' . h($max) . '"' : '' ?>
                            >
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <div class="form-actions">
                    <button type="submit" class="action-button">Execute operation</button>
                </div>
            </form>
        </div>
    </section>
</main>

</body>
</html>
