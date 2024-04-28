import Formulario from '../componentes/Componente_Formulario';

const nombreInputs = ["numeroTarjeta", "fechaCaducidad", "numSecreto", "nombreUsuarioTarjeta", "saldoTarjeta"];
const tipoCampo = ["number", "date", "number", "text", "number"];

function Login() {
    const handleSubmit = () => {
    };
  
    return (
      <div>
        <Formulario nombre="Informacion tarjeta" metodoEnvio="POST" rutaEnvio="" nombreInputs={nombreInputs} tipoCampo={tipoCampo} onSubmit={handleSubmit}/>
      </div>  
    );
  }
  
  export default Login;
  