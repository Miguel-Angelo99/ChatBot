<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbot";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Función para verificar las credenciales del administrador
    function verificarCredenciales($conn, $nombreUsuario, $contrasena) {
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?");
        $stmt->execute([$nombreUsuario, $contrasena]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>
