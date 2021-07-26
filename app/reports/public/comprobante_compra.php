<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/pedidos.php');

    // Se instancia el módelo Pedidos para procesar los datos.
    $pedido = new Pedidos;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($pedido->setIdPedido($_GET['id'])) {
        // Se instancia la clase para crear el reporte.
        $pdf = new Report;
        // Se inicia el reporte con el encabezado del documento.
        $pdf->startReportPublic('Comprobante de compra');
        if($dataPedido = $pedido->readOne()) {
             // Se establece un color de relleno para mostrar el nombre de la Puntuación.
             $pdf->SetFillColor(255);
            // Se establece la fuente para el nombre de la Puntuación.
            $pdf->SetFont('Times', 'B', 12);
            // Se imprimen las celdas con los encabezados.
            $pdf->Cell(40, 10, utf8_decode('Fecha del pedido: '), 0, 0, 'L', 1);
            // Se establece la fuente para los encabezados.
            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(75, 10, $dataPedido['fechapedido'], 0, 1, 'L', 1);
            // Se establece la fuente para el nombre de la Puntuación.
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(40, 10, utf8_decode('Estado: '), 0, 0, 'L', 1);
            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(75, 10, $dataPedido['estadopedido'], 0, 1, 'L', 1);
            //Se hace un salto de line
            $pdf->Ln();
            // Se verifica si existen registros (Puntuación) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataCliente = $pedido->readClientReport()) {
                // Se establece un color de relleno para mostrar el nombre de la Puntuación.
                $pdf->SetFillColor(255);
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 15);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(48, 10, utf8_decode('Detalle del cliente: '), 0,1, 'L');
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 12);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(48, 10, utf8_decode('Apellido: '), 1, 0, 'L', 1);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Times', '', 11);
                $pdf->Cell(75, 10, $dataCliente['apellido'], 1, 1, 'L', 1);
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 12);
                $pdf->Cell(48, 10, utf8_decode('Nombre: '), 1, 0, 'L', 1);
                $pdf->SetFont('Times', '', 11);
                $pdf->Cell(75, 10, $dataCliente['nombre'], 1, 1, 'L', 1);
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 12);
                $pdf->Cell(48, 10, utf8_decode('Correo: '), 1, 0, 'L', 1);
                $pdf->SetFont('Times', '', 11);
                $pdf->Cell(75, 10, $dataCliente['correo'], 1, 1, 'L', 1);
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 12);
                $pdf->Cell(48, 10, utf8_decode('Teléfono: '), 1, 0, 'L', 1);
                $pdf->SetFont('Times', '', 11);
                $pdf->Cell(75, 10, $dataCliente['telefono'], 1, 1, 'L', 1);
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 12);
                $pdf->Cell(48, 10, utf8_decode('Dirección: '), 1, 0, 'L', 1);
                $pdf->SetFont('Times', '', 11);
                $pdf->Cell(75, 10, $dataCliente['direccion'], 1, 1, 'L', 1);
                //Se hace un salto de line
                $pdf->Ln();
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 15);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(48, 10, utf8_decode('Detalle del productos: '), 0,1, 'L');
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Times', 'B', 12);
                // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
                if ($dataProducts = $pedido->getProducts()) {
                    // Se establece un color de relleno para los encabezados.
                    $pdf->SetFillColor(225);
                    // Se establece la fuente para los encabezados.
                    $pdf->SetFont('Times', 'B', 11);
                    // Se imprimen las celdas con los encabezados.
                    $pdf->Cell(35, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
                    $pdf->Cell(70, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                    $pdf->Cell(40, 10, utf8_decode('Precio Unitario ($)'), 1, 0, 'C', 1);
                    $pdf->Cell(40, 10, utf8_decode('Monto total ($)'), 1, 1, 'C', 1);
                    // Se establece la fuente para los datos de los productos
                    $pdf->SetFont('Times', '', 11);
                    // Se recorren los registros ($dataProducts) fila por fila ($rowProduct).
                    foreach ($dataProducts as $rowProduct) {
                        //Se imprimen las celdas
                        $pdf->Cell(35, 10, $rowProduct['cantidad'], 1, 0);
                        $pdf->Cell(70, 10, $rowProduct['nombre'], 1, 0);
                        $pdf->Cell(40, 10, $rowProduct['precioproducto'], 1, 0);
                        $pdf->Cell(40, 10, $rowProduct['montototal'], 1, 1);
                    }
                    if ($rowTotal = $pedido->getTotalPrice()) {
                        $pdf->Cell(105, 10, utf8_decode('Total pedido: '), 1, 0, 'C', 1);
                        $pdf->Cell(40, 10, $rowTotal['totalpedido'], 1, 0);
                        $pdf->Cell(40, 10, $rowTotal['totalunitario'], 1, 1);
                    } else {
                        $pdf->Cell(0, 10, utf8_decode('No hay productos para este pedido.'), 1, 1);
                    }
                } else {
                    $pdf->Cell(0, 10, utf8_decode('No hay productos para este pedido.'), 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar.'), 1, 1);
            }
        } else {
            $pdf->Cell(0, 10, utf8_decode('Hubo error al mostrar el pedido.'), 1, 1);
        } 
        
        // Se envía el documento al navegador y se llama al método Footer()
        $pdf->Output();
    } else {
        header('location: ../../../views/public/index.php');
    }
} else {
    header('location: ../../../views/public/index.php');
}
?>
