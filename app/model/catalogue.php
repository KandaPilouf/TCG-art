<?php

function get_all_items($pdo)
{
    $sql = "SELECT name, artist, img, slug, id FROM card WHERE is_deleted = 0";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function filter_cards($pdo, $q, $tag, $style, $universe, $color)
{
    $sql = "SELECT card.name, card.artist, card.img, card.slug, card.id
            FROM card
            LEFT JOIN card_tag ON card_tag.id_card = card.id
            LEFT JOIN style    ON style.id    = card.style_id
            LEFT JOIN universe ON universe.id = card.universe_id
            LEFT JOIN color ON color.id = card.primary_color_id
            WHERE card.is_deleted = 0";

    $params = [];

    if ($q !== '') {
        $sql .= " AND card.name LIKE ?";
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

    $sql .= " GROUP BY card.id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function get_one_item($pdo, $slug)
{
    $sql = "SELECT card.*,
       style.style, universe.universe, variant.variant, color.color,
       GROUP_CONCAT(tag.tag SEPARATOR ', ') AS tags
        FROM card
        JOIN style    ON style.id    = card.style_id
        JOIN universe ON universe.id = card.universe_id
        JOIN variant  ON variant.id  = card.variant_id
        JOIN color    ON color.id    = card.primary_color_id
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

function get_tags($pdo)
{
    $sql = "SELECT id, tag FROM tag";
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

function get_user_decks($pdo, $user_id)
{
    $sql = "SELECT id, name FROM deck WHERE id_user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function search_cards($pdo, $q)
{
    $sql = "SELECT card.name, card.artist, card.img, card.slug
            FROM card
            JOIN universe ON universe.id = card.universe_id
            JOIN color    ON color.id    = card.primary_color_id
            JOIN style    ON style.id    = card.style_id
            LEFT JOIN card_tag ON card_tag.id_card = card.id
            LEFT JOIN tag      ON tag.id = card_tag.id_tag
            WHERE card.is_deleted = 0
            AND (
                card.name      LIKE ?
                OR card.artist LIKE ?
                OR universe.universe LIKE ?
                OR color.color       LIKE ?
                OR style.style       LIKE ?
                OR tag.tag           LIKE ?
            )
            GROUP BY card.id";

    $stmt = $pdo->prepare($sql);
    $like = '%' . $q . '%';
    $stmt->execute([$like, $like, $like, $like, $like, $like]);
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
