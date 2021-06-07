<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/productos.php');


// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se instancian las clases correspondientes.
    $producto = new Productos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se compara la acción a realizar según la petición del controlador.
    switch ($_GET['action']) {
        case 'readAll':
            $_POST = $producto->validateForm($_POST);
            if ($producto->setIdCategoria($_POST['idCategoria'])) {
                if ($result['dataset'] = $producto->readAllPublic()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen productos para mostrar';
                    }
                }
            }else{
                $result['exception'] = 'No existen productos para mostrar';
            }
            break;
        case 'readOne':
            $_POST = $producto->validateForm($_POST);
            if ($producto->setId($_POST['idProducto'])) {
                if ($result['dataset'] = $producto->readOne()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                }
            }else{
                $result['exception'] = 'Id incorrecto';
            }
            break;
        case 'readSubcategorias':
            $_POST = $producto->validateForm($_POST);
            if ($producto->setIdCategoria($_POST['idCategoria'])) {
                if ($result['dataset'] = $producto->readSubcategoria()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen categorías para mostrar';
                    }
                }
            }else{
                $result['exception'] = 'Id incorrecto';
            }
            break;
        case 'searchBySubcategory':
            $_POST = $producto->validateForm($_POST);
            if ($producto->setIdCategoria($_POST['idCategoria'])) {
                if (isset($_POST['cbSubcategorias'])) {
                    if ($producto->setSubcategoria($_POST['cbSubcategorias'])) {
                        if ($result['dataset'] = $producto->searchBySubcategory()) {
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
                    }else{
                        
                    }
                }else{

                }
            }else{
                $result['exception'] = 'Id incorrecto';
            }
            break;
        case 'search':
            if ($producto->setIdCategoria($_POST['idCategoria'])) {
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $producto->searchByNameProduct($_POST['search'])) {
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
            }else{
                $result['exception'] = 'Id incorrecto';
            }
            break;
        default:
            $result['exception'] = 'Acción no disponible';
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
