<?php
require './app/model/catalogue.php';

function catalogue_index($pdo){
    $data = [];
    $data ['cards'] = get_all_items($pdo);
    return render("app/views/catalogue.php", $data);
}

function catalogue_show($pdo, $slug){
    $data = [];
    $data ['card'] = get_one_items($pdo, $slug);
    return render("app/views/item.php", $data);
}
?>