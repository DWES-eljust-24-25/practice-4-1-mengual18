<?php
// Iniciar la sesión
session_start();

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
