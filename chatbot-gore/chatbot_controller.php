<?php
// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbot";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener rutas al iniciar o reiniciar el chat
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['text']) && $_POST['text'] == 'iniciar') {
    $welcomeMessage = "¡Hola! Soy Clarita, tu asistente virtual. ¿En qué puedo ayudarte hoy?";

    $sql = "SELECT DISTINCT ruta FROM rutas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rutas = [];
        while ($row = $result->fetch_assoc()) {
            $rutas[] = $row["ruta"];
        }
        echo json_encode(['replies' => [$welcomeMessage], 'rutas' => $rutas]);
        exit();
    } else {
        echo json_encode(['replies' => [$welcomeMessage]]);
        exit();
    }
}

// Lógica para procesar el mensaje del usuario y obtener la respuesta del chatbot
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['text'])) {
    $userMessage = $_POST['text'];

    // Obtener información sobre la ruta seleccionada
    $sql = "SELECT * FROM rutas WHERE ruta = '$userMessage'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rutaId = $row['id']; // Obtén el ID de la ruta

        // Incrementar el contador de usos
        incrementarContadorUsos($conn, $rutaId);

        $respuesta = [
            'replies' => ["Seleccionaste {$row['ruta']}."],
            'ruta_id' => $rutaId,
            'enlace' => $row['respuesta'],  // Agrega el enlace a la respuesta
        ];

        // Verificar si hay opciones de continuación
        $sqlOpciones = "SELECT DISTINCT opcion FROM rutas WHERE ruta = '{$row['ruta']}'";
        $resultOpciones = $conn->query($sqlOpciones);

        if ($resultOpciones->num_rows > 0) {
            $opciones = [];
            while ($rowOpcion = $resultOpciones->fetch_assoc()) {
                $opciones[] = $rowOpcion["opcion"];
            }
            $respuesta['suggestions'] = $opciones;
        }
    } else {
        $respuesta = ['replies' => ["No se encontró información para la ruta: $userMessage"]];
    }

    echo json_encode($respuesta);
    exit();
}

// Lógica para procesar la opción seleccionada y obtener la respuesta del chatbot
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcion'])) {
    $userOption = $_POST['opcion'];

    // Obtener información sobre la respuesta asociada a la opción seleccionada
    $sql = "SELECT * FROM rutas WHERE opcion = '$userOption'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $respuesta = ['replies' => [$row['respuesta']]];

        // Incrementar el contador de usos
        incrementarContadorUsos($conn, $row['id']);
    } else {
        $respuesta = ['replies' => ["No se encontró información para la opción: $userOption"]];
    }

    echo json_encode($respuesta);
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();

// Función para incrementar el contador de usos de una ruta
function incrementarContadorUsos($conn, $rutaId) {
    $stmt = $conn->prepare("INSERT INTO chat_usos (ruta_id) VALUES (?)");
    $stmt->bind_param('i', $rutaId);
    $stmt->execute();
}
?>
