<?php
function get_user_decks($pdo, $id)
{
    $sql = "SELECT id,name FROM deck WHERE id_user = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function get_user_deck($pdo, $deck_id)
{
    $sql = "SELECT id, name, id_user FROM deck WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$deck_id]);
    return $stmt->fetch();
}

function get_deck_cards($pdo, $deck_id)
{

    $sql = "SELECT card.name, card.slug, card.img, artist.artist AS artist, card.id
            FROM card
            JOIN card_deck ON card_deck.id_card = card.id
            LEFT JOIN artist ON artist.id = card.artist_id
            WHERE card_deck.id_deck = ?
            AND card.is_deleted = 0";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$deck_id]);
    return $stmt->fetchAll();
}

function add_deck($pdo, $user_id, $name)
{

    $sql = "INSERT INTO deck (id_user, name) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $name]);
}

function add_card_to_deck($pdo, $deck_id, $card_id)
{

    $sql = "INSERT INTO card_deck (id_card, id_deck) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$card_id, $deck_id]);
}

function remove_card_from_deck($pdo, $card_id, $deck_id)
{
    $sql = "DELETE FROM card_deck WHERE id_deck = ? AND id_card = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$deck_id, $card_id]);
}
