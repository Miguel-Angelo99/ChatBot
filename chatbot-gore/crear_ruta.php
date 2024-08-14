<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario y agregar la nueva ruta a la base de datos
    $ruta = filter_input(INPUT_POST, 'ruta', FILTER_SANITIZE_STRING);
    $opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_STRING);
    $respuesta = filter_input(INPUT_POST, 'respuesta', FILTER_SANITIZE_STRING);

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO rutas (ruta, opcion, respuesta) VALUES (:ruta, :opcion, :respuesta)");
    $stmt->bindParam(':ruta', $ruta, PDO::PARAM_STR);
    $stmt->bindParam(':opcion', $opcion, PDO::PARAM_STR);
    $stmt->bindParam(':respuesta', $respuesta, PDO::PARAM_STR);

    // Intentar ejecutar la consulta y manejar errores
    try {
        $stmt->execute();
        echo "Ruta creada exitosamente";
    } catch (PDOException $e) {
        echo "Error al crear la ruta: " . $e->getMessage();
    }

}

// Redirigir de nuevo a la página de administración
header('Location: admin.php');
exit();
?>
