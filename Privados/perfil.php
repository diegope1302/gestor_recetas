<?php 
include 'header.php'; 
// Validar sesión iniciada
// if (!isset($_SESSION['usuario'])) { header('Location: login.php'); exit; }
?>

<h1>Mi Perfil 📝</h1>

<section class="datos-usuario">
  <h2>Mis Datos:</h2>
  <!-- Datos traídos de la sesión o la base de datos -->
  <p>Nombre: <?php echo $_SESSION['usuario']['nombre']; ?></p>
  <p>Teléfono: <?php echo $_SESSION['usuario']['telefono']; ?></p>
  <p>Dirección: <?php echo $_SESSION['usuario']['direccion']; ?></p>
</section>

<section class="historial-pedidos">
  <h2>Mis Pedidos 📦</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Productos</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Consulta a la BD para traer pedidos del usuario
      /*
      $usuario_id = $_SESSION['usuario']['id'];
      $stmt = $conexion->prepare("SELECT * FROM pedidos WHERE usuario_id = ?");
      $stmt->execute([$usuario_id]);
      while ($pedido = $stmt->fetch()) {
          echo "<tr>";
          echo "<td>{$pedido['id']}</td>";
          echo "<td>{$pedido['productos']}</td>"; // Formatear productos
          echo "<td>S/ {$pedido['total']}</td>";
          echo "<td>{$pedido['estado']}</td>";
          echo "<td>{$pedido['fecha']}</td>";
          echo "</tr>";
      }
      */
      ?>
    </tbody>
  </table>
</section>

<?php include 'footer.php'; ?>
