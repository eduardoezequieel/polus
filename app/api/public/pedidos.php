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
            //Caso para leer si el producto es ropa
            case 'checkClothes':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto2'])) {
                    if ($pedidos->checkClothes()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No es ropa';
                    }
                } else {
                    $result['error'] = 1;
                    $result['exception'] = 'Hubo un error al seleccionar el producto';
                }
                break;
            //Caso para llenar el combobox de tallas si el producto es ropa
            case 'readTallaProducto':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto2'])) {
                    if ($result['dataset'] = $pedidos->readTallaProducto()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay tallas registradas para este producto';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto';
                }
                break;
            //Caso para leer los datos del producto que es ropa
            case 'showClothesStock':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto2'])) {
                    if (isset($_POST['cbTalla'])) {
                        if ($pedidos->setIdTalla($_POST['cbTalla'])) {
                            if ($result['dataset'] = $pedidos->showClothesStock()) {
                                $result['status'] = 1;
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'No se pudo mostrar los detalles del producto seleccionado.';
                                }
                            }
                        } else {
                            $result['exception'] = 'Hubo un error al selccionar la talla.';
                        }
                    } else {
                        $result['exception'] = 'Seleccione una talla.';
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto xx.';
                }
                break;
            //Caso para leer el producto seleccionado de tipo ropa
            case 'readClothesDetail':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto2'])) {
                    if ($result['dataset'] = $pedidos->readClothesDetail()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay registros en stock para el producto seleccionado.';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto fd';
                }
                break;
            //Caso para leer el producto seleccionado de tipo diferente a ropa
            case 'readNoClothesDetail':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto2'])) {
                    if ($result['dataset'] = $pedidos->readNoClothesDetail()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay registros en stock para el producto seleccionado.';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto.';
                }
                break;
            //Caso para verificar si hay pedidos activos para el cliente logeado, si no se agrega uno
            case 'startOrder':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->startOrder()) {
                    if ($pedidos->setCantidad($_POST['txtCantidad'])) {
                        if ($pedidos->setIdProducto($_POST['idProducto2'])) {
                            if (isset($_POST['cbTalla'])) {
                                if ($pedidos->setIdTalla($_POST['cbTalla'])) {
                                    if ($pedidos->createDetail()) {
                                        $result['status'] = 1;
                                        if ($pedidos->minusStock()) {
                                            $result['message'] = 'El producto se ha agregado al carrito correctamente.';
                                        } else {
                                            if (Database::getException()) {
                                                $result['exception'] = Database::getException();
                                            } 
                                            $result['message'] = 'El producto se ha agregado al carrito correctamente 
                                                                    pero el inventario no fue afectado.';
                                        } 
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } else {
                                            $result['exception'] = 'El producto no se ha agregado al carrito correctamente.';
                                        }
                                    }
                                } else {
                                    $result['exception'] = 'Hubo un error al seleccionar la talla.';
                                }
                            } else {
                                $pedidos->setIdTalla(11);
                                if ($pedidos->createDetail()) {
                                    $result['status'] = 1;
                                    if ($pedidos->minusStock()) {
                                        $result['message'] = 'El producto se ha agregado al carrito correctamente.';
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } 
                                        $result['message'] = 'El producto se ha agregado al carrito correctamente 
                                                                pero el inventario no fue afectado.';
                                    } 
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'El producto no se ha agregado al carrito correctamente.';
                                    }
                                }
                            }
                        } else {
                            $result['exception'] = 'Hubo un error al seleccionar el producto.';
                        }
                    } else {
                        $result['exception'] = 'Hubo un error al seleccionar la cantidad.';
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se encontrado ni agregado el pedido.';
                    }
                }
                break;
            //Caso para mostrar los datos del carrito
            case 'readOrderDetail':
                if ($pedidos->checkClientePedidoActivo()) {
                    if ($result['dataset'] = $pedidos->readOrderDetail()) {
                        $result['status'] = 1;
                        $_SESSION['idPedido'] = $pedidos->getIdPedido();
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Hubo un error al obtener el detalle del carrito.';
                        }
                    }
                } else {
                    $result['exception'] = 'Actualmente no tienes pedidos activos.';
                }
                break;
            //Caso para eliminar un registro del pedido
            case 'deleteDetail':
                if ($pedidos->setIdDetallePedido($_POST['id_detalle'])) {
                    if ($pedidos->deleteDetail()) {
                        $result['status'] = 1;
                        $result['message'] = 'Producto removido correctamente.';
                    } else {
                        $result['exception'] = 'Ocurrió un problema al remover el producto.';
                    }
                } else {
                    $result['exception'] = 'Detalle incorrecto.';
                }
                break;
            //Caso para leer si el producto en el carrito es ropa
             case 'checkClothesCart':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto3'])) {
                    if ($pedidos->checkClothes()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No es ropa';
                    }
                } else {
                    $result['error'] = 1;
                    $result['exception'] = 'Hubo un error al seleccionar el producto del carrito.';
                }
                break;
             //Caso para leer los datos del producto en el carrito que es ropa
             case 'showClothesStockCart':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto3'])) {
                    if (isset($_POST['cbTallas'])) {
                        if ($pedidos->setIdTalla($_POST['cbTallas'])) {
                            if ($pedidos->setCantidad($_POST['cantidadCart'])) {
                                if ($result['dataset'] = $pedidos->showClothesStockCart()) {
                                    $result['status'] = 1;
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'No se pudo mostrar los detalles del producto seleccionado.';
                                    }
                                }
                            } else {
                                $result['exception'] = 'Hubo un error al selccionar la cantidad.';
                            }
                        } else {
                            $result['exception'] = 'Hubo un error al selccionar la talla.';
                        }
                    } else {
                        $result['exception'] = 'Seleccione una talla.';
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto del carrito.';
                }
                break;
            //Caso para leer el producto seleccionado en el carrito de tipo ropa
            case 'readClothesDetailCart':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto3'])) {
                    if ($result['dataset'] = $pedidos->readClothesDetail()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay registros en stock para el producto seleccionado.';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto del carrito.';
                }
                break;
            //Caso para leer el producto seleccionado en el carrito de tipo diferente a ropa
            case 'readNoClothesDetailCart':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto3'])) {
                    if ($pedidos->setCantidad($_POST['cantidadCart'])) {
                        if ($result['dataset'] = $pedidos->readNoClothesDetailCart()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay registros en stock para el producto seleccionado.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Hubo un error al seleccionar la cantidad del carrito.';
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto del carrito.';
                }
                break;
            //Caso para llenar el combobox de tallas en el carrito si el producto es ropa
            case 'readTallaProductoCart':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdProducto($_POST['idProducto3'])) {
                    if ($result['dataset'] = $pedidos->readTallaProducto()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay tallas registradas para este producto';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar el producto en el carrito';
                }
                break;
            //Caso para checkear el inventario
            case 'checkStockCart':
                if ($pedidos->setStockReal($_POST['cantidadCart'])) {
                    if ($pedidos->setCantidad($_POST['txtCantidad4'])) {
                        if ($pedidos->setIdProducto($_POST['idProducto3'])) {
                            if ($pedidos->setIdDetallePedido($_POST['idDetalle'])) {
                                if (isset($_POST['cbTallas'])) {
                                    if ($pedidos->setIdTalla($_POST['cbTallas'])) {
                                        if ($pedidos->plusStock()) {
                                            if ($pedidos->minusStock()) {
                                                if ($pedidos->updateDetalle()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Se actualizó la cantidad correctamente.';
                                                } else {
                                                    if (Database::getException()) {
                                                        $result['exception'] = Database::getException();
                                                    } else {
                                                        $result['exception'] = 'No se pudo actualizar correctamente.';
                                                    }
                                                }
                                            } else {
                                                if (Database::getException()) {
                                                    $result['exception'] = Database::getException();
                                                } else {
                                                    $result['exception'] = 'No se pudo disminuir el stock correctamente.';
                                                }
                                               
                                            }
                                        } else {
                                            if (Database::getException()) {
                                                $result['exception'] = Database::getException();
                                            } else {
                                                $result['exception'] = 'No se pudo aumentar correctamente.';
                                            }
                                        }
                                    } else {
                                        $result['exception'] = 'Hubo un error al seleccionar la talla.';
                                    }
                                } else {
                                    $pedidos->setIdTalla(11);
                                    if ($pedidos->plusStock()) {
                                        if ($pedidos->minusStock()) {
                                            if ($pedidos->updateDetalle()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Se actualizó la cantidad correctamente.';
                                            } else {
                                                if (Database::getException()) {
                                                    $result['exception'] = Database::getException();
                                                } else {
                                                    $result['exception'] = 'No se pudo actualizar correctamente.';
                                                }
                                            }
                                        } else {
                                            if (Database::getException()) {
                                                $result['exception'] = Database::getException();
                                            } else {
                                                $result['exception'] = 'No se pudo disminuir el stock correctamente.';
                                            }
                                           
                                        }
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } else {
                                            $result['exception'] = 'No se pudo aumentar correctamente.';
                                        }
                                    }
                                }
                            } else {
                                $result['exception'] = 'Hubo un error al seleccionar el detalle.';
                            }
                        } else {
                            $result['exception'] = 'Hubo un error al seleccionar el producto.';
                        }
                    } else {
                        $result['exception'] = 'Hubo un error al seleccionar la cantidad nueva.';
                    }
                } else {
                    $result['exception'] = 'Hubo un error al seleccionar la cantidad.';
                }
                break;
            //Caso para finalizar la orden
            case 'finishOrder':
                if ($pedidos->finishOrderCart()) {
                    $result['status'] = 1;
                    $result['message'] = 'Pedido finalizado correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al finalizar el pedido';
                }
                break;
            //Caso para leer los pedidos que ha hecho el cliente
            case 'readClientRecord':
                if ($result['dataset'] = $pedidos->readClientsRecord()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No posee pedidos registrados a su nombre.';
                    }
                }
                break;
            //Caso para obtener los productos 
            case 'getProducts':
                $_POST = $pedidos->validateForm($_POST);
                if ($pedidos->setIdPedido($_POST['idPedido'])) {
                    if ($result['dataset'] = $pedidos->getProducts()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No posee pedidos registrados a su nombre.';
                        }
                    }  
                }
                break;
            //Caso para leer datos del producto que no sea ropa o que no se haya seleccionado la talla
            default:
                $result['error'] = 1;
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    
    }else{
        // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            default:
                $result['error'] = 1;
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