<div id="title">
    <h1><?= $deck['name'] ?></h1>
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
                <a class="btn-card" href="#">remove card</a>
            </div>
        </figure>
    <?php
    }
    ?>
</div>