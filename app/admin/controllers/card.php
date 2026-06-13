<?php

require './app/admin/model/card.php';

function card_add($pdo)
{

    if (is_post()) {
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $img = $_POST['img'];
        $artist = $_POST['artist'];
        $style = $_POST['style'];
        $variant = $_POST['variant'];
        $color = $_POST['color'];
        $universe = $_POST['universe'];
        $date = $_POST['date'];

        add_card($pdo, $name, $slug, $img, $artist, $style, $variant, $color, $universe, $date);
    }

    $data = [];
    $data['styles'] = get_styles($pdo);
    $data['universes'] = get_universe($pdo);
    $data['colors'] = get_color($pdo);
    $data['variants'] = get_variant($pdo);
    return render("app/admin/views/card_add.php", $data);
}

function card_delete($pdo)
{
    $data = [];
    return render("app/admin/views/card_delete.php");
}
