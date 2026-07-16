<?php
require './app/model/catalogue.php';
require './app/model/decks.php'; // get_user_decks

function catalogue_index($pdo)
{
    $q = $_GET['q'] ?? '';
    $tags = $_GET['tags'] ?? '';
    $style = $_GET['style'] ?? '';
    $universe = $_GET['universe'] ?? '';
    $color = $_GET['color'] ?? '';
    $artist = $_GET['artist'] ?? '';

    $data = [];
    $data['tags'] = get_tags($pdo);
    $data['styles'] = get_styles($pdo);
    $data['universes'] = get_universes($pdo);
    $data['colors'] = get_colors($pdo);
    $data['artists'] = get_artists($pdo);
    $data['cards'] = filter_cards($pdo, $q, $tags, $style, $universe, $color, $artist);

    // Featured card only on the unfiltered catalogue (no focal hero while searching).
    if ($q === '' && $tags === '' && $style === '' && $universe === '' && $color === '' && $artist === '') {
        $data['featured'] = get_featured_card($pdo);
    }

    if (!empty($_SESSION['is_connected'])) {
        $data['user_decks'] = get_user_decks($pdo, $_SESSION['user_id']);
    }

    return render("app/views/catalogue.php", $data);
}

function catalogue_show($pdo, $slug)
{
    $data = [];
    $data['card'] = get_one_item($pdo, $slug);

    if (!$data['card']) {
        throw new RuntimeException('Card not found: ' . $slug);
    }

    $data['related'] = get_related_cards($pdo, $data['card']);

    if (!empty($_SESSION['is_connected'])) {
        $data['user_decks'] = get_user_decks($pdo, $_SESSION['user_id']);
        $data['decks_with_card'] = get_decks_with_card($pdo, $_SESSION['user_id'], $data['card']['id']);
    }

    return render("app/views/item.php", $data);
}
