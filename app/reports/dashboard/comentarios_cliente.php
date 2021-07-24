<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/reseñas.php');

    // Se instancia el módelo Reseñas para procesar los datos.
    $resena = new Resenas();

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($resena->setIdCliente($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowCliente = $resena->readClient()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Comentarios realizados por '.$rowCliente['cliente']);
            // Se verifica si existen registros (Puntuación) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataPuntuacion = $resena->readpuntuacion()) {
                // Se recorren los registros ($dataPuntuacion) fila por fila ($rowPuntuacion).
                foreach ($dataPuntuacion as $rowPuntuacion) {
                    //Se establece el color del texto
                    $pdf->SetTextColor(255);
                    // Se establece un color de relleno para mostrar el nombre de la Puntuación.
                    $pdf->SetFillColor(74,67,150);
                    // Se establece la fuente para el nombre de la Puntuación.
                    $pdf->SetFont('Times', 'B', 12);
                    // Se imprime una celda con el nombre de la Puntuación.
                    $pdf->Cell(0, 10, utf8_decode('Puntuación: '.$rowPuntuacion['puntuacion']), 1, 1, 'C', 1);
                    //Se establece el color del texto
                    $pdf->SetTextColor(0);
                    // Se establece la puntuacion para obtener en que comentarios se usan, de lo contrario se imprime un mensaje de error.
                    if ($resena->setIdPuntuacion($rowPuntuacion['idpuntuacion'])) {
                        // Se verifica si existen registros (comentario) para mostrar, de lo contrario se imprime un mensaje.
                        if ($dataComments = $resena->readCommentsClient()) {
                            // Se establece un color de relleno para los encabezados.
                            $pdf->SetFillColor(225);
                            // Se establece la fuente para los encabezados.
                            $pdf->SetFont('Times', 'B', 11);
                            // Se imprimen las celdas con los encabezados.
                            $pdf->Cell(140, 10, utf8_decode('Comentario'), 1, 0, 'C', 1);
                            $pdf->Cell(46, 10, utf8_decode('Producto'), 1, 1, 'C', 1);
                            // Se establece la fuente para los datos de los comentario.
                            $pdf->SetFont('Times', '', 11);
                            // Se recorren los registros ($dataComments) fila por fila ($rowComment).
                            foreach ($dataComments as $rowComment) {
                                //Se imprimen las celdas
                                $pdf->Cell(140, 10, $rowComment['comentario'], 1, 0);
                                $pdf->Cell(46, 10, $rowComment['producto'], 1, 1);
                            }
                        } else {
                            $pdf->Cell(0, 10, utf8_decode('No hay comentarios para está puntuación.'), 1, 1);
                        }
                    } else {
                        $pdf->Cell(0, 10, utf8_decode('Puntuación incorrecta o inexistente.'), 1, 1);
                    }
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay puntuaciones para mostrar.'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
            $pdf->Output();
        } else {
            header('location: ../../../views/dashboard/administrar_clientes.php');
        }
    } else {
        header('location: ../../../views/dashboard/administrar_clientes.php');
    }
} else {
    header('location: ../../../views/dashboard/administrar_clientes.php');
}
?>
