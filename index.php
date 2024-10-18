<?php
// Iniciar la sesión
session_start();
<<<<<<< HEAD

// Incluir el archivo del encabezado
$pageTitle = "Aplicación de Contactos"; // Variable para el título
include 'header.php'; 
?>

<h1>Aplicación de Contactos</h1>

<h2>Formulario de Contacto</h2>
<?php include 'contact_form.php'; ?>

<h2>Lista de Contactos</h2>
<?php include 'contact_list.php'; ?>

<?php include 'footer.php'; ?>
=======
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido a la Aplicación de Contactos</h1>
    <h2>Opciones:</h2>
    <ul>
        <li><a href="contact_form.php">Agregar Contacto</a></li>
        <li><a href="contact_list.php">Lista de Contactos</a></li>
    </ul>
</body>
</html>

>>>>>>> e052ca43b8909e5ec0935e5280942f9c226a69d4
