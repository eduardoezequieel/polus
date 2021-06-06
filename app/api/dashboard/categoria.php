<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/categoria.php');

    if (isset($_GET['action'])) {
        //Reanudando la sesion
        session_start();

        //Objeto para instanciar la clase
        $categoria = new categoria();

        //Arreglo para guardar respuestas de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

        //Acciones a ejecutar permitidas con la sesion iniciada
        if (isset($_SESSION['idAdmon'])) {
            switch($_GET['action']){
                case 'readAll':
                    if($result['dataset'] = $categoria->readAll()){
                        $result['status'] = 1;
                        $result['message'] = 'Existe al menos un registro';
                    } else{
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Reseña inexistente';
                        }
                    }
                    break;
                case 'readOne':
                    $_POST = $categoria -> validateForm($_POST);
                    if($categoria->setIdCategoria($_POST['idCategoria'])){
                        if($result['dataset'] = $categoria->readOne()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Reseña inexistente';
                            }
                        }
                    } else{
                        $result['exception'] = 'Reseña seleccionado incorrecto';
                    }
                    break;
                case 'create':
                    $_POST = $categoria -> validateForm($_POST);
                    if ($categoria->setCategoria($_POST['txtCategoria1'])) {
                        if (is_uploaded_file($_FILES['archivo_usuario1']['tmp_name'])) {
                            if ($categoria->setImagen($_FILES['archivo_usuario1'])) {
                                if ($categoria->createRow()) {
                                    $result['status'] = 1;
                                    if ($categoria->saveFile($_FILES['archivo_usuario1'], $categoria->getRuta(), $categoria->getImagen())) {
                                        $result['message'] = 'Categoria registrada correctamente';
                                    } else {
                                        $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                    }
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            }else{
                                $result['exception'] = $categoria->getImageError();
                            }
                        }else{
                            $result['exception'] = 'Suba una imagen';
                        }
                    }else{
                        $result['exception'] = 'Categoria incorrecta';
                    }
                    break;
                case 'update':
                    $_POST = $categoria -> validateForm($_POST);
                    if ($categoria->setIdCategoria($_POST['idCategoria'])) {
                        if($data = $categoria->readOne()){
                            if ($categoria->setCategoria($_POST['txtCategoria2'])) {
                                if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                    if ($categoria->setImagen($_FILES['archivo_usuario'])) {
                                        if ($categoria->updateRow($data['imagen'])) {
                                            $result['status'] = 1;
                                            if ($categoria->saveFile($_FILES['archivo_usuario'], $categoria->getRuta(), $categoria->getImagen())) {
                                                $result['message'] = 'Categoria  actualizada correctamente';
                                            } else {
                                                $result['message'] = 'Categoria actualizada pero no se guardó la imagen';
                                            }
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = $categoria->getImageError();
                                    }
                                } else {
                                    if ($categoria->updateRow($data['imagen'])) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Categoria actualizada correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } 
                            }else{
                                $result['exception'] = 'Categoria incorrecta';
                            }
                        }else{
                            $result['exception'] = 'readOne incorrecto';
                        }
                    }else{
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'delete':
                    $_POST = $categoria -> validateForm($_POST);
                    if ($categoria->setIdCategoria($_POST['idCategoria'])) {
                        if ($data = $categoria->readOne()) {
                            if ($categoria->deleteRow()) {
                                if ($categoria->deleteFile($categoria->getRuta(), $data['imagen'])) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Categoria eliminada correctamente';
                                } else {
                                    $result['message'] = 'Categoria eliminada pero no se borró la imagen';
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Categoria inexistente';
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'search':
                    $_POST = $categoria->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $categoria->searchRows($_POST['search'])) {
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