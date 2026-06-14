<h1>DELETE CARD PAGE</h1>

<?php
foreach ($cards as $card) { ?>

    <form action="/admin/card/delete" method="POST">
        <h2><?= $card['name'] ?></h2>
        <input type="hidden" name="id" value="<?= $card['id'] ?>">
        <button type="submit"> DELETE </button>
    </form>
<?php
}
?>