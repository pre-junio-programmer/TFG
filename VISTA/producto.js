window.onload = () => {
  inicializarEventListeners();
};

function cambiarOrden() {
  var orden = document.getElementById("orden").value;

  var eliminarDiv = document.getElementById("eliminar");
  if (eliminarDiv) {
      eliminarDiv.remove();
  }

  var comentariosExistente = document.getElementById("comentarios");
  if (comentariosExistente) {
      comentariosExistente.remove();
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              var comentarios = xhr.responseText;
              var divComentarios = document.createElement("div");
              divComentarios.setAttribute("id", "comentarios");
              divComentarios.innerHTML = comentarios;
              document.body.appendChild(divComentarios);
              
              // Reinicializar event listeners después de actualizar el DOM
              inicializarEventListeners();
          } else {
              console.error("Error al obtener comentarios: " + xhr.status);
          }
      }
  };
  xhr.send("orden=" + orden);
}

function inicializarEventListeners() {
  const comentario = document.getElementById("comentario");
  const errorComentario = document.getElementById("errorComentario");
  if (comentario) comentario.addEventListener("input", () => formularioVacio(comentario, errorComentario));

  const Valoracion = document.getElementById("Valoracion");
  const errorValoracion = document.getElementById("errorValoracion");
  if (Valoracion) Valoracion.addEventListener("input", () => formularioVacio(Valoracion, errorValoracion));

  const botonEnviar = document.getElementById("Enviar");
  if (botonEnviar) actualizarEstadoBoton(comentario, Valoracion, botonEnviar);

  if (comentario) comentario.addEventListener("input", () => actualizarEstadoBoton(comentario, Valoracion, botonEnviar));
  if (Valoracion) Valoracion.addEventListener("input", () => actualizarEstadoBoton(comentario, Valoracion, botonEnviar));

  const formulario = document.getElementById("formulario");
  if (formulario) formulario.addEventListener("submit", (event) => {
      if (formularioVacio(comentario, errorComentario) || formularioVacio(Valoracion, errorValoracion)) {
          event.preventDefault();
      }
  });

  const mostrarFormulario = document.getElementById("mostrarFormulario");
  if (mostrarFormulario) mostrarFormulario.addEventListener("click", function(event) {
      event.preventDefault();
      const creacionDiv = document.getElementById("Creacion");
      if (creacionDiv.style.display === "none" || creacionDiv.style.display === "") {
          creacionDiv.style.display = "block";
      } else {
          creacionDiv.style.display = "none";
      }
  });

  const cantidad = document.getElementById("Cantidad");
  const errorCantidad = document.getElementById("errorCantidad");
  const stock = parseInt(document.getElementById("stock").textContent);

  if (cantidad) cantidad.addEventListener("input", () => validarCantidad(cantidad, stock, errorCantidad));

  const botonAnadir = document.getElementById("Anadir");
  if (botonAnadir) actualizarEstadoBoton2(cantidad, botonAnadir);

  if (cantidad) cantidad.addEventListener("input", () => actualizarEstadoBoton2(cantidad, botonAnadir, stock));

  if (botonAnadir) {
    botonAnadir.addEventListener("click", function() {
      AniadirProducto();
    });
  }
}

function formularioVacio (elemento, labelError) {

  if (elemento.value.trim() === "") {

    let mensajeError = `El campo ${elemento.name} no es valido`;
    labelError.innerHTML = mensajeError;
    labelError.style = "color: red; font-style: italic; margin: 10px";
    return true;

  } else if (elemento.name === "Valoracion") {

    let valoracion = parseInt(elemento.value.trim());

    if (isNaN(valoracion) || valoracion < 1 || valoracion > 5) {

      let mensajeError = `La valoración debe ser un número entre 1 y 5`;
      labelError.innerHTML = mensajeError;
      labelError.style = "color: red; font-style: italic; margin: 10px";
      return true;

    } else {

      labelError.innerHTML = "";
      return false;
    }

  } else {

    labelError.innerHTML = "";
    return false;
  }

};

function actualizarEstadoBoton (comentario, Valoracion, botonEnviar) {
  if (comentario.value.trim() === "" || Valoracion.value.trim() === "" || Valoracion.value.trim() < 1 || Valoracion.value.trim() > 5) {
    botonEnviar.disabled = true;
  } else {
    botonEnviar.disabled = false;
  }
};

function actualizarEstadoBoton2(cantidad, botonAnadir, stock) {
  const cantidadValue = parseInt(cantidad.value.trim());
  
  if (isNaN(cantidadValue) || cantidadValue < 1 || cantidadValue > stock) {
    botonAnadir.disabled = true;
  } else {
    botonAnadir.disabled = false;
  }
}

function validarCantidad(cantidadInput, stock, errorLabel, botonAnadir) {

  const cantidad = parseInt(cantidadInput.value.trim());

  if (isNaN(cantidad) || cantidad < 1 || cantidad > stock) {

    let mensajeError = isNaN(cantidad) || cantidad < 1
      ? `La cantidad debe ser un número positivo`
      : `La cantidad no puede superar el stock disponible (${stock})`;
    errorLabel.innerHTML = mensajeError;
    errorLabel.style = "color: red; font-style: italic; margin: 10px";

  } else {
    errorLabel.innerHTML = "";
  }
}

function AniadirProducto() {
  const urlParams = new URLSearchParams(window.location.search);
  const id_producto = urlParams.get('id');
  const cantidadInput = document.getElementById("Cantidad");
  const cantidad = cantidadInput.value;

  fetch(`../CONTROLADOR/Aniadir_Producto.php?id=${id_producto}&cantidad=${cantidad}`)
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        alert(data.message);
        cantidadInput.value = "";
      } else {
        alert(data.message);
        cantidadInput.value = "";
      }
    })
    .catch(error => {
      console.error('Hubo un problema al realizar la solicitud:', error);
      alert('Hubo un problema al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde.');
    });
}