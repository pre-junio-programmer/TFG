window.onload = () => {
  const contenedorError = document.getElementById("errorMensaje");
  const urlParams = new URLSearchParams(window.location.search);
  const errorUrl = urlParams.get('error');
  if (errorUrl === '1') {
    contenedorError.innerText = "El nombre o la contraseña que ha introducido no son correctos";
    contenedorError.style.display = "block";
  } else {
    contenedorError.style.display = "none";
  }

  const errorUsuario = document.getElementById("errorUsername");
  const errorPassword = document.getElementById("errorPassword");

  const mostrarContrasenia = () => {
    let password = document.getElementById("password");
    let ojo = document.getElementById("ojo");

    if (password.type === "password") {
      password.type = "text";
      ojo.src = "../img/invisible.png";
    } else {
      password.type = "password";
      ojo.src = "../img/ojo.png";
    }
  }

  const ojo = document.getElementById("ojo");
  if (ojo) {
    ojo.addEventListener("click", mostrarContrasenia);
  }

  const usuario = document.getElementById("username");
  if (usuario && errorUsuario) {
    usuario.addEventListener("input", () => formularioVacio(usuario, errorUsuario));
  }

  const password = document.getElementById("password");
  if (password && errorPassword) {
    password.addEventListener("input", () => formularioVacio(password, errorPassword));
  }

  const botonEnviar = document.getElementById("Enviar");
  if (botonEnviar) {
    botonEnviar.addEventListener("click", (event) => {
      const usuario = document.getElementById("username");
      const password = document.getElementById("password");
      if (usuario && password && (formularioVacio(usuario, errorUsuario) || formularioVacio(password, errorPassword))) {
        event.preventDefault();
      }
    });
  }
};

let formularioVacio = (elemento, labelError) => {
  if (elemento.value.trim() === "") {
    let mensajeError = `El campo ${elemento.name} no puede estar vacío`;
    labelError.innerHTML = mensajeError;
    labelError.style = "color: red; font-style: italic; margin: 10px";
    return true;
  } else {
    labelError.innerHTML = "";
    return false;
  }
};