<figure>
    <h1><?php echo $card['name']; ?></h1>
    <img src=<?php echo $card['img']; ?> alt="card image">
    <figcaption>
        <ul>
            <li>Artist: <?php echo $card['artist'] ?></li>
        </ul>
        <ul>
            <li>Style: <?php echo $card['style'] ?></li>
        </ul>
        <ul>
            <li>Universe: <?php echo $card['universe'] ?></li>
        </ul>
        <ul>
            <li>Tags: <?php echo $card['tags'];?></li>
        </ul>
    </figcaption>
</figure>