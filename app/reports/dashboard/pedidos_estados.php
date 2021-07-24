<?php
require('../../helpers/report.php');
require('../../models/pedidos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Pedidos por estado');

// Se instancia el módelo pedido para obtener los datos.
$pedido = new Pedidos;
// Se verifica si existen registros (pedido) para mostrar, de lo contrario se imprime un mensaje.
if ($dataEstados = $pedido->readAllEstadoPedido()) {
    // Se recorren los registros ($dataEstados) fila por fila ($rowEstado).
    foreach ($dataEstados as $rowEstado) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(74,67,150);
        //Se establece el color del texto
        $pdf->SetTextColor(255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Times', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Estado: '.$rowEstado['estadopedido']), 1, 1, 'C', 1);
        //Se establece el color del texto
        $pdf->SetTextColor(0);
        // Se establece la categoría para obtener sus Pedidos, de lo contrario se imprime un mensaje de error.
        if ($pedido->setIdEstadoPedido($rowEstado['idestadopedido'])) {
            // Se verifica si existen registros (Pedidos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataPedidos = $pedido->readPedidosEstado()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(130, 10, utf8_decode('Cliente'), 1, 0, 'C', 1);
                $pdf->Cell(56, 10, utf8_decode('Fecha (AAAA-MM-DD)'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los Pedidos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataPedidos) fila por fila ($rowPedido).
                foreach ($dataPedidos as $rowPedido) {
                    // Se imprimen las celdas con los datos de los Pedidos.
                    $pdf->Cell(130, 10, utf8_decode($rowPedido['cliente']), 1, 0);
                    $pdf->Cell(56, 10, $rowPedido['fechapedido'], 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos para esta marca'), 1, 1);
            }
        } else {
            $pdf->Cell(0, 10, utf8_decode('Marca incorrecta o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay marcas para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>