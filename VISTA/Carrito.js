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
  const contenedorError = document.getElementById("mensaje-error");
  const urlParams = new URLSearchParams(window.location.search);
  const errorUrl = urlParams.get('error');
  if (errorUrl == '1') {
    contenedorError.innerText = "El saldo es inferior al coste de los productos";
    contenedorError.style.display = "block";
    
  } else {
    contenedorError.style.display = "none";
  }

  mostrarProducto();
  const botonesEliminar = document.getElementsByName("botonEliminar");
  botonesEliminar.forEach(boton => {
      boton.addEventListener("click", () => eliminarFila(boton));
  });
  
  
  const botonEliminarTodo = document.getElementById("eliminarTodo");
  botonEliminarTodo.addEventListener("click", eliminarTodo);

  const botonComprar = document.getElementById("comprar");
  botonComprar.addEventListener("click", comprar);

}

let eliminarFila = (button) => {
  var row = button.parentNode.parentNode;
  var idProducto = row.querySelector('td:first-child').getAttribute('value');

  fetch('../CONTROLADOR/Borrar_Carrito_Individual.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `id_producto=${idProducto}`
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
  fetch('../CONTROLADOR/Borrar_Carrito.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: ''
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.text();
  })
  .then(data => {
    if (data.trim() == 'success') {
      
      const filas = Array.from(document.querySelectorAll("#bodyTablaCarrito tr"));
      filas.forEach(fila => fila.parentNode.removeChild(fila));
      window.location.reload();
    } else {
      console.error('Error al eliminar todos los productos:', data);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
}


function comprar() {
  const total = document.getElementById("total").textContent.trim();
  fetch('../CONTROLADOR/Pagar_Carrito.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `total=${total}`
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      return response.text();
  })
  .then(data => {
      if (data.trim() == 'success') {
          window.location.href = '../VISTA/Carrito.html';
      } else if (data.trim() == 'error') {
          window.location.href = '../VISTA/Carrito.html?error=1';
      } else {
          console.error('Unexpected response:', data);
      }
  })
  .catch(error => {
      console.error('Error:', error);
  });
}

