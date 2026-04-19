<?php
$page = 'home';

if (isset($_GET['categorie'])) {
  $page = $_GET['categorie'];
} elseif (isset($_GET['item'])) {
  $page = $_GET['item'];
}

include './component/head.php';
include './database/database.php';
?>
  <?php
  include $page . '.php';
  ?>
<?php include './component/foot.php' ?>