<h1>EDIT CARD</h1>

<form method="POST" action="/admin/card/edit/<?= $card['id'] ?>" class="admin-form">
    <label for="name">Card name</label>
    <input id="name" name="name" value="<?= escape($card['name']) ?>" required>

    <label for="img">Image URL</label>
    <input id="img" name="img" value="<?= escape($card['img']) ?>" required>

    <label for="slug">Card slug</label>
    <input id="slug" name="slug" value="<?= escape($card['slug']) ?>" required>

    <label for="artist">Card artist</label>
    <select name="artist" id="artist" required>
        <?php foreach ($artists as $artist) { ?>
            <option value="<?= $artist['id'] ?>" <?= $artist['id'] == $card['artist_id'] ? 'selected' : '' ?>><?= escape($artist['artist']) ?></option>
        <?php } ?>
    </select>

    <label for="date">Card creation date</label>
    <input type="date" id="date" name="date" value="<?= escape($card['creation_date']) ?>" required>

    <label for="style">Card style</label>
    <select name="style" id="style" required>
        <?php foreach ($styles as $style) { ?>
            <option value="<?= $style['id'] ?>" <?= $style['id'] == $card['style_id'] ? 'selected' : '' ?>><?= escape($style['style']) ?></option>
        <?php } ?>
    </select>

    <label for="universe">Card universe</label>
    <select name="universe" id="universe" required>
        <?php foreach ($universes as $universe) { ?>
            <option value="<?= $universe['id'] ?>" <?= $universe['id'] == $card['universe_id'] ? 'selected' : '' ?>><?= escape($universe['universe']) ?></option>
        <?php } ?>
    </select>

    <label for="color">Card color</label>
    <select name="color" id="color" required>
        <?php foreach ($colors as $color) { ?>
            <option value="<?= $color['id'] ?>" <?= $color['id'] == $card['primary_color_id'] ? 'selected' : '' ?>><?= escape($color['color']) ?></option>
        <?php } ?>
    </select>

    <label for="variant">Card variant</label>
    <select name="variant" id="variant" required>
        <?php foreach ($variants as $variant) { ?>
            <option value="<?= $variant['id'] ?>" <?= $variant['id'] == $card['variant_id'] ? 'selected' : '' ?>><?= escape($variant['variant']) ?></option>
        <?php } ?>
    </select>

    <label for="tag">Card tags</label>
    <select name="tag[]" id="tag" multiple>
        <?php foreach ($tags as $tag) { ?>
            <option value="<?= $tag['id'] ?>" <?= in_array($tag['id'], $selected_tags) ? 'selected' : '' ?>><?= escape($tag['tag']) ?></option>
        <?php } ?>
    </select>

    <button type="submit">save changes</button>
</form>
