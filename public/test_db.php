<?php
    $servername = "db";      // <-- nombre del servicio en docker-compose
    $username = "user";      // <-- igual al del compose
    $password = "pass";
    $database = "isla_transfers";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
    }

    echo "✅ Conexión exitosa a la base de datos!";
    $conn->close();
?>
