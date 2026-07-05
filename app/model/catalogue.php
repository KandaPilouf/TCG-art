<?php

function filter_cards($pdo, $q, $tag, $style, $universe, $color)
{
    $sql = "SELECT card.name, card.artist, card.img, card.slug, card.id,
                   color.color AS color, variant.variant AS variant
            FROM card
            LEFT JOIN card_tag ON card_tag.id_card = card.id
            LEFT JOIN style    ON style.id    = card.style_id
            LEFT JOIN universe ON universe.id = card.universe_id
            LEFT JOIN color    ON color.id   = card.primary_color_id
            LEFT JOIN variant  ON variant.id = card.variant_id
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

function get_featured_card($pdo)
{
    $sql = "SELECT card.name, card.slug, card.img, card.artist,
                   universe.universe, style.style, color.color, variant.variant
            FROM card
            LEFT JOIN universe ON universe.id = card.universe_id
            LEFT JOIN style    ON style.id    = card.style_id
            LEFT JOIN color    ON color.id    = card.primary_color_id
            LEFT JOIN variant  ON variant.id  = card.variant_id
            WHERE card.is_deleted = 0
            ORDER BY RAND()
            LIMIT 1";
    return $pdo->query($sql)->fetch();
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
