import React, { useState, useEffect } from 'react';

/**
 * Crea un producto en base a los parámetros proporcionados
 * @param {String} nombreP Nombre del producto
 * @param {String} descripcionP Descripción del producto
 * @param {String} imgP ID de la imagen en Google Drive
 * @param {Number} precioP Precio del producto
 * @returns {React.Component} Producto
 */
export const Producto = ({ nombreP, descripcionP, imgP, precioP }) => {
  const [urlCarpeta, setUrlCarpeta] = useState('');

  useEffect(() => {
    // Supongamos que obtienes la URL de la carpeta pública de alguna fuente de datos
    const imgUrl = "https://drive.google.com/uc?export=download&id=1FHHADRXR-mHei6ddwmo5PyG_kKVlkUlL";
    const urlRecuperada = imgUrl;
  
    // Actualizar el estado con la URL recuperada
    setUrlCarpeta(urlRecuperada);
  
    console.log(urlRecuperada); // Imprime la URL generada
  }, [imgP]);
  

  return (
    <div>
      <img
        src={urlCarpeta} // Utiliza la URL actualizada de la imagen
        alt={`Foto de ${nombreP}`}
        id={`Foto-${nombreP}`}
        style={{height: '80px', width: '80px'}}
      />
      <h2>{nombreP}</h2>
      <h3><b>{precioP}</b></h3>
      <p>{descripcionP}</p>
    </div>
  );
}

export default Producto;
