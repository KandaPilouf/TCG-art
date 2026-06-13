<?php

function get_styles($pdo)
{
    $sql = "SELECT id, style FROM style";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_universe($pdo)
{
    $sql = "SELECT id, universe FROM universe";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_variant($pdo)
{
    $sql = "SELECT id, variant FROM variant";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_color($pdo)
{
    $sql = "SELECT id, color FROM color";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function add_card($pdo, $name, $slug, $img, $artist, $style, $variant, $color, $universe, $date)
{
    $stmt = $pdo->prepare("INSERT INTO `card` (`id`, `name`, `slug`, `artist`, `img`, `style_id`, `universe_id`, `creation_date`, `variant_id`, `primary_color_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    $stmt->execute([$name, $slug, $artist, $img, $style, $universe, $date, $variant, $color]);
}
