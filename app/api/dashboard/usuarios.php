<?php
require_once('../../helpers/database.php');
require_once('../../models/usuarios.php');

//Verificando si existe un acción
if(isset($_GET['action'])){
    
    //Instanciando clases 
    $usuarios = new Usuarios;
    //Array para respuesta de la API
    $result= array('status'=>0, 'error'=>0, 'message'=>null,'exception'=> null);
    //Verificando si hay una sesión iniciada
    if(isset($_SESSION['id_usuario'])){
        
    } else{
         // Se compara la acción a realizar cuando el administrador no ha iniciado sesión.
         switch ($_GET['action']) {
            case 'readAll':
                if ($usuarios->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existe al menos un usuario registrado';
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen usuarios registrados';
                    }
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible fuera de la sesión';
        }
    }
// Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
header('content-type: application/json; charset=utf-8');
// Se imprime el resultado en formato JSON y se retorna al controlador.
print(json_encode($result));
} else {
print(json_encode('Recurso no disponible'));
}

?>