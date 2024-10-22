<?php
session_start();

if (!isset($_SESSION['contact'])) {
    header("Location: contact_form.php");
    exit();
}

$contact = $_SESSION['contact'];

// Incluir el archivo del encabezado
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Datos del Contacto</title>
</head>
<body>
<h1>Datos del Nuevo Contacto</h1>

<p>No hay errores. Los datos son:</p>
<ul>
    <li>ID: <?= htmlspecialchars($contact['id']) ?></li>
    <li>Título: <?= htmlspecialchars($contact['title']) ?></li>
    <li>Nombre: <?= htmlspecialchars($contact['name']) ?></li>
    <li>Apellidos: <?= htmlspecialchars($contact['surname']) ?></li>
    <li>Fecha de Nacimiento: <?= htmlspecialchars($contact['birthdate']) ?></li>
    <li>Teléfono: <?= htmlspecialchars($contact['phone']) ?></li>
    <li>Email: <?= htmlspecialchars($contact['email']) ?></li>
    <li>Favorita: <?= isset($contact['favourite']) ? 'Sí' : 'No' ?></li>
    <li>Importante: <?= isset($contact['important']) ? 'Sí' : 'No' ?></li>
    <li>Archivado: <?= isset($contact['archived']) ? 'Sí' : 'No' ?></li>
</ul>

<a href="contact_form.php">Regresar al formulario</a>

<?php
// Limpia la sesión después de mostrar los datos
unset($_SESSION['contact']);
?>

<?php
// Incluir el archivo del pie de página
include 'footer.php'; 
?>

</body>
</html>

