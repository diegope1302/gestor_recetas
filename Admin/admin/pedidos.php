<?php
session_start();
require_once '../conexion.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Obtener pedidos
$resultado = $conn->query("SELECT pedidos.*, usuarios.nombre FROM pedidos JOIN usuarios ON pedidos.usuario_id = usuarios.id ORDER BY pedidos.fecha DESC");
$pedidos = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pedidos 📦</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header><h1>Pedidos Recibidos 📦</h1></header>
    <section>
        <table border="1" cellpadding="10" style="margin-top:20px;">
            <tr>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            <?php foreach($pedidos as $pedido): ?>
            <tr>
                <td><?= htmlspecialchars($pedido['nombre']) ?></td>
                <td><?= htmlspecialchars($pedido['productos']) ?></td>
                <td>S/. <?= number_format($pedido['total'], 2) ?></td>
                <td><?= htmlspecialchars($pedido['estado']) ?></td>
                <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                <td>
                    <?php if ($pedido['estado'] == 'pendiente'): ?>
                        <a class="boton" href="marcar_entregado.php?id=<?= $pedido['id'] ?>">Marcar como Entregado ✅</a>
                    <?php else: ?>
                        Entregado
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>
</html>
