<?php
session_start();
require_once '../conexion.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $conn->prepare("UPDATE pedidos SET estado = 'entregado' WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

header('Location: pedidos.php');
exit();
?>
