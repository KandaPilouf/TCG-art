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

function decks_add($pdo){
    require_connected();

    if (is_post()){
        $name = $_POST['new_deck'];
        $user_id = $_SESSION['user_id'];
        add_deck($pdo, $user_id, $name);
    }
    redirect('/decks');
}