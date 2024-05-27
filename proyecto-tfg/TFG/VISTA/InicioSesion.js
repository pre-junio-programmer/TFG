window.onload = () => {
  const ojo = document.getElementById("ojo");
  ojo.addEventListener("click", mostrarContrasenia);

  const usuario = document.getElementById("username");
  const errorUsuario = document.getElementById("errorUsername");
  usuario.addEventListener("input", () => formularioVacio(usuario, errorUsuario));

  const password = document.getElementById("password");
  const errorPassword = document.getElementById("errorPassword");
  password.addEventListener("input", () => formularioVacio(password, errorPassword));

  const botonEnviar = document.getElementById("Enviar");
  actualizarEstadoBoton(usuario, password, botonEnviar);

  usuario.addEventListener("input", () => actualizarEstadoBoton(usuario, password, botonEnviar));
  password.addEventListener("input", () => actualizarEstadoBoton(usuario, password, botonEnviar));

  const formulario = document.getElementById("formulario");
  formulario.addEventListener("submit", (event) => {
    if (formularioVacio(usuario, errorUsuario) || formularioVacio(password, errorPassword)) {
      event.preventDefault();
    }
  });

  
  const errorMessageElement = document.getElementById("errorMessage");
  const urlParams = new URLSearchParams(window.location.search);
  const errorParam = urlParams.get('error');
  if (errorParam === '1') {
    errorMessageElement.innerText = "El nombre o la contraseña son incorrectos";
    errorMessageElement.style.display = "block";
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
  
  let actualizarEstadoBoton = (usuario, password, botonEnviar) => {
    if (usuario.value.trim() === "" || password.value.trim() === "") {
      botonEnviar.disabled = true;
    } else {
      botonEnviar.disabled = false;
    }
  };
  
  let mostrarContrasenia = () => {
    let password = document.getElementById("password");
    let ojo = document.getElementById("ojo");
  
    if (password.type === "password") {
      password.type = "text";
      ojo.src = "../img/invisible.png";
    } else {
      password.type = "password";
      ojo.src = "../img/ojo.png";
    }
  };