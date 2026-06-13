<?php
require "app/model/admin.php";
require "core/auth.php";

function home_index($pdo){
    require_admin();
    $data = [];
    return render("app/admin/views/index.php", $data);
}