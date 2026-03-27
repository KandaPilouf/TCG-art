<?php include './component/head.html' ?>
    <main>
      <?php
        $page = $_GET['categorie'];
        include $page . '.php';
      ?>
    </main>
<?php include './component/foot.php' ?>
