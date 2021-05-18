<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/tipoProducto.php');

    if (isset($_GET['action'])) {
        //Reanudando la sesion
        session_start();

        //Objeto para instanciar la clase
        $tipoP = new tipoProducto();

        //Arreglo para guardar respuestas de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

        //Acciones a ejecutar permitidas con la sesion iniciada
        if (isset($_SESSION['idAdmon'])) {
            switch($_GET['action']){
                case 'readAll':
                    if ($result['dataset'] = $tipoP -> readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de tipos de productos';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de tipos de productos.';
                        }
                    }
                    break;
                case 'readOne':
                    $_POST = $tipoP -> validateForm($_POST);
                    if($tipoP->setidSub($_POST['idsubcategoria'])){
                        if($result['dataset'] = $tipoP->readOne()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Tipo Producto inexistente';
                            }
                        }
                    } else{
                        $result['exception'] = 'Tipo de producto seleccionado incorrecto';
                    }
                    break;
                case 'readcategoria':
                    if ($result['dataset'] = $tipoP -> readcategoria()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de tipos de producto.';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de estados de marcas.';
                        }
                    }
                    break;

                case 'createRow':
                    $_POST = $tipoP -> validateForm($_POST);
                    if ($marcas->setsubcategoria($_POST['sub'])) {
                        if ($tipoP -> createRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Tipo de producto registrado correctamente.';
                        }else{
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                    }else{
                        $result['exception'] = 'Escriba otro nombre para el tipo de producto.';
                    }
                    break;
                case 'updateRow':
                    $_POST = $marcas -> validateForm($_POST);
                        if ($marcas -> setidSub($_POST['idcategoria'])) {
                            if ($data = $tipoP -> readOne()) {
                                if ($tipoP->setsubcategoria($_POST['sub'])) {
                                    if (isset($_POST['cbProducto'])) {
                                        if ($tipoP->setidCategoria($_POST['cbProducto'])) {
                                            if ($tipoP->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Tipo de producto actualizado correctamente.';
                                            }
                                            else{
                                                $result['error'] = 1;
                                                $result['exception'] = Database::getException();
                                            }
                                        }else{
                                            $result['exception'] = 'Categoria invalido.';
                                        }
                                    }else{
                                         
                                    }
                                }else{
                                    $result['exception'] = 'Escriba el tipo de producto nuevamente.';
                                }
                            }else{
                                $result['exception'] = 'Tipo de producto incorrecto.';
                            }
                        }else{
                            $result['exception'] = 'Tipo de Producto seleccionado incorrecto';
                        }
                    break;
                case 'delete':
                    $_POST = $tipoP -> validateForm($_POST);
                    if ($tipoP -> setidSub($_POST['idsucategoria'])) {
                        if ($tipoP -> deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Registro eliminado correctamente';
                        }else{
                            $result['exception'] = Database::getException();
                        }
                    }else{
                        $result['exception'] = 'Id invalido';
                    }
                    break;
                case 'search':
                    $_POST = $tipoP->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $tipoP->searchRows($_POST['search'])) {
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
            }
            // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
            header('content-type: application/json; charset=utf-8');
            // Se imprime el resultado en formato JSON y se retorna al controlador.
            print(json_encode($result));
        }
        //Si la sesion no esta iniciada, entonces:
        else{
            print(json_encode('Acceso denegado. Por favor iniciar sesión'));
        }
    }
    else{
        print(json_encode('El recurso no esta disponible'));
    }
?>