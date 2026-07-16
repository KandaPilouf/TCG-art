<?php

// Lookup-table (attribut) management.
// Injection: les identifiants SQL (table/colonne) viennent uniquement de
// l'allowlist ci-dessous, jamais de l'input. La valeur user est toujours bindée.

function attribute_types()
{
    return [
        'universe' => ['table' => 'universe', 'column' => 'universe', 'label' => 'Universes'],
        'style'    => ['table' => 'style',    'column' => 'style',    'label' => 'Styles'],
        'color'    => ['table' => 'color',    'column' => 'color',    'label' => 'Colors'],
        'variant'  => ['table' => 'variant',  'column' => 'variant',  'label' => 'Variants'],
        'tag'      => ['table' => 'tag',       'column' => 'tag',       'label' => 'Tags'],
        'artist'   => ['table' => 'artist',   'column' => 'artist',   'label' => 'Artists'],
    ];
}

function is_valid_attribute_type($type)
{
    return isset(attribute_types()[$type]);
}

function get_attribute_list($pdo, $type)
{
    $t = attribute_types()[$type];
    // $t['table'] / $t['column'] are constants from the allowlist above, not input.
    $sql = "SELECT id, `{$t['column']}` AS value FROM `{$t['table']}` ORDER BY `{$t['column']}`";
    return $pdo->query($sql)->fetchAll();
}

function attribute_exists($pdo, $type, $value)
{
    $t = attribute_types()[$type];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `{$t['table']}` WHERE `{$t['column']}` = ?");
    $stmt->execute([$value]);
    return (int) $stmt->fetchColumn() > 0;
}

function add_attribute($pdo, $type, $value)
{
    if (!is_valid_attribute_type($type)) {
        return false;
    }
    $t = attribute_types()[$type];
    $stmt = $pdo->prepare("INSERT INTO `{$t['table']}` (`{$t['column']}`) VALUES (?)");
    $stmt->execute([$value]);
    return true;
}
