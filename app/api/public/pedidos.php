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