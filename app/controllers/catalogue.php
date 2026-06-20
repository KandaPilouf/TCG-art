<?php
require './app/model/catalogue.php';

function catalogue_index($pdo)
{

    $q = $_GET['q'] ?? '';
    $data = [];
    $data['tags'] = get_tags($pdo);
    $data['styles'] = get_styles($pdo);
    $data['universes'] = get_universes($pdo);

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
    $data['card'] = get_one_item($pdo, $slug);
    return render("app/views/item.php", $data);
}
