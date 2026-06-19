<?php
function find_user_by_email($pdo, $email) {
    $stmt = $pdo->prepare('SELECT id, name, email, pass, is_admin FROM user WHERE email = ?');
    $stmt->execute([$email]);
    return $stmt->fetch();
}
?>