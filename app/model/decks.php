<?php
function get_user_decks($pdo, $id)
{
    $sql = "SELECT id,name FROM deck WHERE id_user = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function get_user_deck($pdo, $deck_id)
{
    $sql = "SELECT id, name, id_user FROM deck WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$deck_id]);
    return $stmt->fetch();
}

function add_deck($pdo, $user_id, $name)
{

    $sql = "INSERT INTO deck (id_user, name) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $name]);
}
