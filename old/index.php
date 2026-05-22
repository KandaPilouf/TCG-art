<?php
require 'router.php';

/* get page with href when icons are clicked */
 if (isset($_GET['categorie'])) {
   $page = $_GET['categorie'];
 } elseif (isset($_GET['item'])) {
   $page = $_GET['item'];
 }

require './component/head.php';
require './database/database.php';
?>
<main>
  <?php
  require './public/' . $page . '.php';
  ?>
</main>
<?php require './component/foot.php' ?>