<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje Estilizado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente */
        }
        .modal-content {
            background-color: rgba(3, 38, 66);
            margin: 15% auto; /* 15% desde la parte superior y centrado */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Ancho del modal */
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        button {
            background-color: #4CAF50; /* Color verde */
            color: white; /* Texto blanco */
            border: none; /* Sin borde */
            padding: 10px 20px; /* Espaciado */
            cursor: pointer; /* Cursor tipo puntero */
        }
        button:hover {
            background-color: #45a049; /* Color más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p style="color: white">ALERTA: Su Usuario es incorrecto. Por favor, trate nuevamente. Si no está registrado, seleccione la opción de requerir acceso.</p>
        <button onclick="closeModal()">OK</button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
		setTimeout(closeModal, 300000);
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // Abre el modal cuando se carga la página
    window.onload = openModal;
</script>

<?php
include("closetaskscon.php");
?>

</body>
</html>
