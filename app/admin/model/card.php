<?php

function get_styles($pdo)
{
    $sql = "SELECT id, style FROM style";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_universe($pdo)
{
    $sql = "SELECT id, universe FROM universe";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_variant($pdo)
{
    $sql = "SELECT id, variant FROM variant";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_color($pdo)
{
    $sql = "SELECT id, color FROM color";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_tags($pdo){
    $sql = "SELECT id, tag FROM tag";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_artists($pdo)
{
    $sql = "SELECT id, artist FROM artist ORDER BY artist";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function slugify($text)
{
    $text = trim($text);
    // Transliterate accents to ASCII where the platform supports it.
    if (function_exists('iconv')) {
        $ascii = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        if ($ascii !== false) {
            $text = $ascii;
        }
    }
    $text = strtolower($text);
    // Drop apostrophe-like marks (incl. iconv translit artifacts like é→'e) so
    // they vanish rather than becoming stray separators.
    $text = str_replace(["'", "`", "´", "’", '"'], '', $text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text === '' ? 'card' : $text;
}

// Build a slug from $base that no card row uses (deleted rows included, so a
// slug is never silently reused). Appends -2, -3, … on collision.
function unique_slug($pdo, $base)
{
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM card WHERE slug = ?");
    $slug = $base;
    $i = 2;
    while (true) {
        $stmt->execute([$slug]);
        if ((int) $stmt->fetchColumn() === 0) {
            return $slug;
        }
        $slug = $base . '-' . $i++;
    }
}

function add_card($pdo, $name, $slug, $img, $artist_id, $style, $variant, $color, $universe, $date, $tags)
{
    $stmt = $pdo->prepare("INSERT INTO `card` (`id`, `name`, `slug`, `artist_id`, `img`, `style_id`, `universe_id`, `creation_date`, `variant_id`, `primary_color_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->execute([$name, $slug, $artist_id, $img, $style, $universe, $date, $variant, $color]);

    $card_id = $pdo->lastInsertId();
    $tagStmt = $pdo->prepare("INSERT INTO card_tag (id_card, id_tag) VALUES (?,?)");

    foreach($tags as $tag_id){
        $tagStmt->execute([$card_id, $tag_id]);
    }
}

function delete_card($pdo, $id){
    $stmt = $pdo->prepare("UPDATE card SET is_deleted = 1 WHERE card.id = ?");
    $stmt->execute([$id]);
}

function get_all_cards($pdo) {
    $sql = "SELECT name, id FROM card WHERE is_deleted = 0";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_card($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM card WHERE id = ? AND is_deleted = 0");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function get_card_tag_ids($pdo, $id) {
    $stmt = $pdo->prepare("SELECT id_tag FROM card_tag WHERE id_card = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function update_card($pdo, $id, $name, $slug, $img, $artist_id, $style, $variant, $color, $universe, $date, $tags) {
    $stmt = $pdo->prepare("UPDATE card SET name = ?, slug = ?, artist_id = ?, img = ?, style_id = ?, universe_id = ?, creation_date = ?, variant_id = ?, primary_color_id = ? WHERE id = ?");
    $stmt->execute([$name, $slug, $artist_id, $img, $style, $universe, $date, $variant, $color, $id]);

    // Re-sync tags: clear then re-insert the chosen set.
    $pdo->prepare("DELETE FROM card_tag WHERE id_card = ?")->execute([$id]);
    $tagStmt = $pdo->prepare("INSERT INTO card_tag (id_card, id_tag) VALUES (?, ?)");
    foreach ($tags as $tag_id) {
        $tagStmt->execute([$id, $tag_id]);
    }
}
