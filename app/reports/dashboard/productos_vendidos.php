<?php
require('../../helpers/report.php');
require('../../models/pedidos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Top 10 productos más vendidos');

// Se instancia el módelo marca para obtener los datos.
$pedido = new Pedidos;

// Se establece un color de relleno para mostrar el nombre de la categoría.
$pdf->SetFillColor(74,67,150);
//Se establece el color del texto
$pdf->SetTextColor(255);
// Se establece la fuente para el nombre de la categoría.
$pdf->SetFont('Times', 'B', 12);
// Se imprime una celda con el nombre de la categoría.
$pdf->Cell(0, 10, utf8_decode('Productos'), 1, 1, 'C', 1);
//Se establece el color del texto
$pdf->SetTextColor(0);

// Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
if ($dataProductos = $pedido->readProductsSold()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->SetFillColor(225);
    // Se establece la fuente para los encabezados.
    $pdf->SetFont('Times', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->Cell(96, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
    $pdf->Cell(45, 10, utf8_decode('Total vendidos'), 1, 0, 'C', 1);
    $pdf->Cell(45, 10, utf8_decode('Precio actual (US$)'), 1, 1, 'C', 1);
    // Se establece la fuente para los datos de los productos.
    $pdf->SetFont('Times', '', 11);
    // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
    foreach ($dataProductos as $rowProducto) {
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(96, 10, utf8_decode($rowProducto['nombre']), 1, 0);
        $pdf->Cell(45, 10, utf8_decode($rowProducto['totalvendidos']), 1, 0);
        $pdf->Cell(45, 10, $rowProducto['precio'], 1, 1);
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay productos para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>