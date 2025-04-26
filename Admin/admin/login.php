<?php
session_start();
require_once '../conexion.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, contraseña, es_admin FROM usuarios WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($password, $usuario['contraseña']) && $usuario['es_admin']) {
        $_SESSION['admin_id'] = $usuario['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Credenciales incorrectas o no eres administrador.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Login 🔐</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header><h1>Login Admin</h1></header>
    <section>
        <form method="POST">
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        </form>
    </section>
</body>
</html>
