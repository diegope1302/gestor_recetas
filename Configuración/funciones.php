<?php
// Función para obtener el nombre de un producto por su ID
function obtenerProductoPorId($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
}

// Función para verificar si un usuario es administrador
function esAdmin($usuario_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT es_admin FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    return $usuario['es_admin'] == 1;
}
?>
