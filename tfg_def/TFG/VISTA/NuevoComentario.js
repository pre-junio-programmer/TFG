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

  document.getElementById("mostrarFormulario").addEventListener("click", function(event) {
    event.preventDefault();
    const creacionDiv = document.getElementById("Creacion");
    if (creacionDiv.style.display === "none" || creacionDiv.style.display === "") {
      creacionDiv.style.display = "block";
    } else {
      creacionDiv.style.display = "none";
    }
  });
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
      labelError.innerHTML = "";
      return false;
    }
  } else {
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
