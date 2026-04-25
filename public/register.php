<?php

if (!empty($_POST)) {

    include './database/database.php';

    $sql = 'INSERT INTO `user` (`name`,`email`, `pass`) VALUES (?, ?, ?)';

    $stmt = $pdo->prepare($sql);

    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt->execute([
        $_POST['name'],$_POST['email'],$pass_hash
    ]);
}
?>

<h1>Register</h1>

<form method="POST" action="index.php?categorie=register">
    <label for="name">Nom d'utilisateur</label>
    <input id="name" name="name" value="" required>

    <label for="email">email</label>
    <input id="email" name="email" value="" required>

    <label for="password">Mot de passe</label>
    <input id="password" name="password" value="" type="password" required>

    <button type="submit">S'inscrire</button>
</form>
