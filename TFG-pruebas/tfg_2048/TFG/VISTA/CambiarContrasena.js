window.onload = () => {
    const ojo = document.getElementById("ojo");
    ojo.addEventListener("click", mostrarContrasenia);

    const ojo2 = document.getElementById("ojo2");
    ojo2.addEventListener("click", mostrarConfirmarContrasenia);

    const password = document.getElementById("contra");
    const errorPassword = document.getElementById("errorPassword");
    password.addEventListener("input", () => formularioVacio(password, errorPassword));

    const confirmarPassword = document.getElementById("confirmarPassword");
    const errorConfirmarPassword = document.getElementById("errorConfirmarPassword");
    confirmarPassword.addEventListener("input", () => formularioVacio(confirmarPassword, errorConfirmarPassword));

    let botonCambiar = document.getElementById("Cambiar");
    // if (password.value.trim() === "" || confirmarPassword.value.trim() === "") {
    //     botonCambiar.disabled = true;
    // } else {
    //     botonCambiar.disabled = false;
    // }

    const formulario = document.getElementById("formulario");
    formulario.addEventListener("submit", (event) => {
        if (formularioVacio(password, errorPassword) || formularioVacio(confirmarPassword, errorConfirmarPassword)) {
            event.preventDefault();
        }
    });
}

let formularioVacio = (elemento, labelError) => {
    // let botonEnviar = document.getElementById("Enviar");
    
    // if (elemento.value.trim() === "") {
    //     let mensajeError = `El campo ${elemento.name} no puede estar vacio`;
    //     labelError.innerHTML = mensajeError;
    //     labelError.style = "color: red; font-style: italic; margin: 10px";
    //     botonEnviar.disabled = true;
    // } else {
    //     labelError.innerHTML = "";
    //     botonEnviar.disabled = false;
    // }
}

let mostrarContrasenia = () => {
    let password = document.getElementById("password");
    let ojo = document.getElementById("ojo");
    
    if (password.type == "password") {
        password.type = "text";
        ojo.src = "../img/ojo.png";
    } else {
        password.type = "password";
        ojo.src = "../img/invisible.png";
    }
}

let mostrarConfirmarContrasenia = () => {
    let confirmarPassword = document.getElementById("confirmarPassword");
    let ojo2 = document.getElementById("ojo2");
    
    if (confirmarPassword.type == "password") {
        confirmarPassword.type = "text";
        ojo2.src = "../img/ojo.png";
    } else {
        confirmarPassword.type = "password";
        ojo2.src = "../img/invisible.png";
    }
}
