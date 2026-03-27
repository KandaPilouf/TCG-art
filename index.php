<?php include './component/head.html' ?>
    <main>
      <?php
        $page = $_GET['categorie'];
        include $page . '.html';
      ?>
    </main>
<?php include './component/foot.php' ?>
