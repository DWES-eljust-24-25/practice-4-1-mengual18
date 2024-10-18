<?php
<<<<<<< HEAD
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
=======
// Incluir el archivo de datos
$contacts = require_once __DIR__.'/data.php';

function showTable($contacts) {
    // Comienza la tabla
    echo '<table border="1" style="border-collapse: collapse; width: 30%;">';
    echo '<tr>
>>>>>>> e052ca43b8909e5ec0935e5280942f9c226a69d4
            <th>ID</th>
            <th>Título</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Acciones</th>
<<<<<<< HEAD
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

=======
          </tr>';

    foreach ($contacts as $contact) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($contact['id']) . '</td>';
        echo '<td>' . htmlspecialchars($contact['title']) . '</td>';
        echo '<td>' . htmlspecialchars($contact['name']) . '</td>';
        echo '<td>' . htmlspecialchars($contact['surname']) . '</td>';
        echo '<td>
                <a href="contact_form.php?id=' . $contact['id'] . '">Editar/Ver</a>
              </td>';
        echo '</tr>';
    }
    
    echo '</table>';
}

// Incluir el archivo del encabezado
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Contactos</title>
    <!link rel="stylesheet" href="style.css"> <!-- Opcional: CSS para estilos -->
    <style>
        table {
            border-collapse: separate;
            width: 30%;
            margin-top: 20px;
        }
        th, td {
            border: 1px 20% #dddddd;
            text-align: center;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Lista de Contactos                    </h1>
    <a href="contact_form.php">Crear un nuevo contacto</a>
    <?php showTable($contacts); ?>
    <br>
>>>>>>> e052ca43b8909e5ec0935e5280942f9c226a69d4
    <?php
    // Incluir el archivo del pie de página
    include 'footer.php'; 
    ?>
</body>
</html>
