<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$compras = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'compra_realizada');
$total = 0.00;
$html = '<h1 class="mb-5">Estos son los productos en tu carrito, ' . htmlspecialchars($valor_nombre) . '.</h1>';
$html .= '<table><thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Acción</th></tr></thead><tbody>';

foreach($compras as $compra) {
    $id_producto = $compra['id_producto'];
    $producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');

    if (isset($producto[0])) {
        $producto = $producto[0];
        $html .= '<tr name="filas">';
        $html .= '<td id="'.$producto['id_producto'].'" value="'.$producto['id_producto'].'">' . $producto['nombre_p'] . '</td>';
        $html .= '<td name="precio" value="' . $producto['precio_p'] . '">' . $producto['precio_p'] . '€</td>';
        $html .= '<td name="cantidad" value="' . $compra['cantidad_c'] . '">' . $compra['cantidad_c']. '</td>';
        $html .= '<td><button class="eliminar-btn" name="botonEliminar" href="Carrito.html">Eliminar</button></td>';
        $html .= '</tr>';
    } else {
        $html .= '<tr name="filas">';
        $html .= '<td colspan="4">Producto no encontrado (ID: ' . $id_producto . ')</td>';
        $html .= '</tr>';
    }
    $total = $total +($producto['precio_p']*$compra['cantidad_c']);
}

$html .= '</tbody>
<tfoot>
        <tr><td></td></tr>
        <tr id="total-row">
          <td>Total:</td>
          <td id="total" value="'.$total.'">'.$total.'€</td>
        </tr>
      </tfoot>
</table>';

echo $html;
?>