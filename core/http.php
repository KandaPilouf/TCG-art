<?php

// Utilitaires HTTP : http_in()/http_out() pour le cycle requête→réponse,
// redirect()/is_post() en raccourcis. Chemins pensés depuis la racine, car
// toutes les requêtes passent par index.php.

function http_in(string $request_uri): array
{
    // La query string n'identifie pas la route.
    $path = strtok($request_uri, '?');

    // Normalise : slash multiples → un seul, pas de slash/espace aux bords, casse.
    $path = preg_replace('#/+#', '/', $path);
    $path = strtolower(trim($path, ' /'));

    // '' = accueil ; sinon découpe les segments.
    return $path === '' ? [] : explode('/', $path);
}

function http_out(int $code, string $body, array $headers = []): void
{
    http_response_code($code);

    // Les headers doivent partir avant le body.
    foreach ($headers as $name => $value) {
        header($name . ': ' . $value);
    }

    echo $body;
}

function redirect(string $url): void
{
    http_out(302, '', ['Location' => $url]);
    exit;
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}
