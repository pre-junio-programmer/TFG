import React, { useState } from 'react';
import propTypes from 'prop-types';
import ojo from './img/ojo.png';

/**
 * Crea un formulario dinámicamente. Si queremos que uno de los campos opcionales no muestre información ponemos un array vacio, NO PUEDE SER NULL
 * @param {String} nombre Nombre del formulario
 * @param {String} metodoEnvio Método por el que se va a enviar el formulario
 * @param {String} rutaEnvio A donde se va a enviar el formulario
 * @param {String[]} nombreInputs Nombre de cada campo que introducimos
 * @param {String[]} tipoCampo Tipo del input
 * @param {String[]} opcionesSelect (OPCIONAL) Opciones que se le meten al select
 * @param {String[]} radioValues (OPCIONAL) Values de los radios
 * @param {String[]} checkboxValues (OPCIONAL) Values de los checkbox
 * @param {Function} onSubmit (OPCIONAL) Función que queremos que se ejecute cuando mandamo el fichero
 * @returns {React.Component} Formulario
 */

  const Formulario = ({ nombre, metodoEnvio, rutaEnvio, nombreInputs, tipoCampo, opcionesSelect, radioValues, checboxValues, onSubmit }) => {
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);

  const handlePasswordChange = (e) => {
    setPassword(e.target.value);
  };

  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
  
    setPassword('');

    if (onSubmit) {
      onSubmit(); // Llamar a la función de callback de envío del formulario
    }
  };

/**
 * Carga los inputs en el formulario, con los atributos 
 * @returns {React.Fragment[]} Inputs con los atributos
 */

  const renderInputs = () => {
    const inputs = [];

    for (let i = 0; i < nombreInputs.length; i++) {
      let inputElement;

      //Para cada elemento atributos específicos
      switch (tipoCampo[i]) {
        case "text":
          inputElement = (
            <input
              key={nombreInputs[i]} // Usamos el nombre del input como clave
              type={tipoCampo[i]} 
              name={nombreInputs[i]}
              placeholder={nombreInputs[i]}
            />
          );
          break;
        case "textarea":
          inputElement = (
            <input
              key={nombreInputs[i]} // Usamos el nombre del input como clave
              type={tipoCampo[i]} 
              name={nombreInputs[i]}
              placeholder={nombreInputs[i]}
            />
          );
          break;
        case "radio":
            inputElement = radioValues.map((option, index) => (
              <div key={index}>
                <input
                  type={tipoCampo[i]} 
                  name={nombreInputs[i]}
                  id={option} 
                  value={option}
                />
                <label htmlFor={option}>{option}</label>
              </div>
            ));
            break;
        case "checkbox":
            inputElement = checboxValues.map((option, index) => (
              <div key={index}>
                <input
                  type={tipoCampo[i]} 
                  name={nombreInputs[i]}
                  id={option} 
                  value={option}
                />
                <label htmlFor={option}>{option}</label>
              </div>
            ));
          break;
        case "select":
          const options = opcionesSelect;
          const selectOptions = options.map((option, index) => (
            <option key={index} value={option}>{option}</option>
          ));
          
          inputElement = (
            <select 
              key={nombreInputs[i]} 
              id={nombreInputs[i]}>
              {selectOptions}
            </select>
          );
          break;
        case "password":
          inputElement = (
            <React.Fragment key={nombreInputs[i]}>
              <input
                type={showPassword ? "text" : "password"}
                id={nombreInputs[i]}
                name={nombreInputs[i]}
                placeholder={nombreInputs[i]}
                onChange={handlePasswordChange}
              />
              <img
                src={ojo}
                alt="Mostrar contraseña"
                width="30px"
                height="30px"
                onClick={togglePasswordVisibility}
              />
            </React.Fragment>
          );
          break;
        case "submit":
          inputElement = (
            <input
              key={nombreInputs[i]} // Usamos el nombre del input como clave
              type={tipoCampo[i]} 
              value={nombreInputs[i]}
            />
          );
          break;
        default:
          inputElement = (
          <React.Fragment key={nombreInputs[i]}>
            <label htmlFor={nombreInputs[i]}>{nombreInputs[i]}: </label>
              <input
                type={tipoCampo[i]}
                name={nombreInputs[i]}
              />
          </React.Fragment>  
          );
          break;
      }

      inputs.push(
        <React.Fragment key={nombreInputs[i]}>
          {inputElement}
          <br/>
        </React.Fragment>
      );
    }
    return inputs;
  };

  return (
    <div>
      <form name={nombre} method={metodoEnvio} action={rutaEnvio} onSubmit={handleSubmit}>
        <h2>{nombre}</h2>
        {renderInputs()}
        <input type="submit" value={nombre} />
      </form>
    </div>
  );
};

Formulario.propTypes = {
  nombre: propTypes.string.isRequired,
  metodoEnvio: propTypes.oneOf(["POST", "GET"]).isRequired,
  rutaEnvio: propTypes.string.isRequired,
  nombreInputs: propTypes.array.isRequired,
  tipoCampo: propTypes.arrayOf(propTypes.oneOf(["text", "textarea", "password", "number", "email", "date", "file", "checkbox", "radio", "select", "submit"])).isRequired,
  opcionesSelect: propTypes.arrayOf(propTypes.string),
  radioValues: propTypes.arrayOf(propTypes.string),
  checboxValues: propTypes.arrayOf(propTypes.string),
  onSubmit: propTypes.func
};

export default Formulario;