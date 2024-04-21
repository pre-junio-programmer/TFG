//import { withRouter } from 'react-router-dom' //Moverse entre páginas
import Formulario from '../componentes/Componente_Formulario';

const nombreInputs = ["user", "password"];
const tipoCampo = ["text", "password"];

function Login() {
    const handleSubmit = () => {
    };
  
    return (
      <div>
        <Formulario nombre="Login" metodoEnvio="POST" rutaEnvio="" nombreInputs={nombreInputs} tipoCampo={tipoCampo} onSubmit={handleSubmit}/>
      </div>  
    );
  }
  
  export default Login;
  