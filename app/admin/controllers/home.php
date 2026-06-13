<?php

function home_index($pdo){
    $data = [];
    return render("app/admin/views/index.php", $data);
}