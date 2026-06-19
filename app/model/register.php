<?php

function create_user($pdo, $name, $email, $hash){
    
    $sql = "INSERT INTO user (name, email, pass) VALUES (?,?,?)";   
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$name,$email,$hash]);

}

function find_user_by_email($pdo, $email) {
    $stmt = $pdo->prepare('SELECT email FROM user WHERE email = ?');
    $stmt->execute([$email]);
    return $stmt->fetch();
}