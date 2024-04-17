import { Typography } from '@mui/material';
import './App.css';
import Formulario from './componentes/Componente_Formulario.js';
import { Producto } from './componentes/Componente_Producto.js';
import HoverRating from './componentes/Componente_Rating.js';
import RecipeReviewCard from './componentes/Componente_Productos.js';
import TemporaryDrawer from './componentes/Componente_Menu.js';
import BasicPagination from './componentes/Componente_Paginacion.js';

//PARA INICIAR EL PROYECTO TENEMOS QUE PONER NPM START PRUEBA-REACT
const nombreInputs = ["text", "textarea", "password", "number", "email", "date", "file", "checkbox", "radio", "select", "submit"];
const tipoInputs = ["text", "textarea", "password", "number", "email", "date", "file", "checkbox", "radio", "select", "submit"];
const optionsSelect = ["Hola", "Adios"]; //Array con los valores del option para el select
const radioValues = ["Si", "No"];
const checboxValues = ["Si", "Puede", "Quizá", "No"];

function App() {
  const handleSubmit = () => {
    // Lógica de envío del formulario
    console.log('Formulario enviado');
  };

  return (
    <div>
      <Formulario nombre="Inicio Sesion" metodoEnvio="POST" rutaEnvio="" nombreInputs={nombreInputs} tipoCampo={tipoInputs} opcionesSelect={optionsSelect} radioValues={radioValues} checboxValues={checboxValues} onSubmit={handleSubmit}/>
      <Producto nombreP="Producto prueba" descripcionP="Un producto de prueba" imgP={"1FHHADRXR-mHei6ddwmo5PyG_kKVlkUlL"} precioP="23.3"/>
      <Typography component="legend">Componente 1</Typography>
      <HoverRating />
      <RecipeReviewCard />
      <TemporaryDrawer />
      <BasicPagination />
    </div>
    
  );
}

export default App;
