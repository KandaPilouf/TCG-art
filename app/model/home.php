<?php
function get_random_card($pdo)
{
    $sql = "SELECT * FROM card WHERE is_deleted = 0
    ORDER BY RAND()
    LIMIT 1";
    $stmt = $pdo->query($sql);
    return $stmt->fetch();
}

function get_all_cards($pdo){
    $sql = "SELECT name FROM card WHERE is_deleted = 0";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_home_stats($pdo){
    $sql = "SELECT
                (SELECT COUNT(*) FROM card WHERE is_deleted = 0)                          AS cards,
                (SELECT COUNT(DISTINCT universe_id) FROM card WHERE is_deleted = 0)        AS universes,
                (SELECT COUNT(DISTINCT style_id) FROM card WHERE is_deleted = 0)           AS styles,
                (SELECT COUNT(DISTINCT artist) FROM card WHERE is_deleted = 0)             AS artists";
    return $pdo->query($sql)->fetch();
}
