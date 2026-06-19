<div id="filters">
    <form action="/catalogue" method="GET">
        <input list="card_name" type="text" name="q" placeholder="Search cards" value="<?= isset($_GET['q']) ? escape($_GET['q']) : '' ?>">
        <button type="submit">Search</button>
    </form>
    <select name="tags"></select>
    <select name="style"></select>
    <select name="universe"></select>
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