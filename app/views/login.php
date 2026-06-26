    <h1>Login</h1>
    
    <form method="POST" action="/login">
        <label for="email">Email</label>
        <input id="email" name="email" value="" required>

        <label for="password">Mot de passe</label>
        <input id="password" name="password" value="" type="password" required>

        <?php if (!empty($error)){ ?>
            <p class="error"><?php echo ($error); ?></p>
        <?php }?>

        <button type="submit">Se connecter</button>
    </form>