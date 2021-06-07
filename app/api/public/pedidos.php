<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/pedidos.php');

    //Verificando si existe una acción
    if(isset($_GET['action'])){
        //Reanudando sesion
        session_start();
        
        //Creando un objeto de la clase
        $pedidos = new Pedidos();
        //Array para guardar respuesta de la API
        $result = array('status'=>0, 'recaptcha' => 0, 'error'=>0, 'message'=>null, 'exception'=>null);
        
        //Verificando si hay alguna sesión abierta
        if(isset($_SESSION['idCliente'])){
            //Verificando acción
            switch($_GET['action']){

                //Caso verificar existencias
                case 'checkStock':
                    $_POST = $pedidos->validateForm($_POST);
                    if($pedidos->setIdProducto($_POST['idProducto2'])){
                        if($pedidos->setCantidad($_POST['txtCantidad'])){
                            if($result['dataset'] = $pedidos->checkInventario()){
                                $result['status'] = 1;
                                $result['message'] = 'Se ha encontrado';
                            } else{
                                if(Database::getException()){
                                    $result['error'] = 1;
                                    $result['exception'] = Database::getException();
                                } else{
                                    $result['exception'] = 'Este producto está fuera de stock';
                                }
                            }
                        } else{
                            $result['exception'] = 'La cantidad es incorrecta';
                        }
                    } else{
                        $result['exception'] = 'Producto seleccionado incorrecto';
                    }
                    break;

                //Caso para crear el pedido y detalle
                case 'createDetail':
                    if ($pedidos->startOrder()) {
                        $_POST = $pedidos->validateForm($_POST);
                        if ($pedidos->setIdProducto($_POST['idProducto2'])) {
                            if ($pedidos->setCantidad($_POST['txtCantidad'])) {
                                if ($pedidos->createDetail()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Producto agregado correctamente';
                                } else {
                                    $result['exception'] = 'Ocurrió un problema al agregar el producto';
                                }
                            } else {
                                $result['exception'] = 'Cantidad incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Producto incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Ocurrió un problema al obtener el pedido';
                    }
                    break;
                
                //Leer los datos de la tabla de detalle pedido
                case 'readOrderDetail':
                    if ($pedidos->startOrder()) {
                        if ($result['dataset'] = $pedidos->readOrderDetail()) {
                            $result['status'] = 1;
                            $_SESSION['idPedido'] = $pedidos->getIdPedido();
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No tiene productos en el carrito';
                            }
                        }
                    } else {
                        $result['exception'] = 'Debe agregar un producto al carrito';
                    }
                    break;
                //Eliminar detalle
                case 'deleteDetail':
                    if ($pedidos->setIdDetallePedido($_POST['id_detalle'])) {
                        if ($pedidos->deleteDetail()) {
                            $result['status'] = 1;
                            $result['message'] = 'Producto removido correctamente';
                        } else {
                            $result['exception'] = 'Ocurrió un problema al remover el producto';
                        }
                    } else {
                        $result['exception'] = 'Detalle incorrecto';
                    }
                    break;
                //Finalizar pedido
                case 'finishOrder':
                    if ($pedidos->finishOrderCart()) {
                        $result['status'] = 1;
                        $result['message'] = 'Pedido finalizado correctamente';
                    } else {
                        $result['exception'] = 'Ocurrió un problema al finalizar el pedido';
                    }
                    break;
                default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
            }
        
        }else{
            // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
            switch ($_GET['action']) {
                default:
                    $result['exception'] = 'Acción no disponible fuera de la sesión';
            }
        }
            // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
            header('content-type: application/json; charset=utf-8');
            // Se imprime el resultado en formato JSON y se retorna al controlador.
            print(json_encode($result));
    } else{
        print(json_encode('El recurso no está disponible'));
    }
?>