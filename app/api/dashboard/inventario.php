<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/inventario.php');

//Verificando si existe una acción
if(isset($_GET['action'])){
    //Reanudando sesion
    session_start();
    //Instanciando clase necesaria
    $inventario = new Inventario();
    //Array para guardar respuesta de la API
    $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

    if(isset($_SESSION['idAdmon'])){
        //Verificando acción
        switch($_GET['action']){
            case 'readAll':
                if($result['dataset'] = $inventario->readAll()){
                    $result['status'] = 1;
                    $result['message'] = 'Existe al menos un registro';
                } else{
                    if(Database::getException()){
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else{
                        $result['exception'] = 'No hay productos registrados';
                    }
                }
                break;
            case 'readAllProducto':
                if($result['dataset'] = $inventario->readAllProducto()){
                    $result['status'] = 1;
                } else{
                    if(Database::getException()){
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else{
                        $result['exception'] = 'No hay productos registrados';
                    }
                }
                break;
            case 'readAllTalla':
                if($result['dataset'] = $inventario->readAllTalla()){
                    $result['status'] = 1;
                } else{
                    if(Database::getException()){
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else{
                        $result['exception'] = 'No hay tallas registradas';
                    }
                }
                break;
            case 'readOne':
                $_POST = $inventario->validateForm($_POST);
                if($inventario->setId($_POST['idInventario'])){
                    if($result['dataset'] = $inventario->readOne()){
                        $result['status'] = 1;
                    } else{
                        if(Database::getException()){
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        } else{
                            $result['exception'] = 'El producto seleccionado no existe';
                        }
                    }
                } else{
                    $result['exception'] = 'Producto seleccionado incorrecto';
                }
                break;
            case 'search':
                $_POST = $inventario->validateForm($_POST);
                if($_POST['search'] != ''){
                    if($result['dataset'] = $inventario->searchRows($_POST['search'])){
                        $result['status'] = 1;
                        $row = count($result['dataset']);
                        if($row > 1){
                            $result['message'] = 'Se han encontrado '.$row.' coincidencias';
                        }else{
                            $result['message'] = 'Se ha encontrado una coincidencia';
                        }
                    } else{
                        if(Database::getException()){
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        } else{
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                } else{
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            //Caso para actualizar el stock en base al actual.
            case 'updateStock':
                $_POST = $inventario->validateForm($_POST);
                if ($inventario->setCantidad($_POST['stockNuevo'])) {
                    if ($inventario->setId($_POST['idProductoInventario'])) {
                        if ($inventario->updateStock()) {
                            $result['status'] = 1;
                            $result['message'] = 'Stock actualizado correctamente.';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    
                } else {
                    $result['exception'] = 'Stock incorrecto';
                }   
                break;
            case 'create':
                $_POST = $inventario->validateForm($_POST);
                if($inventario->setCantidad($_POST['Cantidad'])){
                    if(isset($_POST['cbProducto'])){
                        if($inventario->setIdProducto($_POST['cbProducto'])){
                            if(isset($_POST['cbTalla'])){
                                if($inventario->setIdTalla($_POST['cbTalla'])){
                                    if ($inventario->createRow()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Inventario registrado correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }  
                                }else{
                                    $result['exception'] = 'Talla incorrecta';
                                }
                            } else{
                                $result['exception'] = 'Seleccione una talla';
                            }
                        }else{
                            $result['exception'] = 'Producto incorrecto';
                        }
                    } else{
                        $result['exception'] = 'Seleccione un producto';
                    }
                } else{
                    $result['exception'] = 'Cantidad incorrecta';
                }
                break;
            case 'update':
                $_POST = $inventario->validateForm($_POST);
                if($inventario->setId($_POST['idInventario'])){
                    if($data = $inventario->readOne()){
                        if($inventario->setCantidad($_POST['Cantidad'])){
                            if(isset($_POST['cbProducto'])){
                                if($inventario->setIdProducto($_POST['cbProducto'])){
                                    if(isset($_POST['cbTalla'])){
                                        if($inventario->setIdTalla($_POST['cbTalla'])){
                                            if ($inventario->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Inventario actualizado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }  
                                        }else{
                                            $result['exception'] = 'Talla incorrecta';
                                        }
                                    } else{
                                        $result['exception'] = 'Seleccione una talla';
                                    }
                                }else{
                                    $result['exception'] = 'Producto incorrecto';
                                }
                            } else{
                                $result['exception'] = 'Seleccione un producto';
                            }
                        } else{
                            $result['exception'] = 'Cantidad incorrecta';
                        }
                    } else{
                        if(Database::getException()){
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        } else{
                            $result['exception'] = 'El Inventario seleccionado no existe';
                        }
                    }
                } else{
                    $result['exception'] = 'Inventario seleccionado incorrecto';
                }
                break;
            case 'delete':
                $_POST = $inventario->validateForm($_POST);
                if($inventario->setId($_POST['idInventario'])){
                    if($data = $inventario->readOne()){
                        if ($inventario->deleteRow()) {
                            $result['status'] = 1;
                                $result['message'] = 'Inventario eliminado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                    } else{
                        if(Database::getException()){
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        } else{
                            $result['exception'] = 'El Inventario seleccionado no existe';
                        }
                    }
                } else{
                    $result['exception'] = 'Inventario seleccionado incorrecto';
                }
                break;
            default: 
                $result['exception'] = 'No existe la acción solicitada';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else{
        print(json_encode('Acceso denegado, por favor iniciar sesión'));
    }
} else{ 
    print(json_encode('Recurso no disponible'));
}
?>