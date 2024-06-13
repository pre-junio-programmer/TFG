<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$saldo_u = number_format($_SESSION['saldo_u'], 2, '.', '');

//SACA TODOS LOS PRODUCTOS DEL CARRITO DE UN USUARIO
$compras = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'compra_realizada');
$total = 0.00;
$html = '<h1 class="mb-5" id="saldoNombre" value="'.$saldo_u.'">Estos son los productos en tu carrito, ' . $valor_nombre . ' y este es tu saldo '.$saldo_u.'€</h1>';

if (empty($compras)) {

    $html .= '<h2>' . htmlspecialchars($valor_nombre) . ' no tienes productos en el carrito</h2>';

} else {
    //SE CREA UN ARRAY PARA ALMACENAR LOS PRODUCTOS DEL CARRITO
    $productos_acumulados = [];

    foreach($compras as $compra) {
        $id_producto = $compra['id_producto'];

        //SACA TODOS LOS DATOS DE LOS PRODUCTOS QUE TENGA UN USUARIO EN SU CARRITO
        $producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');

        if (isset($producto[0])) {
            $producto = $producto[0];
            if (isset($productos_acumulados[$id_producto])) {
                //SI SE INTENTA AÑADIR MAS CANTIDAD A UN PRODUCTO QUE YA ESTA EN EL CARRITO SOLO SE ACTUALIZA LA CANTIDAD DEL PRODUCTO
                $productos_acumulados[$id_producto]['cantidad'] += $compra['cantidad_c'];
            } else {
                //SI UN PRODUCTO QUE SE AÑADE AL CARRITO NO ESTA PRESENTE SE AGREGA UNA NUEVA ENTRADA DE ESE PRODUCTO
                $productos_acumulados[$id_producto] = [
                    'nombre' => $producto['nombre_p'],
                    'precio' => $producto['precio_p'],
                    'cantidad' => $compra['cantidad_c']
                ];
            }
        } else {
            
        }
    }

    $html .= '<table><thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Acción</th></tr></thead><tbody>';

    //SE MUESTRAN LOS DATOS DE LOS PRODUCTOS DEL ARRAY
    foreach($productos_acumulados as $id_producto => $datos_producto) {
        $html .= '<tr name="filas">';
        $html .= '<td id="'.$id_producto.'" value="'.$id_producto.'">' . htmlspecialchars($datos_producto['nombre']) . '</td>';
        $html .= '<td name="precio" style="text-align: center" value="' . htmlspecialchars($datos_producto['precio']) . '">' . htmlspecialchars($datos_producto['precio']) . '€</td>';
        $html .= '<td name="cantidad" style="text-align: center" value="' . htmlspecialchars($datos_producto['cantidad']) . '">' . htmlspecialchars($datos_producto['cantidad']) . '</td>';
        $html .= '<td><button class="eliminar-btn" name="botonEliminar" href="Carrito.html">Eliminar</button></td>';
        $html .= '</tr>';
        $total += $datos_producto['precio'] * $datos_producto['cantidad'];
    }

    //SE MUESTRA EL TOTAL DEL COSTE DE LA VENTA DE TODOS LOS PRODUCTOS DEL CARRITO
    $html .= '</tbody>
    <tfoot>
        <tr><td></td></tr>
        <tr id="total-row">
            <td>Total:</td>
            <td id="total" value="'.htmlspecialchars($total).'">'.htmlspecialchars($total).'€</td>
        </tr>
    </tfoot>
    </table>';
}

echo $html;
?>
