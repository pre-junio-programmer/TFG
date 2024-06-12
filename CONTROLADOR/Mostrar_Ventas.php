<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$ventas = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'relacion_venta');

$html = '<h1>Estos son tus productos a la venta, ' . htmlspecialchars($valor_nombre) . '.</h1>';
if (empty($ventas)) {

    $html .= '<h2>' . htmlspecialchars($valor_nombre) . ' no tiene ventas</h2>';

} else {
    
    $html .= '<table><thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Acción</th></tr></thead><tbody>';

foreach($ventas as $venta) {
    $id_producto = $venta['id_producto'];
    $producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');

    if (isset($producto[0])) {
        $producto = $producto[0];
        $html .= '<tr name="filas">';
        $html .= '<td id="'.$producto['id_producto'].'" value="'.$producto['id_producto'].'">' . htmlspecialchars($producto['nombre_p']) . '</td>';
        $html .= '<td>' . htmlspecialchars($producto['precio_p']) . '</td>';
        $html .= '<td id="cantidad" value="' . htmlspecialchars($venta['cantidad_vr']) . '">' . htmlspecialchars($venta['cantidad_vr']) . '</td>';
        $html .= '<td><button class="eliminar-btn" name="botonEliminar" href="MisVentas.html">Eliminar</button></td>';
        $html .= '</tr>';
    } else {
        $html .= '<tr name="filas">';
        $html .= '<td colspan="4">Producto no encontrado (ID: ' . htmlspecialchars($id_producto) . ')</td>';
        $html .= '</tr>';
    }
}

$html .= '</tbody></table>';

}

echo $html;
?>