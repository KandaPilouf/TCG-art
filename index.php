<?php

var_dump($_SERVER['REQUEST_URI']);
/* current url assigned */
$current_url = $_SERVER['REQUEST_URI'];

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

/* get page with href when icons are clicked */
 if (isset($_GET['categorie'])) {
   $page = $_GET['categorie'];
 } elseif (isset($_GET['item'])) {
   $page = $_GET['item'];
 }

include './component/head.php';
include './database/database.php';
?>
<main>
  <?php
  include './public/' . $page . '.php';
  ?>
</main>
<?php include './component/foot.php' ?>