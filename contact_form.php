<?php
session_start();

// Incluir la clase Contact
require_once 'Contact.php';

// Inicializar variable de errores
$errors = [];

// Procesa el formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear un nuevo objeto Contact
    $contact = new Contact([
        'id' => isset($_POST['id']) ? intval($_POST['id']) : 0, // Aseguramos que el ID sea un entero
        'title' => $_POST['title'] ?? 'Sr.', // Título predeterminado
        'name' => trim(strip_tags($_POST['name'])),
        'surname' => trim(strip_tags($_POST['surname'])),
        'birthdate' => trim($_POST['birthdate']),
        'phone' => trim(strip_tags($_POST['phone'])),
        'email' => trim(strip_tags($_POST['email'])),
        'favourite' => isset($_POST['favourite']),
        'important' => isset($_POST['important']),
        'archived' => isset($_POST['archived'])
    ]);

    $errors = $contact->validate(); // Llama al método de validación de la clase

    

    // Comprobar si hay errores de validación
    if (empty($errors)) {
        // Comprobar la validez de la fecha de contacto
        if (!$contact->checkContactDate()) {
            $errors['birthdate'] = "* La fecha de nacimiento no es válida.";
        }

        // Si no hay errores, verificar el cumpleaños
        $daysUntilBirthday = $contact->checkBirthday();
        
        if ($daysUntilBirthday === 0) {
            echo "¡Hoy es el cumpleaños de " . htmlspecialchars($contact->getName()) . "!";
        } elseif ($daysUntilBirthday > 0 && $daysUntilBirthday <= 7) {
            echo "Quedan $daysUntilBirthday días para el cumpleaños de " . htmlspecialchars($contact->getName()) . ".";
        }

        // Almacena el contacto en la sesión y redirige
        $_SESSION['contact'] = $contact;
        header("Location: checkdata.php");
        exit();
    } else {
        // Aquí puedes manejar los errores (por ejemplo, mostrando mensajes)
        var_dump($errors); // Depuración de errores
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Formulario de Contacto</h1>
    
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= isset($contact) ? htmlspecialchars($contact->getId()) : 0; ?>">
        
        <label for="title">Título:</label>
        <select name="title" id="title">
            <option value="Mr." <?= (isset($contact) && $contact->getTitle() == 'Mr.') ? 'selected' : ''; ?>>Sr.</option>
            <option value="Ms." <?= (isset($contact) && $contact->getTitle() == 'Ms.') ? 'selected' : ''; ?>>Sra.</option>
            <option value="Dr." <?= (isset($contact) && $contact->getTitle() == 'Dr.') ? 'selected' : ''; ?>>Dr.</option>
        </select><br>

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?= isset($contact) ? htmlspecialchars($contact->getName()) : ''; ?>">
        <span class="error"><?= $errors['name'] ?? ''; ?></span><br>

        <label for="surname">Apellidos:</label>
        <input type="text" name="surname" id="surname" value="<?= isset($contact) ? htmlspecialchars($contact->getSurname()) : ''; ?>">
        <span class="error"><?= $errors['surname'] ?? ''; ?></span><br>

        <label for="birthdate">Fecha de Nacimiento:</label>
        <input type="date" name="birthdate" id="birthdate" value="<?= isset($contact) ? htmlspecialchars($contact->getBirthdate()) : ''; ?>">
        <span class="error"><?= $errors['birthdate'] ?? ''; ?></span><br>

        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" id="phone" value="<?= isset($contact) ? htmlspecialchars($contact->getPhone()) : ''; ?>">
        <span class="error"><?= $errors['phone'] ?? ''; ?></span><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= isset($contact) ? htmlspecialchars($contact->getEmail()) : ''; ?>">
        <span class="error"><?= $errors['email'] ?? ''; ?></span><br>

        <label>
            <input type="checkbox" name="favourite" <?= (isset($contact) && $contact->isFavourite()) ? 'checked' : ''; ?>> Favorito
        </label><br>

        <label>
            <input type="checkbox" name="important" <?= (isset($contact) && $contact->isImportant()) ? 'checked' : ''; ?>> Importante
        </label><br>

        <label>
            <input type="checkbox" name="archived" <?= (isset($contact) && $contact->isArchived()) ? 'checked' : ''; ?>> Archivado
        </label><br>

        <button type="submit">Guardar Contacto</button>
    </form>

    <br>
    <a href="contact_list.php">Volver a la lista de contactos</a>
</body>
</html>
