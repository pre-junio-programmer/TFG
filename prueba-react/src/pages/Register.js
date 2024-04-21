import { useNavigate } from 'react-router-dom';
import Formulario from '../componentes/Componente_Formulario';

const nombreInputs = ["user", "password", "direccion", "email"];
const tipoCampo = ["text", "password", "text", "email"];

function Register() {
    const navigate = useNavigate(); // Obtener la función navigate

    const handleSubmit = () => {
        // Redirigir a la página de login al enviar el formulario de registro
        navigate("/login");
    };
  
    return (
      <div>
        <Formulario nombre="Registro" metodoEnvio="POST" rutaEnvio="" nombreInputs={nombreInputs} tipoCampo={tipoCampo} onSubmit={handleSubmit}/>
      </div>
    );
}

export default Register;
