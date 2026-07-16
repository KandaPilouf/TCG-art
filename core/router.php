<?php

// Routeur : segments HTTP → controller à appeler. route() structure les
// segments, run() charge le fichier et appelle la fonction, qui retourne du
// HTML (généralement via render()). is_safe_segment() filtre les segments.

function route(array $http_segments): array
{
    // Vérifié avant usage : les segments servent de noms de fichier/fonction.
    foreach ($http_segments as $segment) {
        if ($segment !== null && !is_safe_segment($segment)) {
            throw new InvalidArgumentException('Invalid route segment: ' . $segment);
        }
    }

    // /item/show/3 → entity=item, action=show, id=3.
    return [
        'entity' => $http_segments[0] ?? 'home',
        'action' => $http_segments[1] ?? 'index',
        'id'     => $http_segments[2] ?? null,
    ];
}

function run(array $route, string $base_path, $pdo): string
{
    $base_path = rtrim($base_path, '/');

    // entity → fichier controller ; entity + action → fonction. Ex : item_show().
    $controller_filepath = $base_path . '/controllers/' . $route['entity'] . '.php';
    $function_name = $route['entity'] . '_' . $route['action'];

    if (!is_file($controller_filepath)) {
        throw new RuntimeException('Controller not found: ' . $route['entity']);
    }
    require_once $controller_filepath;

    if (!function_exists($function_name)) {
        throw new RuntimeException('Controller function not found: ' . $function_name);
    }

    // L'id, s'il existe, est transmis au controller.
    return $route['id'] !== null ? $function_name($pdo, $route['id']) : $function_name($pdo);
}

function is_safe_segment(string $part): bool
{
    if ($part === '') {
        return false;
    }

    // Allowlist volontairement restreinte. strspn compte les caractères initiaux
    // qui y appartiennent : couvrir toute la chaîne = aucun caractère interdit.
    $allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-';
    return strspn($part, $allowed) === strlen($part);
}
