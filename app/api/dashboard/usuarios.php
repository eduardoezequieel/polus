<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../libraries/phpmailer65/src/Exception.php';
require '../../../libraries/phpmailer65/src/PHPMailer.php';
require '../../../libraries/phpmailer65/src/SMTP.php';

//Creando instancia para mandar correo
$mail = new PHPMailer(true);
//To load the Spanish version
$mail->setLanguage('es', '../../../libraries/phpmailer65/language');


//Verificando si existe un acción
if(isset($_GET['action'])){
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases 
    $usuarios = new Usuarios;
    //Array para respuesta de la API
    $result= array('status'=>0, 'error'=>0, 'message'=>null,'exception'=> null, 'auth'=> null);
    //Verificando si hay una sesión iniciada
    if(isset($_SESSION['idAdmon'])){
        // Se compara la acción a realizar cuando el administrador no ha iniciado sesión.
        switch ($_GET['action']) {
            //Caso para cerrar sesión
            case 'logOut':
                unset($_SESSION['idAdmon']);
                $result['status'] = 1;
                $result['message'] = 'Sesión cerrada correctamente';
                break;
            //Caso para leer la info del perfil
            case 'readProfile':
                if ($result['dataset'] = $usuarios->readProfile()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                }
                break;
            //Caso para activar o deshabilitar la autenticacion en dos pasos
            case 'updateAuth':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setDobleAutenticacion($_POST['switchValue'])) {
                    if ($usuarios->setId($_SESSION['idAdmon'])) {
                        if ($usuarios->checkPassword($_POST['txtPasswordAuth'])) {
                            if ($usuarios->updateAuth()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'La contraseña es invalida.';
                        }
                    } else {
                        $result['exception'] = 'Id no asignado.';
                    }

                } else {
                    $result['exception'] = 'Usted esta intentando ingresar un valor no valido.';
                }
                break;
            //Caso para crear historial de sesion de un usuario
            case 'createSesionHistory':
                if ($usuarios->validateSesionHistory()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión ya registrada en la base de datos.';
                } else {
                    if ($usuarios->createSesionHistory()) {
                        $result['status'] = 1;
                        $result['message'] = 'Sesión registrada correctamente.';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                }
                break;
            //Caso para obtener el historial de sesiones de un usuario
            case 'getSesionHistory':
                if ($result['dataset'] = $usuarios->getSesionHistory()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Este usuario no posee sesiones.';
                    }
                }
                break;
            //Caso para eliminar un historial de sesion
            case 'deleteSesionHistory':
                if ($usuarios->setIdHistorialSesion($_POST['idHistorialSesion'])) {
                    if ($usuarios->deleteSesionHistory()) {
                        $result['status'] = 1;
                        $result['message'] = 'Dispositivo eliminado correctamente.';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Id invalido.';
                }
                break;
            case 'updateProfileInfo':
                $_POST = $usuarios->validateForm($_POST);
                if($usuarios->setId($_SESSION['idAdmon'])){
                    if($data = $usuarios->readOne()){
                        if($usuarios->setNombres($_POST['txtNombre'])){
                            if($usuarios -> setApellidos($_POST['txtApellidos'])){
                                if(isset($_POST['txtGenero'])){
                                    if($usuarios -> setGenero($_POST['txtGenero'])){
                                        if($usuarios -> setNacimiento($_POST['txtfechaNacimiento'])){
                                            if($usuarios -> setTelefono($_POST['txtTelefono'])){
                                                if($usuarios -> setDireccion($_POST['txtDireccion'])){
                                                    if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                        if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                                            if ($usuarios->updateProfileInfo($data['foto'])) {
                                                                $result['status'] = 1;
                                                                if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                    $result['message'] = 'Usuario registrado correctamente';
                                                                    $_SESSION['foto'] = $usuarios->getFoto();
                                                                } else {
                                                                    $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                                                }
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                        } else {
                                                            $result['exception'] = $usuarios->getImageError();
                                                        }
                                                    } else {
                                                        if ($usuarios->updateProfileInfo($data['foto'])) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Usuario modificado correctamente';
                                                            $_SESSION['foto'] = $usuarios->getFoto();
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } 
                                                }else{
                                                    $result['exception'] = 'Dirección incorrecta';
                                                }
                                            }else{
                                                $result['exception'] = 'Telefono incorrecto';
                                            }
                                        }else{
                                            $result['exception'] = 'Fecha de nacimiento faltante';
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
                    } else {
                        $result['exception'] = 'Usuario no existente';
                    }
                } else {
                    $result['exception'] = 'Usuario seleccionado incorrecto';
                }
                break;
            case 'updateProfileInfo':
                $_POST = $usuarios->validateForm($_POST);
                if($usuarios->setId($_SESSION['idAdmon'])){
                    if($data = $usuarios->readOne()){
                        if($usuarios->setNombres($_POST['txtNombre'])){
                            if($usuarios -> setApellidos($_POST['txtApellidos'])){
                                if(isset($_POST['txtGenero'])){
                                    if($usuarios -> setGenero($_POST['txtGenero'])){
                                        if($usuarios -> setNacimiento($_POST['txtfechaNacimiento'])){
                                            if($usuarios -> setTelefono($_POST['txtTelefono'])){
                                                if($usuarios -> setDireccion($_POST['txtDireccion'])){
                                                    if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                        if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                                            if ($usuarios->updateProfileInfo($data['foto'])) {
                                                                $result['status'] = 1;
                                                                if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                    $result['message'] = 'Usuario registrado correctamente';
                                                                    $_SESSION['foto'] = $usuarios->getFoto();
                                                                } else {
                                                                    $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                                                }
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                        } else {
                                                            $result['exception'] = $usuarios->getImageError();
                                                        }
                                                    } else {
                                                        if ($usuarios->updateProfileInfo($data['foto'])) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Usuario modificado correctamente';
                                                            $_SESSION['foto'] = $usuarios->getFoto();
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } 
                                                }else{
                                                    $result['exception'] = 'Dirección incorrecta';
                                                }
                                            }else{
                                                $result['exception'] = 'Telefono incorrecto';
                                            }
                                        }else{
                                            $result['exception'] = 'Fecha de nacimiento faltante';
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
                    } else {
                        $result['exception'] = 'Usuario no existente';
                    }
                } else {
                    $result['exception'] = 'Usuario seleccionado incorrecto';
                }
                break;
            case 'updateProfileAccount':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setUsuario($_POST['txtUsuario'])) {
                    if ($usuarios->setCorreo($_POST['txtEmail'])) {
                        if ($usuarios->updateProfileAccount()) {
                            $result['status'] = 1;
                            $_SESSION['usuario'] = $usuarios->getUsuario();
                            $result['message'] = 'Perfil modificado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Correo incorrecto';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrectos';
                }
                break;
                
            //Para actualizar la contraseña
            case 'updatePassword':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_SESSION['idAdmon'])) {
                    if($usuarios->checkPassword($_POST['txtActualContraseña'])){
                        if ($usuarios->setContrasenia($_POST['txtNuevaContraseña'])) {
                            if ($_POST['txtActualContraseña'] == $_POST['txtNuevaContraseña'] || 
                                $_POST['txtActualContraseña'] == $_POST['txtConfirmarContraseña']) {
                                $result['exception'] = 'Su nueva contraseña no puede ser la misma que la actual.';
                            } else {
                                if ($_POST['txtNuevaContraseña'] == $_POST['txtConfirmarContraseña']) {
                                    if ($usuarios->changePassword()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Contraseña actualizada exitosamente.';
                                        $usuarios->registerAction('Actualizar','Cambio de clave');
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Las contraseñas no coinciden.';
                                }
                            }
                        } else {
                            $result['exception'] = 'Su contraseña no cumple los requisitos especificados.';
                        }
                    } else {
                        $result['exception'] = 'La contraseña ingresada no es la actual.';
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                break;
            //Para actualizar el correo electronico
            case 'updateEmail':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setCorreo($_POST['txtNuevoCorreo'])) {
                    if ($_POST['txtNuevoCorreo'] == $_POST['txtConfirmarCorreo']) {
                        if ($usuarios->setId($_SESSION['idAdmon'])) {
                            if ($usuarios->checkPassword($_POST['txtContraseñaCorreo'])) {
                                if ($usuarios->changeEmail()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Correo actualizado exitosamente.';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Contraseña incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Id incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Los correos no coinciden.';
                    }
                } else {
                    $result['exception'] = 'Ingrese un correo eletrónico valido.';
                }
                break;
            //Para actualizar el correo electronico
            case 'updateUser':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setUsuario($_POST['txtNuevoUsuario'])) {
                    if ($_POST['txtNuevoUsuario'] == $_POST['txtConfirmarUsuario']) {
                        if ($usuarios->setId($_SESSION['idAdmon'])) {
                            if ($usuarios->checkPassword($_POST['txtContraseñaUsuario'])) {
                                if ($usuarios->changeUser()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Usuario actualizado exitosamente.';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Contraseña incorrecta.';
                            }
                        } else {
                            $result['exception'] = 'Id incorrecta.';
                        }
                    } else {
                        $result['exception'] = 'Los usuarios no coinciden.';
                    }
                } else {
                    $result['exception'] = 'Ingrese un usuario valido.';
                }
                break;
            //Caso para leer todos los datos
            case 'readAll':
                if ($result['dataset'] = $usuarios->readAll()) {
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
            //Caso para leer todos los tipos de usuario
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
            //Caso para buscar registros
            case 'search':
                $_POST = $usuarios->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuarios->searchRows($_POST['search'])) {
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
            //Caso para crear un registro
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
                                                                        $usuarios -> setContrasenia('polusUser2*');
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
                                                $result['exception'] = $usuarios->getImageError();
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
            //Caso para leer un registro
            case 'readOne':
                if ($usuarios->setId($_POST['idAdmon'])) {
                    if ($result['dataset'] = $usuarios->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            //Caso para suspender un registro
            case 'suspender':
                if($_POST['idAdmon'] != $_SESSION['idAdmon']){
                    if ($usuarios->setId($_POST['idAdmon'])) {
                        if ($usuarios->suspenderRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha suspendido al usuario correctamente';
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Usuario inexistente';
                            }
                        }
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                } else{
                    $result['exception'] = 'No se puede suspender tu propia cuenta';
                }
                break;
            //Caso para activar un registro
            case 'activar':
                if ($usuarios->setId($_POST['idAdmon'])) {
                    if ($usuarios->activarRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha activado al usuario correctamente';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;  
            //Caso para actualizar un registro       
            case 'update':
                $_POST = $usuarios->validateForm($_POST);
                if($usuarios->setId($_POST['idAdmon'])){
                    if($data = $usuarios->readOne()){
                        if($usuarios->setNombres($_POST['txtNombre'])){
                            if($usuarios -> setApellidos($_POST['txtApellidos'])){
                                if(isset($_POST['txtGenero'])){
                                    if($usuarios -> setGenero($_POST['txtGenero'])){
                                        if($usuarios -> setCorreo($_POST['txtEmail'])){
                                            if($usuarios -> setNacimiento($_POST['txtFechaNacimiento'])){
                                                if($usuarios -> setTelefono($_POST['txtTelefono'])){
                                                    if($usuarios -> setDireccion($_POST['txtDireccion'])){
                                                        if($usuarios -> setUsuario($_POST['txtUsuario'])){
                                                            if(isset($_POST['cbTipoUsuario'])){
                                                                if($usuarios -> setIdTipoUsuario($_POST['cbTipoUsuario'])){
                                                                    if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                                        if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                                                            if ($usuarios->updateRow($data['foto'])) {
                                                                                $result['status'] = 1;
                                                                                if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                                    $result['message'] = 'Usuario registrado correctamente';
                                                                                } else {
                                                                                    $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = Database::getException();
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = $usuarios->getImageError();
                                                                        }
                                                                    } else {
                                                                        if ($usuarios->updateRow($data['foto'])) {
                                                                            $result['status'] = 1;
                                                                            $result['message'] = 'Usuario modificado correctamente';
                                                                        } else {
                                                                            $result['exception'] = Database::getException();
                                                                        }
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
                                                        $result['exception'] = 'Dirección incorrecta';
                                                    }
                                                }else{
                                                    $result['exception'] = 'Telefono incorrecto';
                                                }
                                            }else{
                                                $result['exception'] = 'Fecha de nacimiento faltante';
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
                    } else {
                        $result['exception'] = 'Usuario no existente';
                    }
                } else {
                    $result['exception'] = 'Usuario seleccionado incorrecto';
                }
                break;
            //Caso para eliminar un registro
            case 'delete':
                if ($_POST['idAdmon'] != $_SESSION['idAdmon']) {
                    if ($usuarios->setId($_POST['idAdmon'])) {
                        if ($data = $usuarios->readOne()) {
                            if ($usuarios->deleteRow()) {
                                if ($usuarios->deleteFile($usuarios->getRuta(), $data['foto'])) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Usuario eliminado correctamente';
                                } else {
                                    $result['message'] = 'Usuario eliminado pero no se borró la imagen';
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;          
            //Default
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else{
         // Se compara la acción a realizar cuando el administrador no ha iniciado sesión.
         switch ($_GET['action']) {
             //Cado para leer todos los datos
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
            //Caso para obtener los registros de usuarios que han pasado 24 horas de block
            case 'checkBlockUsers':
                if ($result['dataset'] = $usuarios->checkBlockUsers()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Hubo un error al actualizar block.';
                    }
                }
                break;
            //Caso para registrar al primer usuario
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
                                                                                    $usuarios->registerAction('Agregar','Cambio de clave');
                                                                                } else {
                                                                                    $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                                                                    $usuarios->registerAction('Agregar','Cambio de clave');
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
                                                    $result['exception'] = $usuarios->getImageError();
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
            //Caso para entrar al sistema
            case 'logIn':
                $_POST = $usuarios -> validateForm($_POST);
                if($usuarios->checkUser($_POST['txtUsuario'])){
                    if($usuarios->checkEstado()) {
                        if($usuarios->checkPassword($_POST['txtContrasenia'])){
                            $_SESSION['idAdmon'] = $usuarios->getId();
                            $_SESSION['usuario'] = $usuarios->getUsuario();
                            $_SESSION['fotoUsuario'] = $usuarios->getFoto();
                            $_SESSION['correoUsuario'] = $usuarios->getCorreo();
                            //Se verifica la ultima vez que se actualizó la contraseña
                            if($usuarios->checkLastPasswordUpdate()) {
                                //Se reinicia a 0 los intentos
                                if ($usuarios->updateIntentos(0)) {
                                    $result['error'] = 1;
                                    $result['message'] = 'Hemos detectado que ya es tiempo de actualizar tu contraseña por seguridad.';  
                                }
                            } else {   
                                //Se reinicia a 0 los intentos
                                if ($usuarios->updateIntentos(0)) {
                                    //Se verifica la preferencia de autenticacion del usuario
                                    if ($autenticacion = $usuarios->checkAuthMode()) {
                                        if ($autenticacion['dobleautenticacion'] == 'si') {
                                            $result['auth'] = 'si';
                                            $result['status'] = 1;
                                            $result['dataset'] = $usuarios->getId();
                                            $_SESSION['idAdmon_temp'] = $usuarios->getId();
                                            unset($_SESSION['idAdmon']);
                                        } else {
                                            $result['auth'] = 'no';
                                            $result['status'] = 1;
                                            $result['message'] = 'Sesion iniciada correctamente.';
                                        }
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } else {
                                            $result['exception'] = 'Por alguna razón usted no posee ninguna preferencia de autenticación.';
                                        }   
                                    }
                                }
                            }
                        } else {
                            //En caso la contraseña es incorrecta se verifica la cantidad de intentos
                            if ($data = $usuarios->checkIntentos()){
                                if ($data['intentos'] < 3) {
                                    if ($usuarios->updateIntentos($data['intentos'] + 1)) {
                                        $result['exception'] = 'La contraseña es incorrecta.';
                                    }
                                } else {
                                    if($usuarios->suspenderRow()) {
                                        $result['exception'] = 'Has superado el máximo de intentos. Se ha bloqueado el usuario por 24 horas.';
                                        $usuarios->registerActionOut('Bloqueo','Bloqueo por clave incorrecta');
                                    }
                                }
                            }
                        }
                    } else {
                        $result['exception'] = 'El usuario ingresado está bloqueado.';
                    }
                } else{
                    $result['exception'] = 'El usuario ingreseado no existe en la base de datos.';
                }
                break;
            //Caso para validar un correo electronico
            case 'validateEmail':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_POST['idAdmonCorreo'])) {
                    if ($correo = $usuarios->checkEmail()) {
                        if ($correo['correo'] == $_POST['txtCorreo']) {
                            $result['status'] = 1;
                            $result['message'] = 'Correo verificado.';
                        } else {
                            $result['exception'] = 'El correo electrónico ingresado no coincide con su cuenta.';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay correo';
                        }
                    }
                } else {
                    $result['exception'] = 'Id pendiente de ingresar.';
                }
                break;
            //Caso para enviar un correo con el codigo de verificación requerido.
            case 'sendVerificationCode':
                $_SESSION['codigoVerificacion'] = random_int(100, 999999);
                try {
                        
                    //Ajustes del servidor
                    $mail->SMTPDebug = 0;                   
                    $mail->isSMTP();                                            
                    $mail->Host       = 'smtp.gmail.com';                     
                    $mail->SMTPAuth   = true;                                   
                    $mail->Username   = 'polusmarket2021@gmail.com';                     
                    $mail->Password   = 'polus123';                               
                    $mail->SMTPSecure = 'tls';            
                    $mail->Port       = 587;                                    
                
                    //Receptores
                    $mail->setFrom('polusmarket2021@gmail.com', 'Polus Support');
                    $mail->addAddress($_SESSION['correoUsuario']);    
                
                    //Contenido
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Codigo de Verificación';
                    $mail->Body    = 'Tu código de verificación es: <b>' . $_SESSION['codigoVerificacion'] . '</b>.';
                    $mail->AltBody = 'Tu código de verificación es: ' . $_SESSION['codigoVerificacion'] . '.';
                
                    if($mail->send()){
                        $result['status'] = 1;
                    }
                } catch (Exception $e) {
                    $result['exception'] = $mail->ErrorInfo;
                }
                break;
            //Caso para verificar el codigo
            case 'validateCode':
                $_POST = $usuarios->validateForm($_POST);
                if ($_SESSION['codigoVerificacion'] == $_POST['txtCodigo']) {
                    $_SESSION['idAdmon'] = $_SESSION['idAdmon_temp'];
                    unset($_SESSION['codigoVerificacion']);
                    unset($_SESSION['idAdmon_temp']);
                    $result['status'] = 1;
                    $result['message'] = 'Sesión iniciada correctamente.';
                } else {
                    $result['exception'] = 'El código que usted ha ingresado es invalido.';
                }
                
                break;
            //Caso para activar un registro bloqueado por 24 horas
            case 'activar':
                if ($usuarios->setId($_POST['idAdmon'])) {
                    if ($usuarios->activarRow()) {
                        if($usuarios->updateIntentos(0)) {
                            if($usuarios->updateBitacora()){
                                $result['status'] = 1;
                                $result['message'] = 'Se ha activado al usuario correctamente';
                            }
                        } 
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break; 
            //Caso para verificar existencia de un correo
            case 'checkEmail':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->checkEmail2($_POST['correo'])) {
                    if ($usuarios->checkEstado()) {
                        $result['status'] = 1;
                        $_SESSION['codigousuario'] = $usuarios->getId();
                    } else {
                        $result['exception'] = 'La cuenta ha sido desactivada.';
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'El correo ingresado no existe en la base de datos.';
                    }
                } 
                break;
            //Caso para enviar correo con el codigo de seguridad
            case 'sendEmail':
                $_POST = $usuarios->validateForm($_POST);
                if($usuarios->setCorreo($_POST['correo'])) {
                    $usuarios->setToken(random_int(1000,9999));
                    if($usuarios->updateToken()){
                        try {
                    
                            //Ajustes del servidor
                            $mail->SMTPDebug = 0;                   
                            $mail->isSMTP();                                            
                            $mail->Host       = 'smtp.gmail.com';                     
                            $mail->SMTPAuth   = true;                                   
                            $mail->Username   = 'polusmarket2021@gmail.com';                     
                            $mail->Password   = 'polus123';                               
                            $mail->SMTPSecure = 'tls';            
                            $mail->Port       = 587;                                    
                        
                            //Receptores
                            $mail->setFrom('polusmarket2021@gmail.com', 'Polus Support');
                            $mail->addAddress($usuarios->getCorreo());    
                        
                            //Contenido
                            $mail->isHTML(true);                                  
                            $mail->Subject = 'Recupera tu clave';
                            $mail->Body    = 'Hemos recibido una petición para recuperar tu contraseña. 
                                                El código de seguridad <b>'.$usuarios->getToken().'</b>';

                            if($mail->send()){
                                $result['status'] = 1;
                                $_SESSION['correoUsuario'] = $usuarios->getCorreo();   
                            }
                        } catch (Exception $e) {
                            $result['exception'] = $mail->ErrorInfo;
                        }
                    }
                    
                } else {
                    $result['exception'] = 'El correo no es válido';
                }
                break;
            //Caso para verificar el token
            case 'checkToken':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->checkToken($_POST['tokeningresado'])){
                    $result['status'] = 1;
                    $result['message'] = 'Código verificado correctamente.';
                } else {
                    $result['exception'] = 'El código no coincide.';
                }
                break;
            //Reestablecer contraseña
            case 'updatePasswordOut':
                if ($_POST['txtNuevaContraseña'] == $_POST['txtConfirmarContraseña']) {
                    if ($usuarios->setContrasenia($_POST['txtNuevaContraseña'])) {
                        if ($usuarios->changePasswordOut()) {
                            if($usuarios->updateClaveRequest()){
                                $result['status'] = 1;
                                $result['message'] = 'Contraseña actualizada correctamente.';
                                $usuarios->registerActionOut2('Actualizar','Cambio de clave');
                                unset($_SESSION['correoUsuario']);
                                unset($_SESSION['codigousuario']);          
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Contraseña invalida.';
                    }
                } else {
                    $result['exception'] = 'Las contraseñas no coinciden.';
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