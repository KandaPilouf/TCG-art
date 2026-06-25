<?php
require './app/model/catalogue.php';

function catalogue_index($pdo)
{
    $q = $_GET['q'] ?? '';
    $tags = $_GET['tags'] ?? '';
    $style = $_GET['style'] ?? '';
    $universe = $_GET['universe'] ?? '';
    $color = $_GET['color'] ?? '';

    $data = [];
    $data['tags'] = get_tags($pdo);
    $data['styles'] = get_styles($pdo);
    $data['universes'] = get_universes($pdo);
    $data['colors'] = get_colors($pdo);
    $data['cards'] = filter_cards($pdo, $q, $tags, $style, $universe, $color);

    if (!empty($_SESSION['is_connected'])) {
        $data['user_decks'] = get_user_decks($pdo, $_SESSION['user_id']);
    }

    return render("app/views/catalogue.php", $data);
}

function catalogue_show($pdo, $slug)
{
    $data = [];
    $data['card'] = get_one_item($pdo, $slug);

    if (!empty($_SESSION['is_connected'])) {
        $data['user_decks'] = get_user_decks($pdo, $_SESSION['user_id']);
        $data['decks_with_card'] = get_decks_with_card($pdo, $_SESSION['user_id'], $data['card']['id']);
    }

    return render("app/views/item.php", $data);
}
