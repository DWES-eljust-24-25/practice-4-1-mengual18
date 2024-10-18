<?php
session_start();

// Incluir la clase Contact
require_once 'Contact.php';

// Suponiendo que los contactos se almacenan en la sesión
$contacts = $_SESSION['contacts'] ?? [];

// Incluir el archivo del encabezado
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Contactos</title>
</head>
<body>
    <h1>Lista de Contactos</h1>
    <a href="contact_form.php">Crear un nuevo contacto</a>
    <table border="1" style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= htmlspecialchars($contact->getId()) ?></td>
                <td><?= htmlspecialchars($contact->getTitle()) ?></td>
                <td><?= htmlspecialchars($contact->getName()) ?></td>
                <td><?= htmlspecialchars($contact->getSurname()) ?></td>
                <td>
                    <a href="contact_form.php?id=<?= $contact->getId(); ?>">Editar/Ver</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    // Incluir el archivo del pie de página
    include 'footer.php'; 
    ?>
</body>
</html>
