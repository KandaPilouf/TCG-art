<?php

if (isset($_GET['error'])) {

    if ($_GET['error'] === '1') {
        echo '<p>wrong pass.</p>';
    } else if ($_GET['error'] === '2'){
        echo '<p>Email does not exist.</p>';
    }
}
?>

<main>
    <form method="POST" action="./database/connect.php">
        <label for="email">Email</label>
        <input id="email" name="email" value="" required>

        <label for="password">Mot de passe</label>
        <input id="password" name="password" value="" type="password" required>

        <button type="submit">Se connecter</button>
    </form>

    <a href="index.php?categorie=register">Inscription</a><form action=""></form>
</main>