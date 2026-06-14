<?php

function load_env(string $path): void
{
    if (!is_file($path)) {
        throw new RuntimeException('.env not found: ' . $path);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        // skip comments
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        // split on the FIRST '=' only (values may contain '=')
        [$key, $value] = explode('=', $line, 2);

        $_ENV[trim($key)] = trim($value);
    }
}

?>