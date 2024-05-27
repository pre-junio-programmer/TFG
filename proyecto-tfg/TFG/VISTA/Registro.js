window.onload = () => {
  const ojo = document.getElementById("ojo");
  ojo.addEventListener("click", mostrarContrasenia);

  const nombre = document.getElementById("nombre");
  const errorNombre = document.getElementById("errorUsuario");
  nombre.addEventListener("input", () => {
      formularioVacio(nombre, errorNombre);
      verificarCampos();
  });

  const password = document.getElementById("password");
  const errorPassword = document.getElementById("errorPassword");
  password.addEventListener("input", () => {
      formularioVacio(password, errorPassword);
      verificarCampos();
  });

  const direccion = document.getElementById("direccion");
  const errorDireccion = document.getElementById("errorDireccion");
  direccion.addEventListener("input", () => {
      formularioVacio(direccion, errorDireccion);
      verificarCampos();
  });

  const email = document.getElementById("email");
  const errorEmail = document.getElementById("errorEmail");
  email.addEventListener("input", () => {
      formularioVacio(email, errorEmail);
      verificarCampos();
  });

  const formulario = document.getElementById("formulario");
  formulario.addEventListener("submit", (event) => {
      if (formularioVacio(nombre, errorNombre) || formularioVacio(password, errorPassword) || formularioVacio(direccion, errorDireccion) || !comprobacionEmail()) {
          event.preventDefault();
      }
  });
}

let mostrarContrasenia = () => {
  let password = document.getElementById("password");
  let ojo = document.getElementById("ojo");

  if (password.type === "password") {
      password.type = "text";
      ojo.src = "../img/ojo.png";
  } else {
      password.type = "password";
      ojo.src = "../img/invisible.png";
  }
}

let formularioVacio = (elemento, labelError) => {
  if (elemento.value.trim() === "") {
      let mensajeError = `El campo ${elemento.name} no puede estar vacio`;
      labelError.innerHTML = mensajeError;
      labelError.style = "color: red; font-style: italic; margin: 10px";
      return true;
  } else {
      labelError.innerHTML = "";
      return false;
  }
}

let comprobacionEmail = () => {
  let email = document.getElementById("email");
  let errorEmail = document.getElementById("errorEmail");
  let regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

  if (!regex.test(email.value)) {
      errorEmail.innerHTML = "El email no es válido";
      errorEmail.style = "color: red; font-style: italic; margin: 10px";
      return false;
  } else {
      errorEmail.innerHTML = "";
      return true;
  }
}

let verificarCampos = () => {
  const nombre = document.getElementById("nombre");
  const password = document.getElementById("password");
  const direccion = document.getElementById("direccion");
  const email = document.getElementById("email");
  const botonEnviar = document.getElementById("Enviar");

  if (nombre.value.trim() === "" || password.value.trim() === "" || direccion.value.trim() === "" || email.value.trim() === "" || !comprobacionEmail()) {
      botonEnviar.disabled = true;
  } else {
      botonEnviar.disabled = false;
  }
}
