<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ingredientes = $_POST['ingredientes'];
    $pasos = $_POST['pasos'];
    $tiempo_preparacion = $_POST['tiempo_preparacion'];

    // Manejar imagen
    $imagen_nombre = null;
    if ($_FILES['imagen']['name']) {
        $imagen_nombre = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $ruta_imagen = 'imagenes/' . $imagen_nombre;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
    }

    $sql = "INSERT INTO recetas (titulo, descripcion, ingredientes, pasos, tiempo_preparacion, imagen)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $descripcion, $ingredientes, $pasos, $tiempo_preparacion, $imagen_nombre]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Recetas</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Agregar Nueva Receta</h1>
    <form action="agregar_receta.php" method="POST" enctype="multipart/form-data">
        <label>Titulo:</label><br>
        <input type="text" name="titulo" required><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion" required></textarea><br>

        <label>Ingredientes:</label><br>
        <textarea name="ingredientes" required></textarea><br>

        <label>Pasos:</label><br>
        <textarea name="pasos" required></textarea><br>

        <label>Tiempo de preparación (minutos):</label><br>
        <input type="number" name="tiempo_preparacion" required><br>

        <label>Imagen:</label><br>
        <input type="file" name="imagen"><br><br>

        <button type="submit">Guardar Receta</button>
    </form>

    <br>
    <a href="index.php">? Volver al listado</a>
</body>
</html>
