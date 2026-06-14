<?php
function get_user_decks($pdo, $id){
    $sql = "SELECT id,name FROM deck WHERE id_user = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function add_deck($pdo, $user_id, $name){

    $sql = "INSERT INTO deck (id_user, name) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id,$name]);
}
?>