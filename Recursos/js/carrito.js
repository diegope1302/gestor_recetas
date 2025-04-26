// Variables
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

// Función para agregar producto
function agregarAlCarrito(producto) {
    const existe = carrito.find(p => p.id === producto.id);

    if (existe) {
        existe.cantidad += 1;
    } else {
        carrito.push({
            id: producto.id,
            nombre: producto.nombre,
            precio: producto.precio,
            cantidad: 1
        });
    }

    guardarCarrito();
    mostrarCarrito();
}

// Función para guardar carrito en localStorage
function guardarCarrito() {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Función para eliminar producto
function eliminarDelCarrito(id) {
    carrito = carrito.filter(p => p.id !== id);
    guardarCarrito();
    mostrarCarrito();
}

// Función para mostrar carrito (en carrito.php)
function mostrarCarrito() {
    const contenedor = document.getElementById('carrito-contenedor');
    contenedor.innerHTML = '';

    if (carrito.length === 0) {
        contenedor.innerHTML = '<p>Tu carrito está vacío 🛒</p>';
        return;
    }

    carrito.forEach(producto => {
        const div = document.createElement('div');
        div.classList.add('carrito-item');
        div.innerHTML = `
            <span>${producto.nombre} x${producto.cantidad}</span>
            <span>S/. ${(producto.precio * producto.cantidad).toFixed(2)}</span>
            <button class="boton" onclick="eliminarDelCarrito(${producto.id})">Eliminar ❌</button>
        `;
        contenedor.appendChild(div);
    });

    mostrarTotal();
}

// Función para mostrar total
function mostrarTotal() {
    const total = carrito.reduce((acc, item) => acc + item.precio * item.cantidad, 0);
    const totalElemento = document.getElementById('total');
    if (totalElemento) {
        totalElemento.innerText = `Total: S/. ${total.toFixed(2)}`;
    }
}

// Función para vaciar carrito (opcional)
function vaciarCarrito() {
    carrito = [];
    guardarCarrito();
    mostrarCarrito();
}

// Cargar carrito al entrar a la página
document.addEventListener('DOMContentLoaded', mostrarCarrito);
