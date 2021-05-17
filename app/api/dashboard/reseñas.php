<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/reseñas.php');

    if (isset($_GET['action'])) {
        //Reanudando la sesion
        session_start();

        //Objeto para instanciar la clase
        $reseñas = new Resenas();

        //Arreglo para guardar respuestas de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

        //Acciones a ejecutar permitidas con la sesion iniciada
        if (isset($_SESSION['idAdmon'])) {
            switch($_GET['action']){
                case 'readAll':
                    if ($result['dataset'] = $reseñas -> readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de reseñas.';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de reseñas.';
                        }
                    }
                    break;
                case 'readOne':
                    $_POST = $reseñas -> validateForm($_POST);
                    if($reseñas->setIdResena($_POST['idReseña'])){
                        if($result['dataset'] = $reseñas->readOne()){
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
                case 'search':
                    $_POST = $reseñas->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $reseñas->searchRows($_POST['search'])) {
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
                case 'createOrUpdateAnswer':
                    $_POST = $reseñas->validateForm($_POST);
                    if ($reseñas -> setIdResena($_POST['idReseña'])) {
                        if ($reseñas -> setRespuesta($_POST['txtRespuesta'])) {
                            if ($reseñas -> createOrUpdateAnswer()) {
                                $result['status'] = 1;
                                $result['message'] = 'Respuesta actualizada.';
                            }else{
                                $result['exception'] = Database::getException();
                            }
                        }else{
                            $result['exception'] = 'Respuesta incorrecta.';
                        }
                    }else{
                        $result['exception'] = 'id incorrecto';
                    }
                    break;
                case 'deleteComment':
                    $_POST = $reseñas->validateForm($_POST);
                    if ($reseñas -> setIdResena($_POST['idReseña'])) {
                        if ($reseñas -> deleteComment()) {
                            $result['status'] = 1;
                            $result['message'] = 'Comentario eliminado exitosamente.';
                        }
                        else{
                            $result['exception'] = Database::getException();
                        }
                    }else{
                        $result['exception'] = 'id incorrecto';
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