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
<main>
  <?php
  include './public/' . $page . '.php';
  ?>
</main>
<?php include './component/foot.php' ?>