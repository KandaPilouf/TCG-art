<?php
function get_profile_data($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM `user` WHERE id = ?;");

    $stmt->execute([$id]);
    return $stmt->fetch();
}

