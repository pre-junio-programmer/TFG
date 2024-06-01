function mostrarProductos(categoria) {
  document.getElementById('contenedor_productos').innerHTML = '';

  const formData = new FormData();
  formData.append('categoria', categoria);

  fetch('../CONTROLADOR/prod_elegido.php', {
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
};

function obtenerSaldoUsuario() {
  fetch('../CONTROLADOR/Saldo.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('saldoUsuario').textContent = data.trim() || '0';
    })
    .catch(error => console.error('Error:', error));
}