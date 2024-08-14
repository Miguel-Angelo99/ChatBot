<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_authenticated = isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'];

    if ($admin_authenticated) {
        $rutaId = filter_input(INPUT_POST, 'ruta_id', FILTER_VALIDATE_INT);

        if ($rutaId) {
            $submitType = isset($_POST['submit']) ? $_POST['submit'] : '';

            switch ($submitType) {
                case 'Usar Ruta':
                    usarRuta($conn, $rutaId);
                    break;
                // Agrega más casos según tus necesidades

                default:
                    // Acción predeterminada: Usar Ruta
                    usarRuta($conn, $rutaId);
                    break;
            }
        }
    }
}

// Función para registrar el uso de la ruta en la tabla chat_usos
function usarRuta($conn, $rutaId) {
    $stmt = $conn->prepare("INSERT INTO chat_usos (ruta_id) VALUES (:ruta_id)");
    $stmt->bindParam(':ruta_id', $rutaId, PDO::PARAM_INT);
    $stmt->execute();
}
?>
