window.onload = () => {
    const borrarUsuario = document.getElementById("borrarUsuario");
    borrarUsuario.addEventListener("click", () => {
        generarAlert();
    }
    );
}

let generarAlert = () => {
    let mensaje = prompt("Escribe 'CONFIRMA' si deseas borrar el usuario");

    if (mensaje.toUpperCase() === "CONFIRMA") {
        alert("El usuario se ha borrado");
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../CONTROLADOR/Borrar_Usuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    window.location.href = "../index.php";
                } else {
                    console.error("Error al borrar el usuario:", xhr.responseText);
                    alert("Error al borrar el usuario. Por favor, inténtelo de nuevo.");
                }
            }
        };
        xhr.send();
    }
}