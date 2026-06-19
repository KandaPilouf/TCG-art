<H1>Hello register</H1>

<form action="/register" method="POST">
    <label for="name"></label>
    <input type="text" name="name" id="name" placeholder="name" value="" required>

    <label for="email" id="email"></label>
    <input type="text" name="email" id="email" placeholder="email" value="" required>

    <label for="password" id="password"></label>
    <input type="password" name="password" id="password" placeholder="password" value="" required>

    <label for="password_confirm" id="password_confirm"></label>
    <input type="password" name="password_confirm" id="password_confirm" placeholder="confirm your password" value="" required>

    <button type="submit">Submit</button>
</form>

<?php
if($error !== null){
    var_dump($error);
}
?>