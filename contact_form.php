<?php
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
        // Almacena el contacto en la sesión y redirige
        $_SESSION['contact'] = $contact;
        header("Location: checkdata.php");
        exit();
    }
}

// Incluir el archivo del encabezado
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" type="text/css" href="./main.css">
</head>
<body>
<h1>Contacto</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (isset($_GET['id']) ? "?id=" . htmlspecialchars($id) : ''); ?>">
    <label for="id">ID:</label>
    <input type="text" id="id" name="id" value="<?= htmlspecialchars($id); ?>" readonly><br><br>

    <label>Título:</label>
    <input type="radio" id="title_mr" name="title" value="Sr." <?= ($title === 'Sr.') ? 'checked' : '' ?>>
    <label for="title_mr">Sr.</label>
    <input type="radio" id="title_mrs" name="title" value="Sra." <?= ($title === 'Sra.') ? 'checked' : '' ?>>
    <label for="title_mrs">Sra.</label><br><br>

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

<?php
// Incluir el archivo del pie de página
include 'footer.php'; 
?>

</body>
</html>
