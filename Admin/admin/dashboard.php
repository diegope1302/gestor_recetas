<?php
session_start();
require_once '../conexion.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Obtener productos
$resultado = $conn->query("SELECT * FROM productos");
$productos = $resultado->fetch_all(MYSQLI_ASSOC);

// Obtener categorías (únicas)
$categorias = $conn->query("SELECT DISTINCT categoria FROM productos")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Dashboard 📊</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header><h1>Dashboard Admin</h1></header>
    <section>
        <h2>Productos</h2>
        <a class="boton" href="subir.php">Agregar nuevo ➕</a>
        <table border="1" cellpadding="10" style="margin-top:20px;">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php foreach($productos as $p): ?>
            <tr>
                <td><img src="../imagenes/<?= $p['imagen'] ?>" width="80"></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td>S/. <?= number_format($p['precio'], 2) ?></td>
                <td><?= $p['activo'] ? 'Activo' : 'Inactivo' ?></td>
                <td>
                    <a class="boton" href="activar.php?id=<?= $p['id'] ?>&estado=<?= $p['activo'] ? 0 : 1 ?>">
                        <?= $p['activo'] ? 'Desactivar' : 'Activar' ?>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>
</html>
