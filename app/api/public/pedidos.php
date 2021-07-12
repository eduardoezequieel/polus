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

                //Caso para verificar si el cliente ya tiene un pedido registrado
                case 'checkClientPedido':
                    if ($result['dataset'] = $pedidos->checkClientePedido()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['exception'] = Database::getException();
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