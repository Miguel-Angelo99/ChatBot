<?php
function getChatbotResponse($getMesg, $conn) {
    $stmt = $conn->prepare("SELECT respuesta FROM rutas WHERE ruta LIKE :getMesg OR opcion LIKE :getMesg");
    $stmt->bindParam(':getMesg', '%' . $getMesg . '%', PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ['replies' => $result['respuesta'], 'suggestions' => []];
    } else {
        return ["replies" => "Se acabaron los deseos, <^'_^>", "suggestions" => []];
    }
}

// chatbot_query_controller.php

function obtenerRutas($conn) {
    $stmt = $conn->query("SELECT * FROM rutas");
    $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rutas;
}

?>
