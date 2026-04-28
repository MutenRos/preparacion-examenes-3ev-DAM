<?php
declare(strict_types=1);

/*
 * back.php
 *
 * Generic backend for the "operaciones" project.
 * It receives uploaded files, chooses the corresponding Python script,
 * passes operation-specific arguments, packages outputs when needed,
 * and returns the generated file to the browser.
 *
 * Expected request:
 *   POST multipart/form-data
 *   - action: operation key
 *   - files[]: one or more uploaded files
 *   - other fields depending on operation
 *
 * Notes:
 *   - Update $pythonBin and $operations paths if needed
 *   - Most operations here return either a generated file or a zip
 *   - Temporary files are deleted automatically at the end
 */

ini_set('display_errors', '0');
error_reporting(E_ALL);
set_time_limit(0);

$baseDir   = __DIR__;
$pythonBin = 'python3';
$tmpRoot   = $baseDir . '/tmp';

if (!is_dir($tmpRoot)) {
    mkdir($tmpRoot, 0775, true);
}

$operations = [

    // IMAGE
    'images_resize' => [
        'script' => $baseDir . '/operaciones/image/images_resize.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [
                $ctx['jobDir'],
                post_value('width', 'null'),
                post_value('height', 'null'),
                bool_arg('keep_ratio', true),
                bool_arg('no_enlarge', false),
            ];
        },
    ],

    'images_to_pdf' => [
        'script' => $baseDir . '/operaciones/image/images_to_pdf.py',
        'output' => 'file',
        'output_file' => 'resultado.pdf',
        'builder' => function(array $ctx): array {
            return [
                $ctx['outputFile'],
                post_value('page_mode', 'original'),
                bool_arg('auto_rotate', false),
            ];
        },
    ],

    'jpg_to_png' => [
        'script' => $baseDir . '/operaciones/image/jpg_to_png.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'png_to_jpg' => [
        'script' => $baseDir . '/operaciones/image/png_to_jpg.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [
                $ctx['jobDir'],
                post_value('quality', '95'),
            ];
        },
    ],

    'webp_to_png' => [
        'script' => $baseDir . '/operaciones/image/webp_to_png.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    // OFFICE
    'docx_to_pdf' => [
        'script' => $baseDir . '/operaciones/office/docx_to_pdf.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'docx_to_txt' => [
        'script' => $baseDir . '/operaciones/office/docx_to_txt.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'txt_to_docx' => [
        'script' => $baseDir . '/operaciones/office/txt_to_docx.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'xlsx_to_csv' => [
        'script' => $baseDir . '/operaciones/office/xlsx_to_csv.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    // PDF
    'extract_images_from_pdf' => [
        'script' => $baseDir . '/operaciones/pdf/extract_images_from_pdf.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'extract_pages_pdf' => [
        'script' => $baseDir . '/operaciones/pdf/extract_pages_pdf.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [
                $ctx['jobDir'],
                required_post_value('pages'),
            ];
        },
    ],

    'join_pdf' => [
        'script' => $baseDir . '/operaciones/pdf/join_pdf.py',
        'output' => 'file',
        'output_file' => 'joined.pdf',
        'builder' => function(array $ctx): array {
            return [
                $ctx['outputFile'],
                post_value('range', 'all'),
            ];
        },
    ],

    'pdf_to_jpg' => [
        'script' => $baseDir . '/operaciones/pdf/pdf_to_jpg.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [
                $ctx['jobDir'],
                post_value('dpi', '200'),
                post_value('quality', '90'),
            ];
        },
    ],

    'pdf_to_png' => [
        'script' => $baseDir . '/operaciones/pdf/pdf_to_png.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [
                $ctx['jobDir'],
                post_value('dpi', '200'),
            ];
        },
    ],

    'pdf_to_text' => [
        'script' => $baseDir . '/operaciones/pdf/pdf_to_text.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'remove_pages_pdf' => [
        'script' => $baseDir . '/operaciones/pdf/remove_pages_pdf.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [
                $ctx['jobDir'],
                required_post_value('pages'),
            ];
        },
    ],

    'reverse_pdf' => [
        'script' => $baseDir . '/operaciones/pdf/reverse_pdf.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'rotate_pdf' => [
        'script' => $baseDir . '/operaciones/pdf/rotate_pdf.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [
                $ctx['jobDir'],
                post_value('angle', '90'),
            ];
        },
    ],

    'split_pdf' => [
        'script' => $baseDir . '/operaciones/pdf/split_pdf.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            $mode = post_value('mode', 'pages');
            $args = [$ctx['jobDir'], $mode];

            if ($mode === 'ranges') {
                $args[] = required_post_value('input_target', '__FILES__');
                $args[] = required_post_value('ranges');
                return $args;
            }

            return $args;
        },
        'special_input_handling' => true,
    ],

    // TEXT / DATA
    'csv_to_json' => [
        'script' => $baseDir . '/operaciones/text/csv_to_json.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'html_to_md' => [
        'script' => $baseDir . '/operaciones/text/html_to_md.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'html_to_txt' => [
        'script' => $baseDir . '/operaciones/text/html_to_txt.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'json_to_csv' => [
        'script' => $baseDir . '/operaciones/text/json_to_csv.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'json_to_xml' => [
        'script' => $baseDir . '/operaciones/text/json_to_xml.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'md_to_html' => [
        'script' => $baseDir . '/operaciones/text/md_to_html.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'txt_to_html' => [
        'script' => $baseDir . '/operaciones/text/txt_to_html.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],

    'xml_to_json' => [
        'script' => $baseDir . '/operaciones/text/xml_to_json.py',
        'output' => 'zip',
        'builder' => function(array $ctx): array {
            return [$ctx['jobDir']];
        },
    ],
];

