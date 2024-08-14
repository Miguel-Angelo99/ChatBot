<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Chatbot</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
</head>

<body>

<?php
require_once 'conexion.php';
session_start();

// Función para listar las rutas
function listarRutas($conn) {
    $stmt = $conn->prepare("SELECT rutas.*, COUNT(chat_usos.id) as usos FROM rutas LEFT JOIN chat_usos ON rutas.id = chat_usos.ruta_id GROUP BY rutas.id");
    $stmt->execute();

    echo "<div class='route-list'>
            <h2>Listado de Rutas</h2>
            <table>
                <tr>
                    <th>Ruta</th>
                    <th>Opción</th>
                    <th>Respuesta</th>
                    <th>Acciones</th>
                    <th>Usos</th>
                </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['ruta']}</td>
                <td>{$row['opcion']}</td>
                <td>{$row['respuesta']}</td>
                <td>
                    <button class='edit-button' onclick='editarRuta({$row['id']}, \"{$row['ruta']}\", \"{$row['opcion']}\", \"{$row['respuesta']}\")'>Editar</button>
                    <form action='procesar_ruta.php' method='post' style='display:inline;'>
                        <input type='hidden' name='ruta_id' value='{$row['id']}'>
                        <input type='submit' name='submit' value='Eliminar Ruta' class='delete-button'>
                    </form>
                </td>
                <td>{$row['usos']}</td>
            </tr>";
    }

    echo "</table></div>";
}

// Verifica las credenciales del administrador
$admin_authenticated = isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'];

// Solo muestra el formulario y la lista si el administrador está autenticado
if ($admin_authenticated) {
    echo "<div class='admin-form'>
            <h2>Crear/Editar Ruta</h2>
            <form action='procesar_ruta.php' method='post' onsubmit='return validarFormulario()'>
                <label for='ruta'>Ruta:</label>
                <input type='text' name='ruta' id='ruta' required><br>
                <label for='opcion'>Opción:</label>
                <input type='text' name='opcion' id='opcion' required><br>
                <label for='respuesta'>Respuesta:</label>
                <textarea name='respuesta' id='respuesta' required></textarea><br>
                <div class='button-container'>
                    <input type='submit' name='submit' value='Crear Ruta' class='create-button'>
                    <input type='submit' name='submit' value='Eliminar Ruta' class='delete-button'>
                    <!-- Botón adicional de Actualizar -->
                    <input type='submit' name='submit' value='Actualizar Ruta' class='update-button'>
                    <!-- Botón adicional de Cancelar -->
                    <button type='button' class='cancel-button' onclick='limpiarFormulario()'>Cancelar</button>
                </div>
                <input type='hidden' name='ruta_id' id='ruta_id' value=''>
            </form>
        </div>";

    echo "<script>
            function editarRuta(id, ruta, opcion, respuesta) {
                document.querySelector('#ruta_id').value = id;
                document.querySelector('#ruta').value = ruta;
                document.querySelector('#opcion').value = opcion;
                document.querySelector('#respuesta').value = respuesta;
            }

            // Función para limpiar el formulario al hacer clic en Cancelar
            function limpiarFormulario() {
                document.querySelector('#ruta_id').value = '';
                document.querySelector('#ruta').value = '';
                document.querySelector('#opcion').value = '';
                document.querySelector('#respuesta').value = '';
            }

            // Función para validar el formulario y evitar la creación si no hay cambios
            function validarFormulario() {
                var id = document.querySelector('#ruta_id').value;
                var ruta = document.querySelector('#ruta').value;
                var opcion = document.querySelector('#opcion').value;
                var respuesta = document.querySelector('#respuesta').value;

                // Validar si se está editando y no se han realizado cambios
                if (id !== '' && ruta === '' && opcion === '' && respuesta === '') {
                    alert('No se han realizado cambios.');
                    return false;
                }

                return true;
            }
        </script>";

    // Lista las rutas
    listarRutas($conn);

    // Cierre de sesión
    echo "<a href='logout.php'>Cerrar sesión</a>";
} else {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: login.php");
    exit();
}

?>

</body>
</html>
