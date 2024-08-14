<?php
function listarRutas($conn) {
    $stmt = $conn->prepare("SELECT rutas.*, COUNT(chat_usos.id) as usos FROM rutas LEFT JOIN chat_usos ON rutas.id = chat_usos.ruta_id GROUP BY rutas.id");
    $stmt->execute();

    echo "<h2>Listado de Rutas</h2>";
    echo "<table border='1'>
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
                    <form action='procesar_ruta.php' method='post' style='display:inline;'>
                        <input type='hidden' name='ruta_id' value='{$row['id']}'>
                        <input type='submit' name='submit' value='Editar' onclick='editarRuta({$row['id']}, \"{$row['ruta']}\", \"{$row['opcion']}\", \"{$row['respuesta']}\")'>
                    </form>
                    <form action='procesar_ruta.php' method='post' style='display:inline;'>
                        <input type='hidden' name='ruta_id' value='{$row['id']}'>
                        <input type='submit' name='submit' value='Eliminar'>
                    </form>
                </td>
                <td>{$row['usos']}</td>
            </tr>";
    }

    echo "</table>";
}
?>
