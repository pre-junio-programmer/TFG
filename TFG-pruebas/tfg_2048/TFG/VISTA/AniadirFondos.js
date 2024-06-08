
var metodoPagoSeleccionado = '';

function mostrarTarjetas() {
  document.getElementById('infoTarjetas').innerHTML = '';
  const formData = new FormData();
  fetch('../CONTROLADOR/Mostrar_Tarjetas.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      document.getElementById('infoTarjetas').innerHTML = data;
  })
  .catch(error => console.error('Error:', error));
}


window.onload = function() {
    mostrarTarjetas();
    const contenedorError = document.getElementById("errorMensaje");
    const urlParams = new URLSearchParams(window.location.search);
    const errorUrl = urlParams.get('error');
    if (errorUrl == '1') {
        contenedorError.innerText = "No hay suficiente dinero en la tarjeta";
        contenedorError.style.display = "block";
    } else {
        contenedorError.style.display = "none";
    }

    document.getElementById("formulario").addEventListener("submit", function() {
        const radioTarjetaSeleccionada = document.querySelector('input[name="radioTarjeta"]:checked');
        if (radioTarjetaSeleccionada) {
            metodoPagoSeleccionado = radioTarjetaSeleccionada.value;
            document.getElementById("formulario").submit();
        } else {
            alert("Por favor, selecciona una tarjeta");
            return false;
        }
    });
}


