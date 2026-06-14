<?php
function get_user_decks($pdo, $id){
    $sql = "SELECT id,name FROM deck WHERE id_user = ? ";
    $user = $id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    return $stmt->fetchALl();
}
?>