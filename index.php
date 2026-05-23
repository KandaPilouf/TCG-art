<?php
session_start();
require 'core/http.php';
require 'core/router.php';
require 'core/html.php';
require './database/database.php';

$base = __DIR__ . '/app';

$segments = http_in($_SERVER['REQUEST_URI']);
$route = route($segments);

$main = run($route, $base, $pdo);
$body = render(
    'app/views/_layout.php',
    [
        'page_content' => $main,
        'entity' => $route['entity'],
    ]
);
http_out(200, $body);

// var_dump($segments);
// var_dump($route);
// var_dump($body);