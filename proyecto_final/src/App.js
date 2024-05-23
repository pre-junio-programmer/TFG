import React, { useState } from 'react';

function Registro_F() {
  const [contraseñaVisible, setContraseñaVisible] = useState(false);

  const toggleContraseñaVisibilidad = () => {
    setContraseñaVisible(!contraseñaVisible);
  };

  return (
    <div>
      <h2>Registro de Usuario</h2>

      <form action="../CONTROLADOR/Registro_Correcto.php" method="post">
        <label htmlFor="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" />

        <br /><br />

        <label htmlFor="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" />

        <br /><br />

        <label htmlFor="correo">Correo electrónico:</label>
        <input type="text" id="correo" name="correo" />

        <br /><br />

        <label htmlFor="contraseña">Contraseña:</label>
        <input type={contraseñaVisible ? "text" : "password"} id="contraseña" name="contraseña" />
        <img src="imagenes/ojo.png" onClick={toggleContraseñaVisibilidad} width="30px" height="30px" style={{ cursor: 'pointer' }} />

        <br /><br />

        <label htmlFor="saldo">Saldo:</label>
        <input type="number" id="saldo" name="saldo" />

        <br /><br />

        <input type="submit" value="Registrar Usuario" />
      </form>
    </div>
  );
}

export default Registro_F;
