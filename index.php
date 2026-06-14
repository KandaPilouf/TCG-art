<?php
session_start();
require 'core/http.php';
require 'core/router.php';
require 'core/html.php';
require 'core/env.php';
load_env(__DIR__ . '/.env');
require './database/database.php';

$base = __DIR__ . '/app';

$segments = http_in($_SERVER['REQUEST_URI']);

if (isset($segments[0]) && $segments[0] === 'admin') {

    if (empty($_SESSION['is_connected'])) {
        redirect('/login');
    } else if($_SESSION['is_admin'] != 1){
        redirect('/home');
    }

    $base = __DIR__ . '/app/admin';

    array_shift($segments);
}

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