$jobDir = null;

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new RuntimeException('This endpoint only accepts POST.');
    }

    $action = isset($_POST['action']) ? trim((string)$_POST['action']) : '';
    if ($action === '') {
        throw new RuntimeException('Missing action.');
    }

    if (!isset($operations[$action])) {
        throw new RuntimeException('Unknown action: ' . $action);
    }

    $config = $operations[$action];

    if (!file_exists($config['script'])) {
        throw new RuntimeException('Script not found: ' . $config['script']);
    }

    $jobId  = date('YmdHis') . '_' . bin2hex(random_bytes(6));
    $jobDir = $tmpRoot . '/' . $jobId;
    $inDir  = $jobDir . '/input';
    $outDir = $jobDir . '/output';

    mkdir($jobDir, 0775, true);
    mkdir($inDir, 0775, true);
    mkdir($outDir, 0775, true);

    $uploadedFiles = save_uploaded_files($inDir);

    if (empty($uploadedFiles) && empty($config['special_input_handling'])) {
        throw new RuntimeException('No files uploaded.');
    }

    $outputFile = null;
    if (($config['output'] ?? '') === 'file') {
        $filename   = $config['output_file'] ?? 'resultado.bin';
        $outputFile = $outDir . '/' . $filename;
    }

    $ctx = [
        'jobDir'     => $outDir,
        'inputDir'   => $inDir,
        'outputDir'  => $outDir,
        'outputFile' => $outputFile,
        'action'     => $action,
    ];

    $baseArgs = $config['builder']($ctx);

    $command = [$pythonBin, $config['script']];

    foreach ($baseArgs as $arg) {
        if ($arg === '__FILES__') {
            foreach ($uploadedFiles as $uploadedFile) {
                $command[] = $uploadedFile;
            }
        } else {
            $command[] = (string)$arg;
        }
    }

    if (empty($config['special_input_handling'])) {
        foreach ($uploadedFiles as $uploadedFile) {
            $command[] = $uploadedFile;
        }
    } else {
        // For split_pdf ranges mode, builder may already have injected uploaded file placeholder.
        if ($action === 'split_pdf' && post_value('mode', 'pages') !== 'ranges') {
            foreach ($uploadedFiles as $uploadedFile) {
                $command[] = $uploadedFile;
            }
        }
    }

    $result = run_command($command, $jobDir);

    $logPath = $jobDir . '/command.log';
    file_put_contents($logPath, build_command_log($command, $result));

    if ($result['exit_code'] !== 0) {
        throw new RuntimeException("Python returned an error.\n\n" . $result['combined']);
    }

    if (($config['output'] ?? '') === 'file') {
        if (!$outputFile || !file_exists($outputFile)) {
            throw new RuntimeException('Expected output file was not generated.');
        }

        send_file_and_exit($outputFile, basename($outputFile));
    }

    $zipPath = $jobDir . '/resultado.zip';
    zip_directory($outDir, $zipPath);

    if (!file_exists($zipPath)) {
        throw new RuntimeException('ZIP file could not be created.');
    }

    send_file_and_exit($zipPath, 'resultado_' . $action . '.zip');

} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo $e->getMessage();
} finally {
    if ($jobDir && is_dir($jobDir)) {
        recursive_delete($jobDir);
    }
}


/* -------------------------------------------------------------------------- */
/* Helpers                                                                    */
/* -------------------------------------------------------------------------- */

function post_value(string $key, string $default = ''): string
{
    if (!isset($_POST[$key])) {
        return $default;
    }
    return trim((string)$_POST[$key]);
}

function required_post_value(string $key, ?string $defaultMarker = null): string
{
    if ($defaultMarker !== null && $defaultMarker === '__FILES__') {
        return '__FILES__';
    }

    $value = isset($_POST[$key]) ? trim((string)$_POST[$key]) : '';
    if ($value === '') {
        throw new RuntimeException('Missing required field: ' . $key);
    }
    return $value;
}

