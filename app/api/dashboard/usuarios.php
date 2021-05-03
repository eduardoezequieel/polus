<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
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
            case 'register':
                $_POST = $usuarios->validateForm($_POST);
                    if($usuarios->setNombres($_POST['txtNombres'])){
                        if($usuarios -> setApellidos($_POST['txtApellidos'])){
                            if($usuarios -> setGenero($_POST['txtGenero'])){
                                if($usuarios -> setCorreo($_POST['txtEmail'])){
                                    if($_POST['txtEmail'] == $_POST['txtConfirmarEmail']){
                                        if($usuarios -> setFoto($_POST['txtFoto'])){
                                            if($usuarios -> setNacimiento($_POST['txtFechaNacimiento'])){
                                                if($usuarios -> setTelefono($_POST['txtTelefono'])){
                                                    if($usuarios -> setDireccion($_POST['txtDireccion'])){
                                                        if($usuarios -> setUsuario($_POST['txtUsuario'])){
                                                            if($usuarios -> setContrasenia($_POST['txtContraseña'])){
                                                                if($_POST['txtContraseña'] == $_POST['txtConfirmarContraseña']){
                                                                    if($usuarios -> setIdEstadoUsuario($_POST[1])){
                                                                        if($usuarios -> setIdTipoUsuario($_POST[1])){
                                                                            if ($usuario->createRow()) {
                                                                                $result['status'] = 1;
                                                                                $result['message'] = 'Usuario registrado correctamente';
                                                                            } else {
                                                                                $result['exception'] = Database::getException();
                                                                            }
                                                                        }else{
                                                                            $result['exception'] = 'error de tipo';
                                                                        }
                                                                    }else{
                                                                        $result['exception'] = 'error de estado';
                                                                    }
                                                                }else{
                                                                    $result['exception'] = 'Contraseñas no iguales';
                                                                }
                                                            }else{
                                                                $result['exception'] = 'Contraseña incorrecta';
                                                            }
                                                        }else{
                                                            $result['exception'] = 'Usuario incorrecto';
                                                        }
                                                    }else{
                                                        $result['exception'] = 'Direccion incorrecta';
                                                    }
                                                }else{
                                                    $result['exception'] = 'Telefono incorrecto';
                                                }
                                            }else{
                                                $result['exception'] = 'Fecha de nacimiento faltante';
                                            }
                                        }else{
                                            $result['exception'] = 'Foto faltante';
                                        }
                                    }else{
                                        $result['exception'] = 'Correos diferentes';
                                    }
                                }else{
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            }else{
                                $result['exception'] = 'Genero faltante';
                            }
                        }else{
                            $result['exception'] = 'Apellidos incorrectos';
                        }
                    }else{
                        $result['exception'] = 'Nombres incorrectos';
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