<h1>EDIT CARD</h1>
<p class="admin-sub">Pick a card to edit.</p>

<ul class="admin-list">
    <?php foreach ($cards as $card) { ?>
        <li>
            <span><?= escape($card['name']) ?></span>
            <a class="admin-btn" href="/admin/card/edit/<?= $card['id'] ?>">Edit</a>
        </li>
    <?php } ?>
</ul>
