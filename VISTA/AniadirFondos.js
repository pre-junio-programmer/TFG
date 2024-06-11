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

    document.getElementById("cantidadIntroducida").addEventListener("change", validarCantidad);

    document.getElementById("formulario").addEventListener("submit", function(event) {
        const radioTarjetaSeleccionada = document.querySelector('input[name="radioTarjeta"]:checked');
        const cantidadIntroducida = parseFloat(document.getElementById("cantidadIntroducida").value);
        const cantidadIntroducida_Error = document.getElementById("cantidadIntroducida_Error");

        if (!radioTarjetaSeleccionada) {
            event.preventDefault();
            alert("Por favor seleccione una tarjeta.");
            return false;
        }

        if (cantidadIntroducida <= 0 || isNaN(cantidadIntroducida)) {
            event.preventDefault();
            cantidadIntroducida_Error.innerText = "La cantidad debe ser mayor a cero.";
            cantidadIntroducida_Error.style.display = "block";
            return false;
        }

        metodoPagoSeleccionado = radioTarjetaSeleccionada.value;
    });
}

function validarCantidad() {
    const cantidadIntroducida = parseFloat(document.getElementById("cantidadIntroducida").value);
    const cantidadIntroducida_Error = document.getElementById("cantidadIntroducida_Error");

    if (cantidadIntroducida > 0) {
        cantidadIntroducida_Error.innerText = "";
        cantidadIntroducida_Error.style.display = "none";
    }
}