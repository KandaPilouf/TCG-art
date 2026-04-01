<?php include './component/head.html' ?>
<main>
  <?php

  if (empty($_GET)) {
    $page = 'home';
  } elseif (isset($_GET['categorie'])) {

    $page = $_GET['categorie'];
  } elseif (isset($_GET['item'])) {

    $page = $_GET['item'];
  }

  include $page . '.php';
  ?>
</main>
<?php include './component/foot.php' ?>