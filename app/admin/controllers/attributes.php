<?php

require './app/admin/model/attributes.php';

function attributes_index($pdo)
{
    $data = ['lists' => []];
    foreach (array_keys(attribute_types()) as $type) {
        $data['lists'][$type] = get_attribute_list($pdo, $type);
    }
    return render("app/admin/views/attributes.php", $data);
}

function attributes_add($pdo)
{
    if (is_post()) {
        $type = $_POST['type'] ?? '';
        $value = trim($_POST['value'] ?? '');

        if (!is_valid_attribute_type($type)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Unknown attribute type.'];
        } elseif ($value === '') {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Value cannot be empty.'];
        } elseif (mb_strlen($value) > 100) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Value is too long (max 100 characters).'];
        } elseif (attribute_exists($pdo, $type, $value)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => "\"$value\" already exists."];
        } else {
            add_attribute($pdo, $type, $value);
            $_SESSION['flash'] = ['type' => 'success', 'message' => "Added \"$value\"."];
        }
    }

    redirect('/admin/attributes');
}
