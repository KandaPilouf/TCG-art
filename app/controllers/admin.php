<?php
require "app/model/admin.php";
require "core/auth.php";

function admin_index($pdo){
    require_admin();
    $data = [];
    return render("app/views/admin.php", $data);
}

function admin_add($pdo){
    require_admin();
    $data = [];
    if(is_post()){
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $img= $_POST['img'];
        $artist = $_POST['artist'];

        add_card($pdo, $name, $slug, $img, $artist);
    }
    return render("app/views/admin_add.php", $data);
}
?>