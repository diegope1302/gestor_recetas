<?php 
include 'header.php'; 
// Aquí deberíamos validar que el usuario esté logueado
// if (!isset($_SESSION['usuario'])) { header('Location: login.php'); exit; }
?>

<h1>Finalizar Compra ✅</h1>

<section class="formulario">
  <form action="procesar_checkout.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre completo 🧑" required>
    <input type="tel" name="telefono" placeholder="Teléfono 📞" pattern="^\+51\s\d{3}\s\d{3}\s\d{3}$" required>
    <input type="text" name="direccion" placeholder="Dirección 📍" required>

    <select name="metodo_pago" required>
      <option value="">Selecciona método de pago</option>
      <option value="efectivo">Efectivo 💸</option>
      <option value="tarjeta">Tarjeta 💳</option>
    </select>

    <button type="submit">Confirmar Pedido 📲</button>
  </form>
</section>

<?php include 'footer.php'; ?>
