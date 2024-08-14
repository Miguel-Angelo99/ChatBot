<?php
require_once 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica las credenciales del administrador
    $admin_authenticated = isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'];

    if ($admin_authenticated) {
        $ruta_id = isset($_POST['ruta_id']) ? $_POST['ruta_id'] : '';
        $ruta = isset($_POST['ruta']) ? $_POST['ruta'] : '';
        $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';
        $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';
        $submit_type = isset($_POST['submit']) ? $_POST['submit'] : '';

        // Procesa la acción según el tipo de submit
        switch ($submit_type) {
            case 'Crear Ruta':
                crearRuta($conn, $ruta, $opcion, $respuesta);
                break;
            case 'Eliminar Ruta':
                eliminarRuta($conn, $ruta_id);
                break;
            default:
                // Acción predeterminada: Editar Ruta
                editarRuta($conn, $ruta_id, $ruta, $opcion, $respuesta);
                
                // Incrementa el contador de usos de la ruta
                incrementarContadorUsos($conn, $ruta_id);
                break;
        }

        // Redirige de nuevo a admin.php después de procesar la acción
        header("Location: admin.php");
        exit();
    } else {
        // Redirige a la página de inicio de sesión si no está autenticado
        header("Location: login.php");
        exit();
    }
}

// Función para crear una nueva ruta
function crearRuta($conn, $ruta, $opcion, $respuesta) {
    $stmt = $conn->prepare("INSERT INTO rutas (ruta, opcion, respuesta) VALUES (:ruta, :opcion, :respuesta)");
    $stmt->bindParam(':ruta', $ruta);
    $stmt->bindParam(':opcion', $opcion);
    $stmt->bindParam(':respuesta', $respuesta);
    $stmt->execute();
}

// Función para editar una ruta existente
function editarRuta($conn, $ruta_id, $ruta, $opcion, $respuesta) {
    $stmt = $conn->prepare("UPDATE rutas SET ruta = :ruta, opcion = :opcion, respuesta = :respuesta WHERE id = :id");
    $stmt->bindParam(':id', $ruta_id);
    $stmt->bindParam(':ruta', $ruta);
    $stmt->bindParam(':opcion', $opcion);
    $stmt->bindParam(':respuesta', $respuesta);
    $stmt->execute();
}

// Función para eliminar una ruta
function eliminarRuta($conn, $ruta_id) {
    $stmt = $conn->prepare("DELETE FROM rutas WHERE id = :id");
    $stmt->bindParam(':id', $ruta_id);
    $stmt->execute();
}

// Función para incrementar el contador de usos de una ruta
function incrementarContadorUsos($conn, $ruta_id) {
    $stmt = $conn->prepare("INSERT INTO chat_usos (ruta_id) VALUES (:ruta_id)");
    $stmt->bindParam(':ruta_id', $ruta_id);
    $stmt->execute();
}
?>
