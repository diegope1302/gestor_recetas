<?php
session_start();
require_once '../conexion.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['categoria']) && isset($_FILES['imagen'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    
    $nombre_imagen = uniqid() . "-" . $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "../imagenes/" . $nombre_imagen);

    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen, categoria, activo) VALUES (?, ?, ?, ?, ?, 1)");
    $stmt->bind_param("ssdss", $nombre, $descripcion, $precio, $nombre_imagen, $categoria);
    $stmt->execute();
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Producto 📸</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header><h1>Nuevo Producto</h1></header>
    <section>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre del producto" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input type="number" step="0.01" name="precio" placeholder="Precio S/." required>
            <input type="text" name="categoria" placeholder="Categoría (ej: Jugos)" required>
            <input type="file" name="imagen" required>
            <button type="submit">Subir Producto</button>
        </form>
    </section>
</body>
</html>
