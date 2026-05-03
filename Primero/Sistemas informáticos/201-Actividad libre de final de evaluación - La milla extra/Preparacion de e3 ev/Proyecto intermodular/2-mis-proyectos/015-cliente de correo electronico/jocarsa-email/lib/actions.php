<?php

function logout(): void {
    session_destroy();
    header("Location: index.php");
    exit;
}

function redirectTo(string $url): void {
    header("Location: " . $url);
    exit;
}

function buildBaseUrl(string $folder = 'ALL'): string {
    return 'index.php?folder=' . urlencode($folder);
}