function bool_arg(string $key, bool $default = false): string
{
    if (!isset($_POST[$key])) {
        return $default ? '1' : '0';
    }

    $value = strtolower(trim((string)$_POST[$key]));
    return in_array($value, ['1', 'true', 'yes', 'on', 'si', 'sí'], true) ? '1' : '0';
}

function save_uploaded_files(string $destinationDir): array
{
    if (!isset($_FILES['files'])) {
        return [];
    }

    $saved = [];
    $names = $_FILES['files']['name'] ?? [];
    $tmps  = $_FILES['files']['tmp_name'] ?? [];
    $errs  = $_FILES['files']['error'] ?? [];

    if (!is_array($names)) {
        $names = [$names];
        $tmps  = [$_FILES['files']['tmp_name']];
        $errs  = [$_FILES['files']['error']];
    }

    foreach ($names as $i => $originalName) {
        $err = $errs[$i] ?? UPLOAD_ERR_NO_FILE;
        if ($err === UPLOAD_ERR_NO_FILE) {
            continue;
        }
        if ($err !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Upload error for file: ' . $originalName);
        }

        $tmpName = $tmps[$i] ?? '';
        if (!is_uploaded_file($tmpName)) {
            throw new RuntimeException('Invalid uploaded file: ' . $originalName);
        }

        $safeName = safe_filename((string)$originalName);
        $target   = rtrim($destinationDir, '/') . '/' . sprintf('%03d_', $i + 1) . $safeName;

        if (!move_uploaded_file($tmpName, $target)) {
            throw new RuntimeException('Could not save uploaded file: ' . $originalName);
        }

        $saved[] = $target;
    }

    return $saved;
}

function safe_filename(string $name): string
{
    $name = basename($name);
    $name = preg_replace('/[^A-Za-z0-9._-]+/u', '_', $name) ?? 'file';
    $name = trim($name, '._-');
    return $name !== '' ? $name : 'file';
}

function run_command(array $command, ?string $cwd = null): array
{
    $descriptorSpec = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];

    $process = proc_open($command, $descriptorSpec, $pipes, $cwd);

    if (!is_resource($process)) {
        throw new RuntimeException('Could not execute Python process.');
    }

    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    $exitCode = proc_close($process);

    return [
        'exit_code' => $exitCode,
        'stdout'    => $stdout ?: '',
        'stderr'    => $stderr ?: '',
        'combined'  => trim(($stdout ?: '') . "\n" . ($stderr ?: '')),
    ];
}

function build_command_log(array $command, array $result): string
{
    return
        "COMMAND\n" .
        "=======\n" .
        implode(' ', array_map('escapeshellarg', $command)) . "\n\n" .
        "EXIT CODE\n" .
        "=========\n" .
        $result['exit_code'] . "\n\n" .
        "STDOUT\n" .
        "======\n" .
        $result['stdout'] . "\n\n" .
        "STDERR\n" .
        "======\n" .
        $result['stderr'] . "\n";
}

function zip_directory(string $directory, string $zipPath): void
{
    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        throw new RuntimeException('Could not create ZIP.');
    }

    $directory = realpath($directory);
    if ($directory === false) {
        $zip->close();
        throw new RuntimeException('Output directory not found.');
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $fileInfo) {
        /** @var SplFileInfo $fileInfo */
        if (!$fileInfo->isFile()) {
            continue;
        }

        $fullPath = $fileInfo->getRealPath();
        if ($fullPath === false) {
            continue;
        }

        $localPath = ltrim(str_replace($directory, '', $fullPath), DIRECTORY_SEPARATOR);

        // Avoid zipping the ZIP itself if it is placed inside the same tree.
        if (basename($fullPath) === basename($zipPath)) {
            continue;
        }

        $zip->addFile($fullPath, $localPath);
    }

    $zip->close();
}

function send_file_and_exit(string $filePath, string $downloadName): void
{
    if (!is_file($filePath)) {
        throw new RuntimeException('File not found for download.');
    }

    $mime = mime_content_type($filePath);
    if ($mime === false) {
        $mime = 'application/octet-stream';
    }

    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mime);
    header('Content-Disposition: attachment; filename="' . rawbasename($downloadName) . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: 0');

    $fh = fopen($filePath, 'rb');
    if ($fh === false) {
        throw new RuntimeException('Could not open file for download.');
    }

    while (!feof($fh)) {
        echo fread($fh, 8192);
        flush();
    }

    fclose($fh);
    exit;
}

function rawbasename(string $filename): string
{
    return str_replace(["\r", "\n", '"'], '', basename($filename));
}

function recursive_delete(string $path): void
{
    if (!file_exists($path)) {
        return;
    }

    if (is_file($path) || is_link($path)) {
        @unlink($path);
        return;
    }

    $items = scandir($path);
    if ($items === false) {
        return;
    }

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        recursive_delete($path . '/' . $item);
    }

    @rmdir($path);
}
