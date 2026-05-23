<?php

function get_all_items($pdo){
    $sql = "SELECT * FROM card";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_one_items($pdo, $slug){
    $sql = "SELECT card.*,
       style.style,
       universe.universe,
       variant.variant,
       color.color
FROM card
JOIN style    ON style.id    = card.style_id
JOIN universe ON universe.id = card.universe_id
JOIN variant  ON variant.id  = card.variant_id
JOIN color    ON color.id    = card.primary_color_id
WHERE card.slug = ?
";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$slug]);
    return $stmt->fetch();
}
?>