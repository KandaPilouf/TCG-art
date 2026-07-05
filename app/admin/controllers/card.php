<?php

require './app/admin/model/card.php';

function card_add($pdo)
{

    if (is_post()) {
        $name = $_POST['name'];
        $slug = unique_slug($pdo, slugify($name));   // auto-generated, guaranteed unique
        $img = $_POST['img'];
        $artist = $_POST['artist'];
        $style = $_POST['style'];
        $variant = $_POST['variant'];
        $color = $_POST['color'];
        $universe = $_POST['universe'];
        $date = $_POST['date'];
        $tags = $_POST['tag'] ?? [];

        add_card($pdo, $name, $slug, $img, $artist, $style, $variant, $color, $universe, $date, $tags);

        $_SESSION['flash'] = ['type' => 'success', 'message' => "Card \"$name\" added."];
        redirect('/admin/card/add');
    }

    $data = [];
    $data['styles'] = get_styles($pdo);
    $data['universes'] = get_universe($pdo);
    $data['colors'] = get_color($pdo);
    $data['variants'] = get_variant($pdo);
    $data['tags'] = get_tags($pdo);
    return render("app/admin/views/card_add.php", $data);
}

function card_edit($pdo, $id = null)
{
    // No id yet: show the list of cards to pick which one to edit.
    if ($id === null) {
        return render("app/admin/views/card_edit_list.php", ['cards' => get_all_cards($pdo)]);
    }

    if (is_post()) {
        update_card(
            $pdo,
            $id,
            $_POST['name'],
            $_POST['slug'],
            $_POST['img'],
            $_POST['artist'],
            $_POST['style'],
            $_POST['variant'],
            $_POST['color'],
            $_POST['universe'],
            $_POST['date'],
            $_POST['tag'] ?? []
        );

        $_SESSION['flash'] = ['type' => 'success', 'message' => "Changes saved for \"{$_POST['name']}\"."];
        redirect('/admin/card/edit/' . $id);
    }

    $card = get_card($pdo, $id);
    if (!$card) {
        return render("app/admin/views/card_edit_list.php", ['cards' => get_all_cards($pdo)]);
    }

    $data = [];
    $data['card'] = $card;
    $data['selected_tags'] = get_card_tag_ids($pdo, $id);
    $data['styles'] = get_styles($pdo);
    $data['universes'] = get_universe($pdo);
    $data['colors'] = get_color($pdo);
    $data['variants'] = get_variant($pdo);
    $data['tags'] = get_tags($pdo);
    return render("app/admin/views/card_edit.php", $data);
}

function card_delete($pdo)
{

    if(is_post()){
        $id = $_POST['id'];
        $card = get_card($pdo, $id);          // fetch name before soft-deleting
        delete_card($pdo, $id);

        $name = $card ? $card['name'] : 'Card';
        $_SESSION['flash'] = ['type' => 'success', 'message' => "\"$name\" deleted."];
        redirect('/admin/card/delete');
    }

    $data = [];
    $data ['cards'] = get_all_cards($pdo);
    return render("app/admin/views/card_delete.php", $data);
}
