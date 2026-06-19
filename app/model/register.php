<?php

function create_user($pdo, $name, $email, $hash){
    
    $sql = "INSERT INTO user (name, email, pass) VALUES (?,?,?)";   
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$name,$email,$hash]);

}