<?php
require 'app/model/home.php';
require 'core/auth.php';

function profile_index($pdo){
    require_connected();
    $data = [];
    return render("app/views/profile.php", $data);
}
?>