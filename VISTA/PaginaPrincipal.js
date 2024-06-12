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
function mostrarNovedades() {
  document.getElementById('contenedor_productos').innerHTML = '';

  fetch('../CONTROLADOR/Mostrar_Novedades.php', {
      method: 'POST'
  })
  .then(response => response.text())
  .then(data => {
      document.getElementById('contenedor_productos').innerHTML = data;
  })
  .catch(error => console.error('Error:', error));
}

function obtenerSaldoUsuario() {
  fetch('../CONTROLADOR/Mostrar_Saldo.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('saldoUsuario').textContent = data.trim() || '0';
    })
    .catch(error => console.error('Error:', error));
}

function obtenerImagenUsuario() {
  fetch('../CONTROLADOR/Mostrar_Imagen.php')
    .then(response => response.text())
    .then(data => {
      var imgElement = document.getElementById('imagen_usuario');
      if (imgElement) {
        imgElement.src = data;
      }
    })
    .catch(error => console.error('Error:', error));
}


window.onload = function() {

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../CONTROLADOR/Iniciada_Sesion.php", true);
  xhr.onload = function() {
      if (xhr.status == 200) {
          if (xhr.responseText !== "OK") {
              window.location.href = "../index.php";
          }
      }
  };
  xhr.send();

  obtenerImagenUsuario();
  obtenerSaldoUsuario();
  mostrarNovedades();
  obtenerNombreUsuario();


  document.getElementById('link-cerrar').addEventListener('click', function(event) {
    event.preventDefault();
    if (confirm("¿Desea cerrar sesión?")) {
        window.location.href = '../CONTROLADOR/Cerrar_Sesion.php';
    } else {
        console.log("Cancelado");
    }
  });


};



function obtenerNombreUsuario() {
  fetch('../CONTROLADOR/Obtener_Nombre_Usuario.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('nombre').textContent = data.trim() || 'Nombre de usuario';
    })
    .catch(error => console.error('Error:', error));
}