<?php
// functions.php

function validateContact(array $contact): array {
    $errors = [];

    // Validar nombre
    if (empty($contact['name'])) {
        $errors['name'] = "* El nombre es requerido";
    }

    // Validar apellidos
    if (empty($contact['surname'])) {
        $errors['surname'] = "* Los apellidos son requeridos";
    }

    // Validar teléfono
    if (empty($contact['phone'])) {
        $errors['phone'] = "* El teléfono es requerido";
    } elseif (!preg_match("/^[0-9]{9,15}$/", $contact['phone'])) {
        $errors['phone'] = "* El teléfono debe ser un número válido";
    }

    // Validar email
    if (empty($contact['email'])) {
        $errors['email'] = "* El correo electrónico es requerido";
    } elseif (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "* Formato de correo electrónico no válido";
    }

    return $errors;
}
?>

