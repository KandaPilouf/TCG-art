<?php
var_dump($_SERVER['REQUEST_URI']);
/* current url assigned */
$current_url = parse_url($_SERVER['REQUEST_URI'])['path'];

/* sets query if exists */
$current_query = '';
if(isset(parse_url($_SERVER['REQUEST_URI'])['query'])){
$current_query = parse_url($_SERVER['REQUEST_URI'])['query'];
}


/* cleanup of url */
$current_url = trim($current_url, '/');
$current_url = str_replace('//', '/', $current_url);

/* default values */
$segments = [];
$controller = 'home';
$action = 'index';
$id = null;
$is_admin = false;

/* explode into segments*/
if (str_contains($current_url, '/')) {
  $segments = explode('/', $current_url);
} 

/* check if admin zone and shift url segments*/
if (isset($segments[0]) && $segments[0] === 'admin') {
  array_shift($segments);
  $is_admin = true;
}


/* set every segments */
if (isset($segments[0])) {
  $controller = $segments[0];
}
if (isset($segments[1])) {
  $action = $segments[1];
}
if (isset($segments[2]) && is_numeric($segments[2])) {
  $id = $segments[2];
}

/* sets file */
$file = $controller . '.php';
$page = 'home';

/* check if file exists */
if(file_exists("./public/".$file)){
  $page = $controller;
}else{
  $page = 'home';
}

echo "URL : " . $_SERVER['REQUEST_URI'] . PHP_EOL . PHP_EOL;
echo "Controller : " . $controller . ".php" . PHP_EOL;
echo "Action : " . $action . "()" . PHP_EOL;
echo "Identifiant : '" . $id . "'" . PHP_EOL;
echo ($is_admin) ? 'Admin : yes' : 'Admin : no';

?>