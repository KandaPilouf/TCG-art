<?php

// Utilitaires de vue : render() (données + fichier de vue → HTML) et escape().
// render() retourne le HTML au lieu de l'echo, pour que le front controller
// l'envoie via http_out().

function render(string $filepath, array $data = []): string
{
    if (!is_file($filepath)) {
        throw new RuntimeException('View not found: ' . $filepath);
    }

    // Les clés deviennent des variables dans la vue : ['title' => ...] → $title.
    extract($data);

    // Capture ce que la vue affiche au lieu de l'envoyer directement.
    ob_start();
    require $filepath;
    return ob_get_clean();
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
