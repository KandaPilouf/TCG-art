<?php
$css_dir = "./styles/css";

$styles = [
    'home.php' => 'home.css',
    'decks.php' => 'decks.css',
    'profile.php' => 'profile.css',
    'contact.php' => 'contact.css',
    'catalogue.php' => 'catalogue.css'
];


if (empty($_GET)) {

    $page = 'home';
} elseif (isset($_GET['categorie'])) {

    $page = $_GET['categorie'];
} elseif (isset($_GET['item'])) {

    $page = 'item';
}

$this_page = $page . '.php';
?>

<link rel="stylesheet" type="text/css" href=<?= "$css_dir/$styles[$this_page]" ?>>
<link rel="stylesheet" type="text/css" href=<?= "$css_dir/typo.css" ?>>