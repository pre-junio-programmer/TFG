window.onload = () => {
    const peticionValores = new XMLHttpRequest();
    peticionValores.open("GET", "../CONTROLADOR/Mostrar_Usuario.php", true);
    peticionValores.onreadystatechange = function() {
        if (peticionValores.readyState == XMLHttpRequest.DONE) {
            if (peticionValores.status == 200) {
                const data = peticionValores.responseText.split('|');
                
                document.getElementById("nombre").value = data[0];
                document.getElementById("direccion").value = data[1];
                document.getElementById("email").value = data[2];
            } else {
                console.error("Error al obtener datos del usuario");
            }
        }
    };
    
    peticionValores.send();
    const contenedorError = document.getElementById("errorMensaje");
    const parametrosDeUrl = new URLSearchParams(window.location.search);
    const errorUrl = parametrosDeUrl.get('error');
    if (errorUrl === '1') {
        contenedorError.innerText = "El nombre que ha introducido ya está en uso";
        contenedorError.style.display = "block";
    } else if (errorUrl === '2') {
        contenedorError.innerText = "El correo que ha introducido ya está en uso";
        contenedorError.style.display = "block";
    } else {
        contenedorError.style.display = "none";
    }
    

    const nombre = document.getElementById("nombre");
    const errorNombre = document.getElementById("errorUsuario");
    nombre.addEventListener("input", () => {
        formularioVacio(nombre, errorNombre);
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

    const fichero = document.getElementById("fotoPerfil");
    fichero.addEventListener("change", () => {
        comprobarFichero(event);
        verificarCampos();
    });

    const formulario = document.getElementById("formulario");
    formulario.addEventListener("submit", (event) => {
        if (formularioVacio(nombre, errorNombre) || formularioVacio(direccion, errorDireccion) || !comprobacionEmail() || comprobarFichero(event) == false) {
            event.preventDefault();
        }
    });
};

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
};

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
};

let verificarCampos = () => {
    const nombre = document.getElementById("nombre");
    const direccion = document.getElementById("direccion");
    const email = document.getElementById("email");
    const botonCambiar = document.getElementById("Cambiar");

    if (nombre.value.trim() == "" || direccion.value.trim() == "" || email.value.trim() == "" || !comprobacionEmail()) {
        botonCambiar.disabled = true;
    } else {
        botonCambiar.disabled = false;
    }
};

let comprobarFichero = (event) => {
    const fichero = document.getElementById("fotoPerfil");
    const errorSubirFoto = document.getElementById("errorSubirFotoPerfil");
    const allowedExtensions = ['jpg', 'jpeg', 'png'];
    let fileName = fichero.value;
    let fileExtension = fileName.split('.').pop().toLowerCase();

    if (fileName.lastIndexOf('.') === -1 || !allowedExtensions.includes(fileExtension)) {
        event.preventDefault();
        errorSubirFoto.innerHTML = `La foto tiene que ser de tipo: ${allowedExtensions.join(', ')}`;
        errorSubirFoto.style = "color: red; font-style: italic; margin: 10px";
        fichero.value = '';
        return false;
    } else {
        errorSubirFoto.innerHTML = "";
        return true;
    }
}