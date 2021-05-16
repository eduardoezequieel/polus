<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/pedidos.php');

    if (isset($_GET['action'])) {
        //Reanudando la sesion
        session_start();

        //Objeto para instanciar la clase
        $pedidos = new Pedidos();

        //Arreglo para guardar respuestas de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

        if (isset($_SESSION['idAdmon'])) {
            switch($_GET['action']){
                case 'readAll':
                    if ($result['dataset'] = $pedidos -> readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de pedidos';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de pedidos.';
                        }
                    }
                    break;
                case 'readAllEstadoPedido':
                    if ($result['dataset'] = $pedidos -> readAllEstadoPedido()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de estados de pedidos';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de estados de pedidos.';
                        }
                    }
                    break;
                case 'readOne':
                    $_POST = $pedidos -> validateForm($_POST);
                    if($pedidos->setIdPedido($_POST['idPedido'])){
                        if($result['dataset'] = $pedidos->readOne()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Pedido inexistente';
                            }
                        }
                    } else{
                        $result['exception'] = 'Pedido seleccionado incorrecto';
                    }
                    break;
                case 'getProducts':
                    $_POST = $pedidos -> validateForm($_POST);
                    if($pedidos->setIdPedido($_POST['idPedido'])){
                        if($result['dataset'] = $pedidos->getProducts()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Productos inexistentes';
                            }
                        }
                    } else{
                        $result['exception'] = 'Producto incorrecto';
                    }
                    break;
                case 'getTotalPrice':
                    $_POST = $pedidos -> validateForm($_POST);
                    if($pedidos->setIdPedido($_POST['idPedido'])){
                        if($result['dataset'] = $pedidos->getTotalPrice()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Pedido inexistente';
                            }
                        }
                    } else{
                        $result['exception'] = 'Pedido seleccionado incorrecto';
                    }
                    break;
                case 'search':
                    $_POST = $pedidos->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $pedidos->searchRows($_POST['search'])) {
                            $result['status'] = 1;
                            $rows = count($result['dataset']);
                            if ($rows > 1) {
                                $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                            } else {
                                $result['message'] = 'Solo existe una coincidencia';
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias';
                            }
                        }
                    } else {
                        $result['exception'] = 'Ingrese un valor para buscar';
                    }
                    break;
                case 'searchRowsEstadoPedido':
                    $_POST = $pedidos->validateForm($_POST);
                    if (isset($_POST['cbEstadoPedidoSearch'])) {
                        if ($pedidos -> setIdEstadoPedido($_POST['cbEstadoPedidoSearch'])) {
                            if ($result['dataset'] = $pedidos -> searchRowsEstadoPedido()) {
                                $result['status'] = 1;
                                    $rows = count($result['dataset']);
                                    if ($rows > 1) {
                                        $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                                    } else {
                                        $result['message'] = 'Solo existe una coincidencia';
                                    }
                            }else{
                                $result['exception'] = Database::getException();
                            }
                        }
                        else{
                            $result['exception'] = 'Seleccione un estado';
                        }
                    }else{
                        $result['exception'] = 'Seleccione un estado.';
                    }
                    break;
            }
            // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
            header('content-type: application/json; charset=utf-8');
            // Se imprime el resultado en formato JSON y se retorna al controlador.
            print(json_encode($result));
        }else{
            print(json_encode('Acceso denegado. Por favor iniciar sesión'));
        }
    }
    else{
        print(json_encode('El recurso no esta disponible'));
    }
?>