<div id="filters">
    <form action="/catalogue" method="GET">
        <input list="card_name" type="text" name="q" placeholder="Search cards" value="<?= isset($_GET['q']) ? escape($_GET['q']) : '' ?>">

        <label for="tags"></label>
        <select name="tags">
            <option value="">All tags</option>
            <?php foreach ($tags as $tag) { ?>
                <option value="<?= $tag['id'] ?>" <?= (isset($_GET['tags']) && $_GET['tags'] == $tag['id']) ? 'selected' : '' ?>>
                    <?= escape($tag['tag']) ?>
                </option>
            <?php } ?>
        </select>

        <label for="styles"></label>
        <select name="style">
            <option value="">All styles</option>
            <?php
            foreach ($styles as $style) { ?>
                <option value="<?= $style['id'] ?>" <?= (isset($_GET['style']) && $_GET['style'] == $style['id']) ? 'selected' : '' ?>>
                    <?= escape($style['style']) ?>
                </option>
            <?php } ?>
        </select>

        <label for="universe"></label>
        <select name="universe">
            <option value="">All universe</option>
            <?php
            foreach ($universes as $universe) { ?>
                <option value="<?= $universe['id'] ?>" <?= (isset($_GET['universe']) && $_GET['universe'] == $universe['id']) ? 'selected' : '' ?>>
                    <?= escape($universe['universe']) ?>
                </option>
            <?php } ?>
        </select>

        <label for="color"></label>
        <select name="color">
            <option value="">All colors</option>
            <?php
            foreach ($colors as $color) { ?>
                <option value="<?= $color['id'] ?>" <?= (isset($_GET['color']) && $_GET['color'] == $color['id']) ? 'selected' : '' ?>>
                    <?= escape($color['color']) ?>
                </option>
            <?php
            }
            ?>
        </select>

        <button type="submit">Search</button>
    </form>
</div>

<div id="cards">
    <?php
    foreach ($cards as $card) {
    ?>
        <figure>
            <div id="card_caption">
                <img src=<?php echo $card['img']; ?> alt="card image">
                <figcaption>
                    <h2><?php echo $card['name']; ?></h2>
                    <span> Artist: <?php echo $card['artist']; ?></span>
                </figcaption>
            </div>
            <div class="btn-pos">
                <a class="btn-card" href="/catalogue/show/<?php echo $card['slug'] ?>">show card</a>
                <a class="btn-card">Add card</a>
            </div>
        </figure>
    <?php
    }
    ?>
</div>