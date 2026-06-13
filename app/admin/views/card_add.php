<H1>ADD CARD PAGE</H1>

<form method="POST" action="/admin/card/add">
    <label for="name">Card name</label>
    <input id="name" name="name" value="" required>

    <label for="img">Image URL</label>
    <input id="img" name="img" value="" required>

    <label for="slug">Card slug</label>
    <input id="slug" name="slug" value="" required>

    <label for="artist">Card artist</label>
    <input id="artist" name="artist" value="" required>

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
    <button type="submit">save</button>
</form>