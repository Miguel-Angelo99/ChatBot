<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getMesg = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);

    // Consultar la base de datos usando el controlador intermedio
    $response = getChatbotResponse($getMesg, $conn);

    echo json_encode($response);
}

function getChatbotResponse($query, $conn) {
    // Intentar encontrar una ruta que coincida con la consulta del usuario
    $stmt = $conn->prepare("SELECT id, ruta, opcion, respuesta FROM rutas WHERE ruta = :query");
    $stmt->bindParam(':query', $query, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $response = [
            'replies' => "¡Has seleccionado la ruta '{$result['ruta']}'! ¿Qué opción deseas?",
            'suggestions' => getOptionsForRoute($result['id'], $conn)
        ];
    } else {
        // Si no hay coincidencia, mostrar un mensaje predeterminado
        $response = [
            'replies' => "Lo siento, no entendí. Por favor, intenta de nuevo.",
            'suggestions' => []
        ];
    }

    return $response;
}

function getOptionsForRoute($routeId, $conn) {
    // Obtener las opciones disponibles para la ruta seleccionada
    $stmt = $conn->prepare("SELECT opcion FROM rutas WHERE ruta_id = :routeId");
    $stmt->bindParam(':routeId', $routeId, PDO::PARAM_INT);
    $stmt->execute();

    $options = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $options[] = $row['opcion'];
    }

    return $options;
}
?>
