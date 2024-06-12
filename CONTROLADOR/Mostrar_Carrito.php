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

    $html .= '<h2>' . htmlspecialchars($valor_nombre) . ' no tienes productos en el carrito</h2>';

} else {
  
    $html .= '<table><thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Acción</th></tr></thead><tbody>';

    foreach($compras as $compra) {
        $id_producto = $compra['id_producto'];
        $producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');

        if (isset($producto[0])) {
            $producto = $producto[0];
            $html .= '<tr name="filas">';
            $html .= '<td id="'.$producto['id_producto'].'" value="'.$producto['id_producto'].'">' . htmlspecialchars($producto['nombre_p']) . '</td>';
            $html .= '<td name="precio" value="' . htmlspecialchars($producto['precio_p']) . '">' . htmlspecialchars($producto['precio_p']) . '€</td>';
            $html .= '<td name="cantidad" value="' . htmlspecialchars($compra['cantidad_c']) . '">' . htmlspecialchars($compra['cantidad_c']) . '</td>';
            $html .= '<td><button class="eliminar-btn" name="botonEliminar" href="Carrito.html">Eliminar</button></td>';
            $html .= '</tr>';
        } else {
            $html .= '<tr name="filas">';
            $html .= '<td colspan="4">Producto no encontrado (ID: ' . htmlspecialchars($id_producto) . ')</td>';
            $html .= '</tr>';
        }
        $total = $total + ($producto['precio_p'] * $compra['cantidad_c']);
    }

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
