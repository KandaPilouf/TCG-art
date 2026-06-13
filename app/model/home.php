<?php
function get_random_card($pdo)
{
    $sql = "SELECT * FROM card
    ORDER BY RAND()
    LIMIT 1";
    $stmt = $pdo->query($sql);
    return $stmt->fetch();
}

function get_all_cards($pdo){
    $sql = "SELECT name FROM card";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}
