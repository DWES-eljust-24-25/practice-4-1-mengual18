<?php
<<<<<<< HEAD
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

=======
declare(strict_types=1);
session_start();
require_once __DIR__ . '/functions.php';

// Incluir el archivo de datos
$contacts = require_once __DIR__.'/data.php';

$contact = []; // Array para almacenar los datos del formulario
$errors = []; // Array para almacenar los mensajes de error

// Inicializar variables para el formulario
$id = '';
$title = 'Sr.'; // Valor predeterminado
$name = '';
$surname = '';
$birthdate = '';
$phone = '';
$email = '';

// Verifica si hay un ID en la URL para cargar datos de contacto
if (isset($_GET['id'])) {
    $contactId = $_GET['id'];
    foreach ($contacts as $contactData) {
        if ($contactData['id'] == $contactId) {
            // Asignar valores a las variables del formulario
            $id = $contactData['id'];
            $title = $contactData['title'];
            $name = $contactData['name'];
            $surname = $contactData['surname'];
            $birthdate = $contactData['birthdate'];
            $phone = $contactData['phone'];
            $email = $contactData['email'];
            break;
        }
    }
}

// Procesa el formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact['id'] = $id; // ID, solo lo mostramos como readonly
    $contact['title'] = $_POST['title'] ?? 'Sr.'; // Título predeterminado
    $contact['name'] = trim(strip_tags($_POST['name']));
    $contact['surname'] = trim(strip_tags($_POST['surname']));
    $contact['birthdate'] = trim($_POST['birthdate']);
    $contact['phone'] = trim(strip_tags($_POST['phone']));
    $contact['email'] = trim(strip_tags($_POST['email']));
    $contact['favourite'] = isset($_POST['favourite']);
    $contact['important'] = isset($_POST['important']);
    $contact['archived'] = isset($_POST['archived']);

    $errors = validateContact($contact); // Llama a la función de validación

    if (empty($errors)) {
>>>>>>> e052ca43b8909e5ec0935e5280942f9c226a69d4
        // Almacena el contacto en la sesión y redirige
        $_SESSION['contact'] = $contact;
        header("Location: checkdata.php");
        exit();
<<<<<<< HEAD
    } else {
        // Aquí puedes manejar los errores (por ejemplo, mostrando mensajes)
        var_dump($errors); // Depuración de errores
    }
}
=======
    }
}

// Incluir el archivo del encabezado
include 'header.php'; 
>>>>>>> e052ca43b8909e5ec0935e5280942f9c226a69d4
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
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
=======
    <title>Contacto</title>
    <link rel="stylesheet" type="text/css" href="./main.css">
</head>
<body>
<h1>Nuevo Contacto</h1>

<!-- Tabla que contiene el formulario -->
<table border="2" style="width: 30%; border-collapse: collapse;">
    <tr>
        <td>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (isset($_GET['id']) ? "?id=" . htmlspecialchars($id) : ''); ?>">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="<?= htmlspecialchars($id); ?>" readonly><br><br>

                <label>Título:</label>
                <input type="radio" id="title_mr" name="title" value="Sr." <?= ($title === 'Sr.') ? 'checked' : '' ?>>
                <label for="title_mr">Sr.</label>
                <input type="radio" id="title_mrs" name="title" value="Sra." <?= ($title === 'Sra.') ? 'checked' : '' ?>>
                <label for="title_mrs">Sra.</label><br><br>
                <input type="radio" id="title_mrs" name="title" value="Srta." <?= ($title === 'Srta.') ? 'checked' : '' ?>>
                <label for="title_mrs">Srta.</label><br><br>

                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($name); ?>">
                <span class="error"><?= $errors['name'] ?? '' ?></span><br><br>

                <label for="surname">Apellidos:</label>
                <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($surname); ?>">
                <span class="error"><?= $errors['surname'] ?? '' ?></span><br><br>

                <label for="birthdate">Fecha de nacimiento:</label>
                <input type="date" id="birthdate" name="birthdate" value="<?= htmlspecialchars($birthdate); ?>"><br><br>

                <label for="phone">Teléfono:</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($phone); ?>">
                <span class="error"><?= $errors['phone'] ?? '' ?></span><br><br>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?= htmlspecialchars($email); ?>">
                <span class="error"><?= $errors['email'] ?? '' ?></span><br><br>

                <label>Tipo:</label><br>
                <input type="checkbox" id="favourite" name="favourite" <?= isset($contact['favourite']) ? 'checked' : '' ?>>
                <label for="favourite">Favorita</label>
                <input type="checkbox" id="important" name="important" <?= isset($contact['important']) ? 'checked' : '' ?>>
                <label for="important">Importante</label>
                <input type="checkbox" id="archived" name="archived" <?= isset($contact['archived']) ? 'checked' : '' ?>>
                <label for="archived">Archivado</label><br><br>

                <input type="submit" value="Guardar">
                <input type="submit" name="update" value="Actualizar" <?= empty($id) ? 'disabled' : ''; ?>>
                <input type="submit" name="delete" value="Suprimir" <?= empty($id) ? 'disabled' : ''; ?>>
            </form>
        </td>
    </tr>
</table>

<?php
// Incluir el archivo del pie de página
include 'footer.php'; 
?>

>>>>>>> e052ca43b8909e5ec0935e5280942f9c226a69d4
</body>
</html>
