<?php
require 'app/model/register.php';
require 'app/model/login.php'; // find_user_by_email

function register_index($pdo)
{
    $error = null;

    if (is_post()) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['password_confirm'];

        if (!empty(find_user_by_email($pdo, $email))) {
            $error = "Email already used";
        } else if ($password !== $confirm) {
            $error = 'Password dont match!';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            create_user($pdo, $name, $email, $hash);
            redirect("/login");
        }
    }

    $data = [];
    $data['error'] = $error;
    return render('app/views/register.php', $data);
}
