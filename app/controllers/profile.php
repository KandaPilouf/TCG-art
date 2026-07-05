<?php
require 'app/model/profile.php';
require 'core/auth.php';

function profile_index($pdo)
{
    require_connected();
    $data = [];
    $user_id = $_SESSION['user_id'];
    $data['user'] = get_profile_data($pdo, $user_id);
    return render("app/views/profile.php", $data);
}
