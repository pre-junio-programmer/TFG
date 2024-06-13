<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
//EXTRAE LAS VENTAS DE LA TABLA RELACION_VENTA DEL CLIENTE
$ventas = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'relacion_venta');

//MUESTRA LAS VENTAS DEL USUARIO UNA A UNA EXTAYENDO LOS DATOS DEL PRODUCTO EN TIEMPO DE EJECUCION
$html = '<h1>Estos son tus productos a la venta, ' . $valor_nombre . '.</h1>';
if (empty($ventas)) {
    $html .= '<h2>' . $valor_nombre . ' no tiene ventas</h2>';
} else {
    //SE CREA UN ARRAY PARA ALMACENAR LOS VENTAS
    $ventas_acumuladas = [];
    
    foreach ($ventas as $venta) {
        $id_producto = $venta['id_producto'];

        //SACA TODOS LOS DATOS DE LOS PRODUCTOS QUE TENGA UN USUARIO EN SU CARRITO
        $producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');

        if (isset($producto[0])) {
            $producto = $producto[0];
            if (isset($ventas_acumuladas[$id_producto])) {
                //SI SE INTENTA AÑADIR MAS CANTIDAD A UN VENTA QUE YA ESTA EN EL LISTA SOLO SE ACTUALIZA LA CANTIDAD DEL PRODUCTO EN VENTA
                $ventas_acumuladas[$id_producto]['cantidad'] += $venta['cantidad_vr'];
            } else {
                //SI SE CREA UNA VENTA QUE NO ESTA PRESENTE EN LA LISTA SE AGREGA UNA NUEVA ENTRADA DE ESE VENTA
                $ventas_acumuladas[$id_producto] = [
                    'nombre' => $producto['nombre_p'],
                    'precio' => $producto['precio_p'],
                    'cantidad' => $venta['cantidad_vr']
                ];
            }
        }
    }

    $html .= '<table><thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Acción</th></tr></thead><tbody>';

    //SE MUESTRAN LOS DATOS DE LOS VENTAS DEL ARRAY
    foreach ($ventas_acumuladas as $id_producto => $datos_producto) {
        $html .= '<tr name="filas">';
        $html .= '<td id="' . $id_producto . '" value="' . $id_producto . '">' . $datos_producto['nombre'] . '</td>';
        $html .= '<td style="text-align: center">' . $datos_producto['precio'] . '€</td>';
        $html .= '<td id="cantidad" style="text-align: center" value="' . $datos_producto['cantidad'] . '">' . $datos_producto['cantidad'] . '</td>';
        $html .= '<td><button class="eliminar-btn" name="botonEliminar" href="MisVentas.html">Eliminar</button></td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';
}

echo $html;
?>
