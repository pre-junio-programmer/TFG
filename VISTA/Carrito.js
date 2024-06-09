function mostrarProducto() {
    const contenedorVentas = document.getElementById('bodyTablaCarrito');
    contenedorVentas.innerHTML = '<tr><td colspan="4">Cargando...</td></tr>';
  
    fetch('../CONTROLADOR/Mostrar_Carrito.php', {
      method: 'POST'
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      contenedorVentas.innerHTML = data;
  
      const botonesEliminar = document.getElementsByName("botonEliminar");
      botonesEliminar.forEach(boton => {
        boton.addEventListener("click", () => eliminarFila(boton));
      });
    })
  }
window.onload = () => {
    mostrarProducto();
    const botonesEliminar = document.getElementsByName("botonEliminar");
    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", () => eliminarFila(boton));
    });
    
    calcularTotal();
    
  
    const botonEliminarTodo = document.getElementById("eliminarTodo");
    botonEliminarTodo.addEventListener("click", eliminarTodo);

    document.addEventListener("DOMContentLoaded", mostrarProducto);
}
let eliminarFila = (button) => {
    var row = button.parentNode.parentNode;
    var idProducto = row.querySelector('td:first-child').getAttribute('value');
    var cantidad = row.querySelector('[name="cantidad"]').getAttribute('value');
  
    fetch('../CONTROLADOR/Borrar_Carrito_Individual.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `id_producto=${idProducto}&cantidad=${cantidad}`
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      if (data.trim() == 'success') {
        row.parentNode.removeChild(row);
        window.location.reload();
      } else {
        console.error('Error al eliminar el producto:', data);
      }
    })
}
let eliminarTodo = () => {
    const filas = Array.from(document.getElementsByName("filas"));
    filas.forEach(fila => {
        fila.parentNode.removeChild(fila);
    });
    calcularTotal();
}

