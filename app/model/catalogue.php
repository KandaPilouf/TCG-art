<?php

function get_all_items($pdo){
    $sql = "SELECT * FROM card";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_one_items($pdo, $slug){
    $sql = "SELECT * FROM card WHERE slug = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$slug]);
    return $stmt->fetch();
}
?>