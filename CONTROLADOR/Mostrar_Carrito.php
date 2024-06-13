<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$saldo_u = number_format($_SESSION['saldo_u'], 2, '.', '');
$compras = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'compra_realizada');
$total = 0.00;
$html = '<h1 class="mb-5" id="saldoNombre" value="'.$saldo_u.'">Estos son los productos en tu carrito, ' . $valor_nombre . ' y este es tu saldo '.$saldo_u.'€</h1>';

if (empty($compras)) {

    $html .= '<h2>' .  $valor_nombre . ' no tienes productos en el carrito</h2>';

} else {
    // Array para acumular los productos
    $productos_acumulados = [];

    foreach($compras as $compra) {
        $id_producto = $compra['id_producto'];
        $producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');

        if (isset($producto[0])) {
            $producto = $producto[0];
            if (isset($productos_acumulados[$id_producto])) {
                // Si el producto ya está en el array, acumula la cantidad y el precio
                $productos_acumulados[$id_producto]['cantidad'] += $compra['cantidad_c'];
            } else {
                // Si el producto no está en el array, agrega una nueva entrada
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

    foreach($productos_acumulados as $id_producto => $datos_producto) {
        $html .= '<tr name="filas">';
        $html .= '<td id="'.$id_producto.'" value="'.$id_producto.'">' .  $datos_producto['nombre'] . '</td>';
        $html .= '<td name="precio" value="' .  $datos_producto['precio'] . '">' .  $datos_producto['precio'] . '€</td>';
        $html .= '<td name="cantidad" value="' .  $datos_producto['cantidad'] . '">' .  $datos_producto['cantidad'] . '</td>';
        $html .= '<td><button class="eliminar-btn" name="botonEliminar" href="Carrito.html">Eliminar</button></td>';
        $html .= '</tr>';
        $total += $datos_producto['precio'] * $datos_producto['cantidad'];
    }

    $html .= '</tbody>
    <tfoot>
        <tr><td></td></tr>
        <tr id="total-row">
            <td>Total:</td>
            <td id="total" value="'. $total.'">'. $total.'€</td>
        </tr>
    </tfoot>
    </table>';
}

echo $html;
?>
