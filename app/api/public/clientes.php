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
        $result = array('status'=>0, 'recaptcha' => 0, 'error'=>0, 'message'=>null, 'exception'=>null);
        
        //Verificando si hay alguna sesión abierta
        if(isset($_SESSION['idCliente'])){
            //Verificando acción
            switch($_GET['action']){

                //Caso para cerrar la sesón
                case 'logOut':
                    if (session_destroy()) {
                        $result['status'] = 1;
                        $result['message'] = 'Sesión cerrada correctamente';
                    } else {
                        $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                    }
                    break;
                default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
            }
        
        }else{
            // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
            switch ($_GET['action']) {
                //Caso para registrar al cliente
                case 'register':
                    $_POST = $clientes->validateForm($_POST);
                        if($clientes->setNombres($_POST['txtNombre'])){
                            if($clientes -> setApellidos($_POST['txtApellidos'])){
                                if(isset($_POST['txtGenero'])){
                                    if($clientes -> setGenero($_POST['txtGenero'])){
                                        if($clientes -> setCorreo($_POST['txtEmail'])){
                                            if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                if ($clientes->setFoto($_FILES['archivo_usuario'])) {
                                                    if($clientes -> setNacimiento($_POST['txtFechaNacimiento'])){
                                                        if($clientes -> setTelefono($_POST['txtTelefono'])){
                                                            if($clientes -> setDireccion($_POST['txtDireccion'])){
                                                                if($clientes -> setUsuario($_POST['txtUsuario'])){
                                                                    $clientes->setIdEstadoUsuario(1);
                                                                    if($clientes -> setContrasenia($_POST['txtContraseña'])){
                                                                        if($_POST['txtContraseña'] == $_POST['txtConfirmarContraseña']){
                                                                            if ($clientes->createRow()) {
                                                                                $result['status'] = 1;
                                                                                if ($clientes->saveFile($_FILES['archivo_usuario'], $clientes->getRuta(), $clientes->getFoto())) {
                                                                                    $result['message'] = 'Cliente registrado correctamente';
                                                                                } else {
                                                                                    $result['message'] = 'Cliente registrado pero no se guardó la imagen';
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = Database::getException();
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
                                                    $result['exception'] = $clientes->getImageError();
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
                //Caso para iniciar sesión
                case 'logIn':
                    $_POST = $clientes->validateForm($_POST);
                    if ($clientes->checkUser($_POST['correo'])) {
                        if ($clientes->getIdEstadoUsuario()) {
                            if ($clientes->checkPassword($_POST['contrasenia'])) {
                                $_SESSION['idCliente'] = $clientes->getId();
                                $_SESSION['correoCliente'] = $clientes->getCorreo();
                                $_SESSION['foto'] =$clientes->getFoto();
                                $_SESSION['usuario'] = $clientes->getUsuario();
                                $result['status'] = 1;
                                $result['message'] = 'Autenticación correcta';
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'Clave incorrecta';
                                }
                            }
                        } else {
                            $result['exception'] = 'La cuenta ha sido desactivada';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Correo incorrecto';
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
    } else{
        print(json_encode('El recurso no está disponible'));
    }
?>