<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/productos.php');

//Verificando si existe una acción
if(isset($_GET['action'])){
    //Reanudando sesion
    session_start();
    //Instanciando clase necesaria
    $productos = new Productos();
    //Array para guardar respuesta de la API
    $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

    //Verificando acción
    switch($_GET['action']){
        case 'readAll':
            if($result['dataset'] = $productos->readAll()){
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
        case 'readAllSub':
            if($result['dataset'] = $productos->readAllSubcategorias()){
                $result['status'] = 1;
            } else{
                if(Database::getException()){
                    $result['error'] = 1;
                    $result['exception'] = Database::getException();
                } else{
                    $result['exception'] = 'No hay subcategorias registradas';
                }
            }
            break;
        case 'readAllMarca':
            if($result['dataset'] = $productos->readAllMarca()){
                $result['status'] = 1;
            } else{
                if(Database::getException()){
                    $result['error'] = 1;
                    $result['exception'] = Database::getException();
                } else{
                    $result['exception'] = 'No hay marcas registradas';
                }
            }
            break;
        case 'readOne':
            if($productos->setId($_POST['idProducto'])){
                if($result['dataset'] = $productos->readOne()){
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
            $_POST = $productos->validateForm($_POST);
            if($_POST['search'] != ''){
                if($result['dataset'] = $productos->searchRows($_POST['search'])){
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
        case 'create':
            $_POST = $productos->validateForm($_POST);
            if($productos->setNombre($_POST['txtNombre'])){
                if($productos->setDescripcion($_POST['txtDescripcion'])){
                    if($productos->setPrecio($_POST['txtPrecio'])){
                        if(isset($_POST['cbMarca'])){
                            if($productos->setMarca($_POST['cbMarca'])){
                                if(isset($_POST['cbSubcategoria'])){
                                    if($productos->setSubcategoria($_POST['cbSubcategoria'])){
                                        if (is_uploaded_file($_FILES['archivo_producto']['tmp_name'])) {
                                            if ($productos->setImagenPrincipal($_FILES['archivo_producto'])) {
                                                if ($productos->createRow()) {
                                                    $result['status'] = 1;
                                                    if ($productos->saveFile($_FILES['archivo_producto'], $productos->getRuta(), $productos->getImagenPrincipal())) {
                                                        $result['message'] = 'Producto registrado correctamente';
                                                    } else {
                                                        $result['message'] = 'Producto registrado pero no se guardó la imagen';
                                                    }
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['exception'] = $result->getImageError();
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una imagen';
                                        }    
                                    }else{
                                        $result['exception'] = 'Subcategoria incorrecta';
                                    }
                                } else{
                                    $result['exception'] = 'Seleccione una subcategoria';
                                }
                            }else{
                                $result['exception'] = 'Marca incorrecta';
                            }
                        } else{
                            $result['exception'] = 'Seleccione una marca';
                        }
                    } else{
                        $result['exception'] = 'Precio incorrecto';
                    }
                } else{
                    $result['exception'] = 'Descripción incorrecta';
                }
            } else{
                $result['exception'] = 'Nombre incorrecto';
            }
            break;
        case 'update':
            $_POST = $productos->validateForm($_POST);
            if($productos->setId($_POST['idProducto'])){
                if($data = $productos->readOne()){
                    if($productos->setNombre($_POST['txtNombre'])){
                        if($productos->setDescripcion($_POST['txtDescripcion'])){
                            if($productos->setPrecio($_POST['txtPrecio'])){
                                if(isset($_POST['cbMarca'])){
                                    if($productos->setMarca($_POST['cbMarca'])){
                                        if(isset($_POST['cbSubcategoria'])){
                                            if($productos->setSubcategoria($_POST['cbSubcategoria'])){
                                                if (is_uploaded_file($_FILES['archivo_producto']['tmp_name'])) {
                                                    if ($productos->setImagenPrincipal($_FILES['archivo_producto'])) {
                                                        if ($productos->updateRow($data['imagenprincipal'])) {
                                                            $result['status'] = 1;
                                                            if ($productos->saveFile($_FILES['archivo_producto'], $productos->getRuta(), $productos->getImagenPrincipal())) {
                                                                $result['message'] = 'Producto registrado correctamente';
                                                            } else {
                                                                $result['message'] = 'Producto registrado pero no se guardó la imagen';
                                                            }
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } else {
                                                        $result['exception'] = $result->getImageError();
                                                    }
                                                } else {
                                                    if ($productos->updateRow($data['imagenprincipal'])) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Producto modificado correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                }    
                                            }else{
                                                $result['exception'] = 'Subcategoria incorrecta';
                                            }
                                        } else{
                                            $result['exception'] = 'Seleccione una subcategoria';
                                        }
                                    }else{
                                        $result['exception'] = 'Marca incorrecta';
                                    }
                                } else{
                                    $result['exception'] = 'Seleccione una marca';
                                }
                            } else{
                                $result['exception'] = 'Precio incorrecto';
                            }
                        } else{
                            $result['exception'] = 'Descripción incorrecta';
                        }
                    } else{
                        $result['exception'] = 'Nombre incorrecto';
                    }
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
        case 'delete':
            $_POST = $productos->validateForm($_POST);
            if($productos->setId($_POST['idProducto'])){
                if($data = $productos->readOne()){
                    if ($productos->deleteRow()) {
                        if ($productos->deleteFile($productos->getRuta(), $data['imagenprincipal'])) {
                            $result['status'] = 1;
                            $result['message'] = 'Producto eliminado correctamente';
                        } else {
                            $result['message'] = 'Producto eliminado pero no se borró la imagen';
                        }
                    } else {
                        $result['exception'] = Database::getException();
                    }
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
        default: 
            $result['exception'] = 'No existe la acción solicitada';
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else{ 
    print(json_encode('Recurso no disponible'));
}
?>