<?php
$host = '127.0.0.1';
$dbname = 'recetas';  // Nombre de tu base de datos
$username = 'root';          // Usuario de la base de datos (por defecto en XAMPP es 'root')
$password = '';              // Contrase�a (por defecto est� vac�a en XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexi�n: ' . $e->getMessage();
}
?>
