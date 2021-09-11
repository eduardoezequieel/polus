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
            case 'logOut':
                unset($_SESSION['idAdmon']);
                $result['status'] = 1;
                $result['message'] = 'Sesión cerrada correctamente';
                break;
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
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
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
            case 'logIn':
                $_POST = $usuarios -> validateForm($_POST);
                if($usuarios->checkUser($_POST['txtUsuario'])){
                    if($usuarios->checkPassword($_POST['txtContrasenia'])){
                        $_SESSION['idAdmon'] = $usuarios->getId();
                        $_SESSION['usuario'] = $usuarios->getUsuario();
                        $_SESSION['fotoUsuario'] = $usuarios->getFoto();
                        if($usuarios->checkLastPasswordUpdate()) {
                            $result['status'] = 1;
                            $result['message'] = 'Sesión iniciada correctamente';
                        } else {
                            $result['error'] = 1;
                            $result['message'] = 'Hemos detectado que ya es tiempo de actualizar tu contraseña por seguridad.';
                            
                        }
                    } else {
                        $result['exception'] = 'La contraseña es incorrecta';
                    }
                } else{
                    $result['exception'] = 'El usuario es incorrecto o está suspendido';
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