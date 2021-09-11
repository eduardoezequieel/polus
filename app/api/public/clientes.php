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
                //Caso para cargar la informacion personal del usuario
                case 'readProfile':
                    if ($result['dataset'] = $clientes->readProfile()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay informacion con este id.';
                        }
                    }
                    break;
                //Caso para actualizar la informacion personal del usuario
                case 'editProfile':
                    $_POST = $clientes->validateForm($_POST);
                    if ($data = $clientes->readProfile()) {
                        if ($clientes->setNombres($_POST['txtNombre'])) {
                            if ($clientes->setTelefono($_POST['txtTelefono'])) {
                                if ($clientes->setNacimiento($_POST['txtFechaNacimiento'])) {
                                    if (isset($_POST['txtGenero'])) {
                                        if ($clientes->setGenero($_POST['txtGenero'])) {
                                            if ($clientes->setApellidos($_POST['txtApellido'])) {
                                                if ($clientes->setDireccion($_POST['txtDireccion'])) {
                                                    if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                        if ($clientes->setFoto($_FILES['archivo_usuario'])) {
                                                            if ($clientes->editProfile($data['foto'])) {
                                                                $result['status'] = 1;
                                                                if ($clientes->saveFile($_FILES['archivo_usuario'], $clientes->getRuta(), $clientes->getFoto())) {
                                                                    $result['message'] = 'Perfil modificado correctamente';
                                                                    $_SESSION['foto'] = $clientes->getFoto();
                                                                } else {
                                                                    $result['message'] = 'Perfil modificado pero no se guardo la imagen.';
                                                                }
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                        } else {
                                                            $result['exception'] = $clientes->getImageError();
                                                        }
                                                    } else {
                                                        if ($clientes->editProfile($data['foto'])) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Perfil modificado correctamente.';
                                                            $_SESSION['foto'] = $clientes->getFoto();
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    }
                                                } else {
                                                    $result['exception'] = 'Dirección invalida.';
                                                }
                                            } else {
                                                $result['exception'] = 'Apellidos invalido.';
                                            }
                                        } else {
                                            $result['exception'] = 'Genero invalido.';
                                        }
                                    } else {
                                        $result['exception'] = 'Por favor, seleccione un género.';
                                    }
                                } else {
                                    $result['exception'] = 'Por favor ingrese una fecha de nacimiento.';
                                }
                            } else {
                                $result['exception'] = 'Teléfono invalido.';
                            }
                        } else {
                            $result['exception'] = 'Nombre invalido.';
                        }
                    } else {
                        $result['exception'] = 'NO hay informacion.';
                    }
                    break;
                    //Caso para editar usuario
                    case 'updateUser':
                        $_POST = $clientes->validateForm($_POST);
                        if ($clientes->setUsuario($_POST['txtNuevoUsuario'])) {
                            if ($_POST['txtNuevoUsuario'] == $_POST['txtConfirmarUsuario']) {
                                if ($clientes->setId($_SESSION['idCliente'])) {
                                    if ($clientes->checkPassword($_POST['txtContraseñaUsuario'])) {
                                        if ($clientes->updateUser()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Usuario actualizado correctamente.';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Contraseña incorrecta.';
                                    }
                                } else {
                                    $result['exception'] = 'Id incorrecto.';
                                }
                            } else {
                                $result['exception'] = 'Los usuarios no coinciden.';
                            }
                        } else {
                            $result['exception'] = 'Usuario invalido.';
                        }  
                        break;
                    //Caso para editar correo
                    case 'updateEmail':
                        $_POST = $clientes->validateForm($_POST);
                        if ($clientes->setCorreo($_POST['txtNuevoEmail'])) {
                            if ($_POST['txtNuevoEmail'] == $_POST['txtConfirmarCorreo']) {
                                if ($clientes->setId($_SESSION['idCliente'])) {
                                    if ($clientes->checkPassword($_POST['txtContraseñaCorreo'])) {
                                        if ($clientes->updateEmail()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Correo actualizado correctamente.';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Contraseña incorrecta.';
                                    }
                                } else {
                                    $result['exception'] = 'Id invalido.';
                                }
                            } else {
                                $result['exception'] = 'Los correos no coinciden.';
                            }
                        } else {
                            $result['exception'] = 'Correo invalido.';
                        }  
                        break;
                    case 'updatePassword':
                        if ($clientes->setId($_SESSION['idCliente'])) {
                            if ($clientes->checkPassword($_POST['txtContraseñaActual'])) {
                                if ($_POST['txtContraseñaActual'] == $_POST['txtNuevaContraseña'] || 
                                    $_POST['txtContraseñaActual'] == $_POST['txtConfirmarContraseña']) {
                                    $result['exception'] = 'La contraseña nueva no puede ser igual que la actual.';
                                } else {
                                    if ($_POST['txtNuevaContraseña'] == $_POST['txtConfirmarContraseña']) {
                                        if ($clientes->setContrasenia($_POST['txtNuevaContraseña'])) {
                                            if ($clientes->changePassword()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Contraseña actualizada correctamente.';
                                                $clientes->registerAction('Actualizar','Cambio de clave');
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'Contraseña invalida.';
                                        }
                                    } else {
                                        $result['exception'] = 'Las contraseñas no coinciden.';
                                    }
                                }
                            } else {
                                $result['exception'] = 'La contraseña actual es incorrecta.';
                            }
                        } else {
                            $result['exception'] = 'Id invalido';
                        }
                        
                        break;
                //Caso por default
                default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
            }
        }else{
            // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
            switch ($_GET['action']) {
                //Caso para registrar al cliente
                case 'register':
                    $_POST = $clientes->validateForm($_POST);
                    // Se sanea el valor del token para evitar datos maliciosos.
                    $token = filter_input(INPUT_POST, 'token_response', FILTER_SANITIZE_STRING);

                    if ($token) {
                        $secretKey = '6Ldf0VAcAAAAAEUfSW4qxAl2mw8Yun1wjNC650hB';
                        $ip = $_SERVER['REMOTE_ADDR'];

                        $data = array(
                            'secret' => $secretKey,
                            'response' => $token,
                            'remoteip' => $ip
                        );
    
                        $options = array(
                            'http' => array(
                                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                'method'  => 'POST',
                                'content' => http_build_query($data)
                            ),
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false
                            )
                        );

                        $url = 'https://www.google.com/recaptcha/api/siteverify';
                        $context  = stream_context_create($options);
                        $response = file_get_contents($url, false, $context);
                        $captcha = json_decode($response, true);

                        if ($captcha['success']) {
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
                                                                                        $clientes->registerAction('Registrar','Cambio de clave');
                                                                                    } else {
                                                                                        $result['message'] = 'Cliente registrado pero no se guardó la imagen';
                                                                                        $clientes->registerAction('Registrar','Cambio de clave');
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
                        } else {
                            $result['recaptcha'] = 1;
                            $result['exception'] = 'No eres un humano';
                        } 
                    } else {
                        $result['exception'] = 'Ocurrió un problema al cargar el reCAPTCHA';
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
                                if($clientes->checkLastPasswordUpdate()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Sesión iniciada correctamente';
                                } else {
                                    $result['error'] = 1;
                                    $result['message'] = 'Hemos detectado que ya es tiempo de actualizar tu contraseña por seguridad.';
                                    
                                }
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
