<?php
include 'config.php';

$busqueda = $_GET['buscar'] ?? '';

if ($busqueda) {
    $stmt = $pdo->prepare("SELECT * FROM recetas WHERE titulo LIKE ?");
    $stmt->execute(["%$busqueda%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM recetas");
}

$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Recetas</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Gestor de Recetas</h1>

    <form method="GET" action="index.php">
        <input type="text" name="buscar" placeholder="Buscar receta por título" value="<?php echo htmlspecialchars($busqueda); ?>">
        <button type="submit">Buscar</button>
    </form>

    <br>
    <a href="agregar_receta.php">Agregar nueva receta</a>
    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Ingredientes</th>
            <th>Pasos</th>
            <th>Tiempo (min)</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($recetas as $receta): ?>
            <tr>
                <td><?php echo htmlspecialchars($receta['titulo']); ?></td>
                <td><?php echo htmlspecialchars($receta['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($receta['ingredientes']); ?></td>
                <td><?php echo htmlspecialchars($receta['pasos']); ?></td>
                <td><?php echo $receta['tiempo_preparacion']; ?></td>
                <td>
                    <?php if ($receta['imagen']): ?>
                        <img src="imagenes/<?php echo $receta['imagen']; ?>" width="100">
                    <?php else: ?>
                        Sin imagen
                    <?php endif; ?>
                </td>
                <td>
                    <a href="editar_receta.php?id=<?php echo $receta['id']; ?>">Editar</a> |
                    <a href="eliminar.php?id=<?php echo $receta['id']; ?>" onclick="return confirm('�Eliminar esta receta?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

