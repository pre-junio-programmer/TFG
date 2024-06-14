function mostrarVentas() {
  const contenedorVentas = document.getElementById('contenedor_ventas');
  contenedorVentas.innerHTML = '<tr><td colspan="4">Cargando...</td></tr>';

  fetch('../CONTROLADOR/Mostrar_Ventas.php', {
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
  mostrarVentas();
}

let borrarTodo = () => {
  fetch('../CONTROLADOR/Borrar_Ventas.php', {
    method: 'POST'
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.text();
  })
  .then(data => {
    if (data.trim() == 'success') {
      window.location.reload();
    } else {
      console.error('Error al eliminar todas las ventas:', data);
    }
  })
  .catch(error => {
    console.error('Error en la solicitud de eliminación de todas las ventas:', error);
  });
}

let eliminarFila = (button) => {
  var row = button.parentNode.parentNode;
  var idProducto = row.querySelector('td:first-child').getAttribute('value');
  var cantidad = row.querySelector('#cantidad').getAttribute('value');

  fetch('../CONTROLADOR/Borrar_Venta_Individual.php', {
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
