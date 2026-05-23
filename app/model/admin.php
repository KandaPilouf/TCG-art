<?php
function get_all_card_name($pdo){
    $sql = "SELECT name FROM card";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function add_card($pdo, $name, $slug, $img, $artist){
    $stmt = $pdo->prepare("INSERT INTO `card` (`id`, `name`, `slug`, `artist`, `img`, `style_id`, `universe_id`, `creation_date`, `variant_id`, `primary_color_id`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL);");

    $stmt->execute([$name,$slug,$artist,$img]);

}
?>