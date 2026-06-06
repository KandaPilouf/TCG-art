<?php
require './app/model/login.php';
function login_index($pdo){
    $error = null;

    if (is_post()) {
        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        $user = find_user_by_email($pdo, $email);

        if ($user && password_verify($password, $user['pass'])) {
            $_SESSION['user_id']      = $user['id'];
            $_SESSION['name']         = $user['name'];
            $_SESSION['is_connected'] = 1;
            $_SESSION['is_admin']     = (int) $user['is_admin'];

            redirect($_SESSION['is_admin'] == 1 ? '/profile' : '/home');
        }
        $error = 'Email ou mot de passe invalide';
    }
    return render('app/views/login.php', ['error' => $error]);
}

function login_logout(){
    $_SESSION = [];
    session_destroy();
    redirect('/home');
}
?>