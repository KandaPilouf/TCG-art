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

function profile_add($pdo)
{
    require_connected();
    if ($_SESSION['is_admin'] === 1) {

        $data = [];
        if (is_post()) {
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $img = $_POST['img'];
            $artist = $_POST['artist'];

            add_card($pdo, $name, $slug, $img, $artist);
        }
        return render("app/views/admin_add.php", $data);
    }
}
