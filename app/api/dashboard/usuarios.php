<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');

//Verificando si existe un acción
if(isset($_GET['action'])){
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases 
    $usuarios = new Usuarios;
    //Array para respuesta de la API
    $result= array('status'=>0, 'error'=>0, 'message'=>null,'exception'=> null);
    //Verificando si hay una sesión iniciada
    if(isset($_SESSION['idAdmon'])){
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
            case 'readTipoUsuario':
                if ($result['dataset'] = $usuarios->readAllTipos()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay categorías registradas';
                    }
                }
                break;
            case 'create':
                $_POST = $usuarios->validateForm($_POST);
                    if($usuarios->setNombres($_POST['txtNombre'])){
                        if($usuarios -> setApellidos($_POST['txtApellidos'])){
                            if(isset($_POST['txtGenero'])){
                                if($usuarios -> setGenero($_POST['txtGenero'])){
                                    if($usuarios -> setCorreo($_POST['txtEmail'])){
                                        if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                            if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                                if($usuarios -> setNacimiento($_POST['txtFechaNacimiento'])){
                                                    if($usuarios -> setTelefono($_POST['txtTelefono'])){
                                                        if($usuarios -> setDireccion($_POST['txtDireccion'])){
                                                            if($usuarios -> setUsuario($_POST['txtUsuario'])){
                                                                if(isset($_POST['cbTipoUsuario'])){
                                                                    if($usuarios -> setIdTipoUsuario($_POST['cbTipoUsuario'])){
                                                                        $usuarios->setIdEstadoUsuario(1);
                                                                        $usuarios -> setContrasenia('polus-User');
                                                                        if ($usuarios->createRow()) {
                                                                            $result['status'] = 1;
                                                                            if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                                $result['message'] = 'Usuario registrado correctamente';
                                                                            } else {
                                                                                $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = Database::getException();
                                                                        }
                                                                    } else{
                                                                        $result['exception'] = 'Error al seleccionar el tipo de usuario';
                                                                    }
                                                                }else{
                                                                    $result['exception'] = 'Seleccione un tipo de usuario';
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
                                            } else {
                                                $result['exception'] = $result->getImageError();
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una imagen';
                                        } 
                                    }else{
                                        $result['exception'] = 'Correo incorrecto';
                                    }
                                }else{
                                    $result['exception'] = 'Seleccione un genero';
                                }
                            } else {
                                $result['exception'] = 'Seleccione una opción';
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
                    if($usuarios->setNombres($_POST['txtNombre'])){
                        if($usuarios -> setApellidos($_POST['txtApellidos'])){
                            if(isset($_POST['txtGenero'])){
                                if($usuarios -> setGenero($_POST['txtGenero'])){
                                    if($usuarios -> setCorreo($_POST['txtEmail'])){
                                        if($_POST['txtEmail'] == $_POST['txtConfirmarEmail']){
                                            if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                                    if($usuarios -> setNacimiento($_POST['txtFechaNacimiento'])){
                                                        if($usuarios -> setTelefono($_POST['txtTelefono'])){
                                                            if($usuarios -> setDireccion($_POST['txtDireccion'])){
                                                                if($usuarios -> setUsuario($_POST['txtUsuario'])){
                                                                    if($usuarios -> setContrasenia($_POST['txtContraseña'])){
                                                                        if($_POST['txtContraseña'] == $_POST['txtConfirmarContraseña']){
                                                                            $usuarios -> setIdEstadoUsuario(1);
                                                                            $usuarios -> setIdTipoUsuario(1);
                                                                            if ($usuarios->createRow()) {
                                                                                $result['status'] = 1;
                                                                                if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                                    $result['message'] = 'Usuario registrado correctamente';
                                                                                } else {
                                                                                    $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = Database::getException();;
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
                                                } else {
                                                    $result['exception'] = $result->getImageError();
                                                }
                                            } else {
                                                $result['exception'] = 'Seleccione una imagen';
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
                            } else {
                                $result['exception'] = 'Seleccione una opción';
                            }
                        }else{
                            $result['exception'] = 'Apellidos incorrectos';
                        }
                    }else{
                        $result['exception'] = 'Nombres incorrectos';
                    }
                break;
            case 'logIn':
                $_POST = $usuarios -> validateForm($_POST);
                if($usuarios->checkUser($_POST['txtUsuario'])){
                    if($usuarios->checkPassword($_POST['txtContrasenia'])){
                        $result['status'] = 1;
                        $result['message'] = 'Sesión iniciada correctamente';
                        $_SESSION['idAdmon'] = $usuarios->getId();
                        $_SESSION['usuario'] = $usuarios->getUsuario();
                    } else {
                        $result['exception'] = 'La contraseña es incorrecta';
                    }
                } else{
                    $result['exception'] = 'El usuario es incorrecto';
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