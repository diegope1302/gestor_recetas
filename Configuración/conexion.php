<?php
$servername = "192.168.10.20";
$username = "root"; // Cambia por tu usuario de la base de datos
$password = ""; // Cambia por tu contraseña
$dbname = "mister_jugo"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
