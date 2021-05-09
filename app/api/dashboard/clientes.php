<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/clientes.php');

    //Verificando si existe una acción
    if(isset($_GET['action'])){
        //Reanudando sesion
        session_start();
        //Creando un objeto de la clase
        $clientes = new Clientes();
        //Array para guardar respuesta de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);
        
        //Verificando si hay alguna sesión abierta
        if(isset($_SESSION['idAdmon'])){
            //Verificando acción
            switch($_GET['action']){
                case 'readAll':
                    if($result['dataset'] = $clientes->readAll()){
                        $result['status'] = 1;
                        $result['message'] = 'Se encontraron más de un registro';
                    } else {
                        //Verificando si hubo problemas en la base
                        if(Database::getException()){
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        } else {    
                            $result['exception'] = 'No existen clientes en la base';
                        }
                    }
                    break;
                case 'search':
                    break;
                case 'update':
                    break;
                case 'delete':
                    break;
                default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
            }
            // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
            header('content-type: application/json; charset=utf-8');
            // Se imprime el resultado en formato JSON y se retorna al controlador.
            print(json_encode($result));
        }else{
            print(json_encode('Acceso denegado, por favor iniciar sesión'));
        }
    } else{
        print(json_encode('El recurso no está disponible'));
    }
?>