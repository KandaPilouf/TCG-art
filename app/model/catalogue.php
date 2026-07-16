<?php

function filter_cards($pdo, $q, $tag, $style, $universe, $color, $artist = '')
{
    $sql = "SELECT card.name, artist.artist AS artist, card.img, card.slug, card.id,
                   color.color AS color, variant.variant AS variant
            FROM card
            LEFT JOIN card_tag ON card_tag.id_card = card.id
            LEFT JOIN style    ON style.id    = card.style_id
            LEFT JOIN universe ON universe.id = card.universe_id
            LEFT JOIN color    ON color.id   = card.primary_color_id
            LEFT JOIN variant  ON variant.id = card.variant_id
            LEFT JOIN artist   ON artist.id  = card.artist_id
            WHERE card.is_deleted = 0";

    $params = [];

    // Match artist name too, so a plain text search finds an artist's work, not
    // just cards whose title contains the string.
    if ($q !== '') {
        $sql .= " AND (card.name LIKE ? OR artist.artist LIKE ?)";
        $params[] = '%' . $q . '%';
        $params[] = '%' . $q . '%';
    }
    if ($tag !== '') {
        $sql .= " AND card_tag.id_tag = ?";
        $params[] = $tag;
    }
    if ($style !== '') {
        $sql .= " AND card.style_id = ?";
        $params[] = $style;
    }
    if ($universe !== '') {
        $sql .= " AND card.universe_id = ?";
        $params[] = $universe;
    }
    if ($color !== '') {
        $sql .= " AND card.primary_color_id = ?";
        $params[] = $color;
    }
    if ($artist !== '') {
        $sql .= " AND card.artist_id = ?";
        $params[] = $artist;
    }

    $sql .= " GROUP BY card.id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function get_featured_card($pdo)
{
    $sql = "SELECT card.name, card.slug, card.img, artist.artist AS artist,
                   universe.universe, style.style, color.color, variant.variant
            FROM card
            LEFT JOIN universe ON universe.id = card.universe_id
            LEFT JOIN style    ON style.id    = card.style_id
            LEFT JOIN color    ON color.id    = card.primary_color_id
            LEFT JOIN variant  ON variant.id  = card.variant_id
            LEFT JOIN artist   ON artist.id   = card.artist_id
            WHERE card.is_deleted = 0
            ORDER BY RAND()
            LIMIT 1";
    return $pdo->query($sql)->fetch();
}

function get_one_item($pdo, $slug)
{
    // LEFT JOIN: style/universe/variant/color are nullable, and inner joins would
    // drop the whole card when any one of them is unset.
    // artist.artist AS artist is selected after card.* so it wins the assoc key
    // even while card.artist still exists (pre-cutover).
    $sql = "SELECT card.*,
       style.style, universe.universe, variant.variant, color.color,
       artist.artist AS artist,
       GROUP_CONCAT(DISTINCT tag.tag ORDER BY tag.tag SEPARATOR ', ') AS tags,
       GROUP_CONCAT(DISTINCT tag.id ORDER BY tag.tag SEPARATOR ',') AS tag_ids
        FROM card
        LEFT JOIN style    ON style.id    = card.style_id
        LEFT JOIN universe ON universe.id = card.universe_id
        LEFT JOIN variant  ON variant.id  = card.variant_id
        LEFT JOIN color    ON color.id    = card.primary_color_id
        LEFT JOIN artist   ON artist.id   = card.artist_id
        LEFT JOIN card_tag ON card_tag.id_card = card.id
        LEFT JOIN tag      ON tag.id = card_tag.id_tag
        WHERE card.slug = ?
        AND is_deleted = 0
        GROUP BY card.id
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

// Cards sharing this card's universe, style or artist — closest match first.
function get_related_cards($pdo, array $card, int $limit = 6)
{
    // Plain `=` (not `<=>`): NULL must not match NULL, or every card missing a
    // universe would count as related to every other one.
    $sql = "SELECT card.name, card.slug, card.img, artist.artist AS artist,
                   (COALESCE(card.universe_id = ?, 0)
                    + COALESCE(card.style_id = ?, 0)
                    + COALESCE(card.artist_id = ?, 0)) AS score
            FROM card
            LEFT JOIN artist ON artist.id = card.artist_id
            WHERE card.is_deleted = 0
              AND card.id <> ?
              AND (card.universe_id = ? OR card.style_id = ? OR card.artist_id = ?)
            ORDER BY score DESC, card.id DESC
            LIMIT " . (int) $limit;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $card['universe_id'], $card['style_id'], $card['artist_id'], $card['id'],
        $card['universe_id'], $card['style_id'], $card['artist_id'],
    ]);
    return $stmt->fetchAll();
}

function get_tags($pdo)
{
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

function get_styles($pdo)
{
    $sql = "SELECT id, style FROM style";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_universes($pdo)
{
    $sql = "SELECT id, universe FROM universe";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_colors($pdo)
{
    $sql = "SELECT id, color FROM color";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_decks_with_card($pdo, $user_id, $card_id)
{
    $sql = "SELECT id_deck
            FROM card_deck
            JOIN deck ON deck.id = card_deck.id_deck
            WHERE card_deck.id_card = ?
            AND deck.id_user = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$card_id, $user_id]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
