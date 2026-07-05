<h1>DELETE CARD</h1>
<p class="admin-sub">Remove a card from the catalogue.</p>

<ul class="admin-list">
    <?php foreach ($cards as $card) { ?>
        <li>
            <span><?= escape($card['name']) ?></span>
            <form action="/admin/card/delete" method="POST">
                <input type="hidden" name="id" value="<?= $card['id'] ?>">
                <button type="submit" class="admin-btn danger">Delete</button>
            </form>
        </li>
    <?php } ?>
</ul>
