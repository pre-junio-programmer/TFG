window.onload = () => {
    const ojo = document.getElementById("ojo");
    ojo.addEventListener("click", mostrarContrasenia);

    const numeroTarjeta = document.getElementById("numero");
    const errorNumero = document.getElementById("errorNumero");
    numeroTarjeta.addEventListener("input", () => formularioVacio(numeroTarjeta, errorNumero));

    const nombre = document.getElementById("nombre");
    const errorNombre = document.getElementById("errorNombre");
    nombre.addEventListener("input", () => formularioVacio(nombre, errorNombre));

    const cvv = document.getElementById("cvv");
    cvv.addEventListener("input", limiteCvv);

    const errorCvv = document.getElementById("errorCvv");
    cvv.addEventListener("input", () => formularioVacio(cvv, errorCvv));

    const botonEnviar = document.getElementById("Enviar"); // Declarar el botón de enviar después de los elementos
    if (numeroTarjeta.value.trim() === "" || nombre.value.trim() === "" || cvv.value.trim() === "") {
        botonEnviar.disabled = true;
    } else {
        botonEnviar.disabled = false;
    }

    const formulario = document.getElementById("formulario");
    formulario.addEventListener("submit", (event) => {
        if (formularioVacio(numeroTarjeta, errorNumero) || formularioVacio(nombre, errorNombre) || formularioVacio(cvv, errorCvv)) {
            event.preventDefault();
        }
    });
}


let mostrarContrasenia = () => {
    let cvv = document.getElementById("cvv");
    let ojo = document.getElementById("ojo");
    
    if (cvv.type == "password") {
        cvv.type = "text";
        ojo.src = "../img/ojo.png";
    } else {
        cvv.type = "password";
        ojo.src = "../img/invisible.png";
    }
}

let limiteCvv = () => {
    let cvv = document.getElementById("cvv");
    let mensajeErrorCvv = document.getElementById("errorCvv");
    let botonEnviar = document.getElementById("Enviar");
    let valorTipoTarjeta = document.getElementById("tipoTarjeta");

    if (valorTipoTarjeta.value == "American Express") {
        if (cvv.value.length > 4) {
            mensajeErrorCvv.innerHTML = "El CVV no puede tener más de 4 dígitos";
            mensajeErrorCvv.style = "color: red; font-style: italic; margin: 10px";
            botonEnviar.disabled = true;
        } else {
            mensajeErrorCvv.innerHTML = "";
            botonEnviar.disabled = false;
        }
    } else {
        if (cvv.value.length > 3) {
            mensajeErrorCvv.innerHTML = "El CVV no puede tener más de 3 dígitos";
            mensajeErrorCvv.style = "color: red; font-style: italic; margin: 10px";
            botonEnviar.disabled = true;
        } else {
            mensajeErrorCvv.innerHTML = "";
            botonEnviar.disabled = false;
        }
    }
}

let formularioVacio = (elemento, labelError) => {
    let botonEnviar = document.getElementById("Enviar");

    if (elemento.value.trim() === "") {
        let mensajeError = `El campo ${elemento.name} no puede estar vacio`;
        labelError.innerHTML = mensajeError;
        labelError.style = "color: red; font-style: italic; margin: 10px";
        botonEnviar.disabled = true;
    } else {
        labelError.innerHTML = "";
        botonEnviar.disabled = false;
    }
}