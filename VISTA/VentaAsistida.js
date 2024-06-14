window.onload = () => {
    const precioProducto = document.getElementById("precioProducto");
    precioProducto.addEventListener('input', function (e) {
        let value = e.target.value;

        value = value.replace(/[^\d.,]/g, '');
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }

        e.target.value = value;
    });

    precioProducto.addEventListener('focus', function (e) {
        e.target.value = e.target.value.replace(/€/g, '').trim();
    });

    precioProducto.addEventListener('blur', function (e) {
        let value = e.target.value.replace(/€/g, '').trim();
        if (value !== '') {
            e.target.value = value + ' €';
        }
    });

    const nombreProducto = document.getElementById("nombreProducto");
    const errorNombreProducto = document.getElementById("errorNombreProducto");
    nombreProducto.addEventListener("input", () => formularioVacio(nombreProducto, errorNombreProducto));

    const categoriaProducto = document.getElementById("categoriaProducto");
    const errorCategoriaProducto = document.getElementById("errorCategoriaProducto");
    categoriaProducto.addEventListener("input", () => {
        formularioVacio(categoriaProducto, errorCategoriaProducto);
    });

    const errorPrecioProducto = document.getElementById("errorPrecioProducto");
    precioProducto.addEventListener("input", () => formularioVacio(precioProducto, errorPrecioProducto));

    const cantidadProducto = document.getElementById("cantidadProducto");
    const errorCantidadProducto = document.getElementById("errorCantidadProducto");
    cantidadProducto.addEventListener("input", () => {
        formularioVacio(cantidadProducto, errorCantidadProducto);
        validarCantidadPositiva(cantidadProducto, errorCantidadProducto);
    });

    const botonEnviar = document.getElementById("Enviar");
    if (nombreProducto.value.trim() == "" || categoriaProducto.value.trim() == "" || precioProducto.value.trim() == "" || cantidadProducto.value.trim() == "") {
        botonEnviar.disabled = true;
    } else {
        botonEnviar.disabled = false;
    }

    const formulario = document.getElementById("formulario");
    formulario.addEventListener("submit", (event) => {
        if (formularioVacio(nombreProducto, errorNombreProducto) || formularioVacio(categoriaProducto, errorCategoriaProducto) || formularioVacio(precioProducto, errorPrecioProducto) || formularioVacio(cantidadProducto, errorCantidadProducto) || comprobarFichero(event) == false) {
            event.preventDefault();
        }
    });
}

let formularioVacio = (elemento, labelError) => {
    let botonEnviar = document.getElementById("Enviar");
    
    if (elemento.value.trim() == "") {
        let mensajeError = `El campo ${elemento.name} no puede estar vacio`;
        labelError.innerHTML = mensajeError;
        labelError.style = "color: red; font-style: italic; margin: 10px";
        botonEnviar.disabled = true;
    } else {
        labelError.innerHTML = "";
        botonEnviar.disabled = false;
    }
}

let validarCantidadPositiva = (elemento, labelError) => {
    let botonEnviar = document.getElementById("Enviar");

    if (parseFloat(elemento.value) < 0) {
        let mensajeError = `El campo ${elemento.id} no puede ser negativo`;
        labelError.innerHTML = mensajeError;
        labelError.style = "color: red; font-style: italic; margin: 10px";
        botonEnviar.disabled = true;
        return true;
    } else {
        labelError.innerHTML = "";
        botonEnviar.disabled = false;
        return false;
    }
}

let comprobarFichero = (event) => {
    const fichero = document.getElementById("subirFoto");
    const errorSubirFoto = document.getElementById("errorSubirFoto");
    const allowedExtensions = ['jpg', 'jpeg', 'png'];
    let fileName = fichero.value;
    let fileExtension = fileName.split('.').pop().toLowerCase();

    if (fileName.lastIndexOf('.') == -1 || !allowedExtensions.includes(fileExtension)) {
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