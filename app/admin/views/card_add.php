<h1>ADD CARD</h1>

<form method="POST" action="/admin/card/add" class="admin-form">
    <label for="name">Card name</label>
    <input id="name" name="name" value="" required>

    <label for="img">Image URL</label>
    <input id="img" name="img" value="" required>

    <label for="artist">Card artist</label>
    <select name="artist" id="artist" required>
        <?php foreach ($artists as $artist) { ?>
            <option value="<?= $artist['id'] ?>"><?= escape($artist['artist']) ?></option>
        <?php } ?>
    </select>

    <label for="date">Card creation date</label>
    <input type="date" id="date" name="date" value="" required>

    <label for="style">Card style</label>
    <select name="style" id="style" required>
        <?php
        for ($i = 0; $i < count($styles); $i++) {
        ?>
            <option value="<?= $styles[$i]['id'] ?>"><?= $styles[$i]['style'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="universe">Card universe</label>
    <select name="universe" id="universe" required>
        <?php
        for ($i = 0; $i < count($universes); $i++) {
        ?>
            <option value="<?= $universes[$i]['id'] ?>"><?= $universes[$i]['universe'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="color">Card color</label>
    <select name="color" id="color" required>
        <?php
        for ($i = 0; $i < count($colors); $i++) {
        ?>
            <option value="<?= $colors[$i]['id'] ?>"><?= $colors[$i]['color'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="variant">Card variant</label>
    <select name="variant" id="variant" required>
        <?php
        for ($i = 0; $i < count($variants); $i++) {
        ?>
            <option value="<?= $variants[$i]['id'] ?>"><?= $variants[$i]['variant'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="tag">Card tags</label>
    <select name="tag[]" id="tag" multiple>
        <?php 
        foreach($tags as $tag){?>
            <option value="<?= $tag['id'] ?>"><?= escape($tag['tag']) ?></option>
        <?php
        }
        ?>
    </select>
    <button type="submit">save</button>
</form>