<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot Clarita</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-5g2E3DOAF5B4uQJya7dAB7PLoByMKuhC8BE6TXi2v4JGYwRjAs+gGqPeCK0PfGdRBQe9YDp86XZ1xHId6V8NEQ==" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="title">Preguntale a Clarita</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hola, soy Clarita</p>
                    <p>Una Asistente Virtual y estoy aquí para orientarte con tus consultas</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Escribe algo aquí.." required>
                <button id="send-btn">Enviar</button>
            </div>
        </div>
    </div>

    <script>
    /*$(document).ready(function () {
        // Código AJAX para obtener las rutas al iniciar el chat
        $.ajax({
            url: 'chatbot_controller.php',
            type: 'POST',
            dataType: 'json',
            data: { text: 'iniciar' },
            success: function (result) {
                mostrarRutas(result.rutas);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        // Evento click del botón de enviar
        $("#send-btn").on("click", function () {
            $value = $("#data").val();
            $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value + '</p></div></div>';
            $(".form").append($msg);
            $("#data").val('');

            // Código AJAX para procesar el mensaje del usuario
            $.ajax({
                url: 'chatbot_controller.php',
                type: 'POST',
                dataType: 'json',
                data: { text: $value },
                success: function (result) {
                    $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>' + result.replies + '</p></div></div>';
                    $(".form").append($replay);

                    // Mostrar botones de sugerencias debajo de la respuesta
                    showSuggestions(result.suggestions);

                    // Desplazamiento al final del chat
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Función para mostrar botones de sugerencias
        function showSuggestions(suggestions) {
            if (suggestions && suggestions.length > 0) {
                var suggestionsHtml = '<div class="bot-inbox inbox"><div class="msg-header"><p>Sugerencias:</p></div><div class="suggestions">';
                for (var i = 0; i < suggestions.length; i++) {
                    suggestionsHtml += '<button class="suggestion-btn" data-value="' + suggestions[i] + '">' + suggestions[i] + '</button>';
                }
                suggestionsHtml += '</div></div>';
                $(".form").append(suggestionsHtml);

                // Asignar evento click a los botones de sugerencias
                $(".suggestion-btn").on("click", function () {
                    var suggestionValue = $(this).data("value");
                    $("#data").val(suggestionValue);
                    $("#send-btn").click();
                });
            }
        }

        // Función para mostrar las rutas disponibles al iniciar el chat
        function mostrarRutas(rutas) {
            var rutasHtml = '<div class="bot-inbox inbox"><div class="msg-header"><p>Rutas Disponibles:</p></div><div class="suggestions">';
            for (var i = 0; i < rutas.length; i++) {
                rutasHtml += '<button class="suggestion-btn" data-value="' + rutas[i] + '">' + rutas[i] + '</button>';
            }
            rutasHtml += '</div></div>';
            $(".form").append(rutasHtml);

            // Asignar evento click a los botones de rutas
            $(".suggestion-btn").on("click", function () {
                var rutaValue = $(this).data("value");
                $("#data").val(rutaValue);
                $("#send-btn").click();
            });
        }
    });*/
    </script>


</body>

</html>
