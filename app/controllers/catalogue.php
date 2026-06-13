<?php
require './app/model/catalogue.php';

function catalogue_index($pdo)
{

    $q = $_GET['q'] ?? '';
    $data = [];

    if (!empty($q)) {
        $data['cards'] = search_cards($pdo, $q);
    } else {
        $data['cards'] = get_all_items($pdo);
    }

    return render("app/views/catalogue.php", $data);
}

function catalogue_show($pdo, $slug)
{
    $data = [];
    $data['card'] = get_one_items($pdo, $slug);
    return render("app/views/item.php", $data);
}
