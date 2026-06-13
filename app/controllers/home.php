<?php
require 'app/model/home.php';

function home_index($pdo){
    $data = [];
    $data['card'] = get_random_card($pdo);
    $data['cards'] = get_all_cards($pdo);
    return render("app/views/home.php", $data);
}

?>