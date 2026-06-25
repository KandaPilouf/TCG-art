<figure id="item_page">
    <h1><?php echo $card['name']; ?></h1>
    <img src=<?php echo $card['img']; ?> alt="card image">
    <figcaption>
        <ul>
            <li>Artist: <?php echo $card['artist'] ?></li>
            <li>Style: <?php echo $card['style'] ?></li>
            <li>Universe: <?php echo $card['universe'] ?></li>
            <li>Tags: <?php echo $card['tags']; ?></li>
        </ul>
    </figcaption>

    <?php
    if (!empty($_SESSION['is_connected'])) { ?>
        <form action="/decks/add_card" method="POST">
            <input type="hidden" name="redirect" value="/catalogue/show/<?= $card['slug'] ?>">
            <input type="hidden" name="card_id" value="<?= $card['id'] ?>">
            <select name="deck_id" class="btn-add-deck">
                <?php
                foreach ($user_decks as $deck) { ?>
                    <?php $already = in_array($deck['id'], $decks_with_card) ?>
                    <option value="<?= $deck['id'] ?>" <?= $already ? 'disabled' : '' ?>><?= $deck['name'] ?> <?= $already ? 'already in deck' : '' ?></option>
                <?php
                } ?>
            </select>
            <button class="btn-add-deck" type="submit">Add to deck</button>

        </form>
    <?php
    } ?>
</figure>