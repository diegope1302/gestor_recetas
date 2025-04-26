<?php
session_start();
require_once '../conexion.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'], $_GET['estado'])) {
    $id = (int)$_GET['id'];
    $estado = (int)$_GET['estado'];

    $stmt = $conn->prepare("UPDATE productos SET activo = ? WHERE id = ?");
    $stmt->bind_param('ii', $estado, $id);
    $stmt->execute();
}

header('Location: dashboard.php');
exit();
?>
