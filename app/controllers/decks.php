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
