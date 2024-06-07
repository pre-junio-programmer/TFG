function mostrarProductos(categoria) {
  document.getElementById('contenedor_productos').innerHTML = '';

  const formData = new FormData();
  formData.append('categoria', categoria);

  fetch('../CONTROLADOR/Mostrar_Productos.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    document.getElementById('contenedor_productos').innerHTML = data;
  })
  .catch(error => console.error('Error:', error));
}

window.onload = function() {
  obtenerSaldoUsuario();
  obtenerNombreUsuario();
};

function obtenerSaldoUsuario() {
  fetch('../CONTROLADOR/Mostrar_Saldo.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('saldoUsuario').textContent = data.trim() || '0';
    })
    .catch(error => console.error('Error:', error));
}

function obtenerNombreUsuario() {
  fetch('../CONTROLADOR/Obtener_Nombre_Usuario.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('nombre').textContent = data.trim() || 'Nombre de usuario';
    })
    .catch(error => console.error('Error:', error));
}