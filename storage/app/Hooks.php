<?php

$sourceFile      = 'storage/app/pre-commit';
$destinationFile = '.git/hooks/pre-commit';

if (file_exists($sourceFile)) {
    copy($sourceFile, $destinationFile);
    echo "File berhasil disalin.\n";
}
