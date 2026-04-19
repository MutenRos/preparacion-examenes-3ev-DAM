<?php

function carpetaActiva(string $folderActual, string $folder): string {
    return $folderActual === $folder ? 'activo' : '';
}
