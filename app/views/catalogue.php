    <input type="text" name="searchbar">
    <select name="tags"></select>
    <select name="style"></select>
    <select name="universe"></select>

    <?php
    foreach ($cards as $card) {
    ?>
        <figure>
            <h1><?php echo $card['name']; ?></h1>
            <img src=<?php echo $card['img']; ?> alt="card image">
            <figcaption>
                <span> Artist: <?php echo $card['artist'];?></span>
            </figcaption>
            <button><a href="catalogue/show/<?php echo $card['slug'] ?>">show item</a></button>
        </figure>

    <?php
    }
    ?>