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
            } else {
                console.error("Error al obtener comentarios: " + xhr.status);
            }
        }
    };
    xhr.send("orden=" + orden);
}
