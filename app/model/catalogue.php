<?php

function get_all_items($pdo)
{
    $sql = "SELECT name, artist, img, slug FROM card WHERE is_deleted = 0";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_one_item($pdo, $slug)
{
    $sql = "SELECT card.*,
       style.style,
       universe.universe,
       variant.variant,
       color.color,
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

function search_cards($pdo, $q){
    $sql = "SELECT name, artist, img, slug FROM card WHERE name LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $q . '%']);
    return $stmt->fetchAll();
}