<?php
include 'database.php';

$stmt = $pdo->prepare('SELECT pass FROM user WHERE email=?');
$stmt->execute([$_POST['email']]);
$user = $stmt->fetch();

$db_password = $user['pass'];

if ($user !== false && password_verify($_POST['password'], $db_password) && empty($_SESSION)) {
    session_start();
    $_SESSION['is_connected'] = $_POST['email'];
    header('Location: ../index.php?categorie=home');
} else if ($user === true && !password_verify($_POST['password'], $db_password)) {
    header('Location: ../index.php?categorie=login&error=1');
} else if($user === false){
    header('Location: ../index.php?categorie=login&error=2');
}
