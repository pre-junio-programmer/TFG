window.onload = () => {
  const comentario = document.getElementById("comentario");
  const errorComentario = document.getElementById("errorComentario");
  comentario.addEventListener("input", () => formularioVacio(comentario, errorComentario));

  const Valoracion = document.getElementById("Valoracion");
  const errorValoracion = document.getElementById("errorValoracion");
  Valoracion.addEventListener("input", () => formularioVacio(Valoracion, errorValoracion));

  const botonEnviar = document.getElementById("Enviar");
  actualizarEstadoBoton(comentario, Valoracion, botonEnviar);

  comentario.addEventListener("input", () => actualizarEstadoBoton(comentario, Valoracion, botonEnviar));
  Valoracion.addEventListener("input", () => actualizarEstadoBoton(comentario, Valoracion, botonEnviar));

  const formulario = document.getElementById("formulario");
  formulario.addEventListener("submit", (event) => {
    if (formularioVacio(comentario, errorComentario) || formularioVacio(Valoracion, errorValoracion)) {
      event.preventDefault();
    }
  });

  const volverLink = document.getElementById("Regresar");
  volverLink.addEventListener("click", (event) => {
    event.preventDefault();
    const urlParams = new URLSearchParams(window.location.search);
    const idProducto = urlParams.get('id');
    window.location.href = `../VISTA/producto.php?id=${idProducto}`;
  });

  const titulo = document.getElementById('titulo');
  const urlParams = new URLSearchParams(window.location.search);
  const producto = urlParams.get('producto');
  const idProducto = urlParams.get('id');
  
  // Establecer el valor del campo oculto id_producto
  document.getElementById("id_producto").value = idProducto;

  titulo.textContent = `Añadir Comentario: ${producto}`;
};

let formularioVacio = (elemento, labelError) => {
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
      // Si la valoración es válida, borra el mensaje de error
      labelError.innerHTML = "";
      return false;
    }
  } else {
    // Si el campo no está vacío y no es un campo de valoración, borra el mensaje de error
    labelError.innerHTML = "";
    return false;
  }
};

let actualizarEstadoBoton = (comentario, Valoracion, botonEnviar) => {
  if (comentario.value.trim() === "" || Valoracion.value.trim() === "" || Valoracion.value.trim() < 1 || Valoracion.value.trim() > 5) {
    botonEnviar.disabled = true;
  } else {
    botonEnviar.disabled = false;
  }
};
