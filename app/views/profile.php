<div>
    <h1><?php echo $user['name'] ?></h1>
    <p>member since <?= $user['date'] ?></p>

    <?php
    if ($_SESSION['is_admin'] === 1) { ?>
        <a href="/admin/">Admin page</a>
    <?php
    }
    ?>
</div>

<div>
    <p>cards owned</p>
    <p>collections</p>
</div>