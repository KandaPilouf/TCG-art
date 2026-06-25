<?php
require 'core/auth.php';
require 'app/model/decks.php';

function decks_index($pdo)
{
    require_connected();

    $data = [];
    $data['decks'] = get_user_decks($pdo, $_SESSION['user_id']);
    return render('app/views/decks.php', $data);
}

function decks_add($pdo)
{
    require_connected();

    if (is_post()) {
        $name = $_POST['new_deck'];
        $user_id = $_SESSION['user_id'];
        add_deck($pdo, $user_id, $name);
    }
    redirect('/decks');
}

function decks_show($pdo, $deck_id)
{
    require_connected();

    $deck = get_user_deck($pdo, $deck_id);
    $data = [];

    if (!$deck || $deck['id_user'] !== $_SESSION['user_id']) {
        redirect('/decks');
    }

    $data['deck'] = $deck;
    $data['cards'] = get_deck_cards($pdo, $deck_id);

    return render('app/views/deck_show.php', $data);
}

function decks_add_card($pdo)
{
    require_connected();

    if (is_post()) {
        $card_id = $_POST['card_id'];
        $deck_id = $_POST['deck_id'];

        $deck = get_user_deck($pdo, $deck_id);

        if ($deck && $deck['id_user'] == $_SESSION['user_id']) {
            add_card_to_deck($pdo, $deck_id, $card_id);
        }
    }
    redirect('/catalogue');
}

function decks_remove_card($pdo)
{
    require_connected();

    if (is_post()) {
        $card_id = $_POST['card_id'];
        $deck_id = $_POST['deck_id'];

        $deck = get_user_deck($pdo, $deck_id);

        if ($deck && $deck['id_user'] == $_SESSION['user_id']) {
            remove_card_from_deck($pdo, $card_id, $deck_id);
        }
        redirect('/decks/show/' . $deck_id);
    }
    redirect('/decks');
}
