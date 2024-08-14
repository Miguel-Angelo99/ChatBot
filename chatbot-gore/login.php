<?php
session_start();

// Verifica si el usuario ya está autenticado
if (isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated']) {
    header("Location: admin.php");
    exit();
}

// Verifica las credenciales cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Personaliza con tus detalles de conexión a la base de datos
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "chatbot";

    try {
        // Crea una conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para verificar las credenciales
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Verifica si se encontró un usuario con el nombre proporcionado
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            

            // Verifica la contraseña
            if ($password == $user['contrasena']) {
                // Si las credenciales son correctas, establece la sesión de administrador
                $_SESSION['admin_authenticated'] = true;
            
                // Redirige a la página de administrador
                header("Location: admin.php");
                exit();
            } else {
                // Contraseña incorrecta
                echo "<p class='error-message'>Contraseña incorrecta. Inténtalo de nuevo.</p>";
            }
        } else {
            // Usuario no encontrado
            echo "<p class='error-message'>Usuario no encontrado. Inténtalo de nuevo.</p>";
        }

    } catch (PDOException $e) {
        // Manejo de errores de conexión
        echo "Error de conexión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión como Administrador</h2>

    <form method="post" action="">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</div>

</body>
</html>
