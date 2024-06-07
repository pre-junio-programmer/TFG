window.onload = () => {
    const borrarUsuario = document.getElementById("borrarUsuario");
    borrarUsuario.addEventListener("click", () => {
        generarAlert();
    }
    );
}

let generarAlert = () => {
    let mensaje = prompt("Escriba 'CONFIRMAR' si desea borrar el usuario");

    if (mensaje.toUpperCase() === "CONFIRMAR") {
        alert("El usuario se ha borrado");
        return true;
    }
}