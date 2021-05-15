<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/marcas.php');

    if (isset($_GET['action'])) {
        //Reanudando la sesion
        session_start();

        //Objeto para instanciar la clase
        $marcas = new Marcas();

        //Arreglo para guardar respuestas de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

        //Acciones a ejecutar permitidas con la sesion iniciada
        if (isset($_SESSION['idAdmon'])) {
            switch($_GET['action']){
                case 'readAll':
                    if ($result['dataset'] = $marcas -> readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de marcas';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de marcas.';
                        }
                    }
                    break;
                case 'readOne':
                    $_POST = $marcas -> validateForm($_POST);
                    if($marcas->setIdMarca($_POST['idMarca'])){
                        if($result['dataset'] = $marcas->readOne()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Marca inexistente';
                            }
                        }
                    } else{
                        $result['exception'] = 'Marca seleccionado incorrecto';
                    }
                    break;
                case 'readEstadoMarca':
                    if ($result['dataset'] = $marcas -> readEstadoMarca()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de estados de marcas.';
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
                    $_POST = $marcas -> validateForm($_POST);
                    if ($marcas->setNombreMarca($_POST['txtMarca'])) {
                        if ($marcas -> createRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Marca registrada correctamente.';
                        }else{
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                    }else{
                        $result['exception'] = 'Escriba otro nombre para la marca.';
                    }
                    break;
                case 'updateRow':
                    $_POST = $marcas -> validateForm($_POST);
                        if ($marcas -> setIdMarca($_POST['idMarca'])) {
                            if ($data = $marcas -> readOne()) {
                                if ($marcas->setNombreMarca($_POST['txtMarca'])) {
                                    if (isset($_POST['cbEstadoMarca'])) {
                                        if ($marcas->setIdEstadoMarca($_POST['cbEstadoMarca'])) {
                                            if ($marcas->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Nombre de marca actualizado correctamente.';
                                            }
                                            else{
                                                $result['error'] = 1;
                                                $result['exception'] = Database::getException();
                                            }
                                        }else{
                                            $result['exception'] = 'Estado invalido.';
                                        }
                                    }else{
                                         
                                    }
                                }else{
                                    $result['exception'] = 'Escriba la marca nuevamente.';
                                }
                            }else{
                                $result['exception'] = 'Marca incorrecta.';
                            }
                        }else{
                            $result['exception'] = 'Marca seleccionado incorrecto';
                        }
                    break;
                case 'delete':
                    $_POST = $marcas -> validateForm($_POST);
                    if ($marcas -> setIdMarca($_POST['idMarca'])) {
                        if ($marcas -> deleteRow()) {
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
                    $_POST = $marcas->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $marcas->searchRows($_POST['search'])) {
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