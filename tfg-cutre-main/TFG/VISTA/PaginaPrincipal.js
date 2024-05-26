window.onload = () => {
  document.querySelectorAll('.nav-link').forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      const id = event.target.id;
      buscarProducto(id);
    });
  });
};

function buscarProducto(category) {
  const formData = new FormData();
  formData.append('categoria', category);

  fetch('../CONTROLADOR/prod_elegido.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => mostrarProductos(data))
  .catch(error => console.error('Error:', error));
}

function mostrarProductos(htmlProductos) {
  const contenedor = document.getElementById('contenedor_productos');
  contenedor.innerHTML = htmlProductos;
}