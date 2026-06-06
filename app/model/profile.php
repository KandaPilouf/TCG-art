<?php
function get_profile_data($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM `user` WHERE id = ?;");

    $stmt->execute([$id]);
    return $stmt->fetch();
}


function add_card($pdo, $name, $slug, $img, $artist)
{
    $stmt = $pdo->prepare("INSERT INTO `card` (`id`, `name`, `slug`, `artist`, `img`, `style_id`, `universe_id`, `creation_date`, `variant_id`, `primary_color_id`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL);");

    $stmt->execute([$name, $slug, $artist, $img]);
}
