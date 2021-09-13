<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/clientes.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require '../../../libraries/phpmailer65/src/Exception.php';
    require '../../../libraries/phpmailer65/src/PHPMailer.php';
    require '../../../libraries/phpmailer65/src/SMTP.php';

    //Creando instancia para mandar correo
    $mail = new PHPMailer(true);

    //Verificando si existe una acción
    if(isset($_GET['action'])){
        //Reanudando sesion
        session_start();
        
        //Creando un objeto de la clase
        $clientes = new Clientes();
        //Array para guardar respuesta de la API
        $result = array('status'=>0, 'recaptcha' => 0, 'error'=>0, 'message'=>null, 'exception'=>null, 'auth'=>null);
        
        //Verificando si hay alguna sesión abierta
        if(isset($_SESSION['idCliente'])){
            //Verificando acción
            switch($_GET['action']){

                //Caso para cerrar la sesón
                case 'logOut':
                    unset($_SESSION['idCliente']);
                    $result['status'] = 1;
                    $result['message'] = 'Sesión cerrada correctamente';
                    break;
                //Caso para crear historial de sesion de un usuario
                case 'createSesionHistory':
                    if ($clientes->validateSesionHistory()) {
                        $result['status'] = 1;
                        $result['message'] = 'Sesión ya registrada en la base de datos.';
                    } else {
                        if ($clientes->createSesionHistory()) {
                            $result['status'] = 1;
                            $result['message'] = 'Sesión registrada correctamente.';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    }
                    break;
                //Caso para obtener el historial de sesiones de un usuario
                case 'getSesionHistory':
                    if ($result['dataset'] = $clientes->getSesionHistory()) {
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
                    if ($clientes->setIdHistorialSesion($_POST['idHistorialSesion'])) {
                        if ($clientes->deleteSesionHistory()) {
                            $result['status'] = 1;
                            $result['message'] = 'Dispositivo eliminado correctamente.';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Id invalido.';
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
                //Caso para activar o deshabilitar la autenticacion en dos pasos
                case 'updateAuth':
                    $_POST = $clientes->validateForm($_POST);
                    if ($clientes->setDobleAutenticacion($_POST['switchValue'])) {
                        if ($clientes->setId($_SESSION['idCliente'])) {
                            if ($clientes->checkPassword($_POST['txtPasswordAuth'])) {
                                if ($clientes->updateAuth()) {
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
                    //Caso para actualizar la clave
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
                        if ($clientes->checkEstado()) {
                            if ($clientes->checkPassword($_POST['contrasenia'])) {
                                $_SESSION['idCliente'] = $clientes->getId();
                                $_SESSION['correoCliente'] = $clientes->getCorreo();
                                $_SESSION['fotoCliente'] =$clientes->getFoto();
                                $_SESSION['usuarioCliente'] = $clientes->getUsuario();
                                if($clientes->checkLastPasswordUpdate()) {
                                    //Se reinicia a 0 los intentos
                                    if ($clientes->updateIntentos(0)) {
                                        //Se verifica la preferencia de autenticacion del usuario
                                        if ($autenticacion = $clientes->checkAuthMode()) {
                                            if ($autenticacion['dobleautenticacion'] == 'si') {
                                                $result['auth'] = 'si';
                                                $result['status'] = 1;
                                                $result['dataset'] = $clientes->getId();
                                                $_SESSION['idCliente_temp'] = $clientes->getId();
                                                unset($_SESSION['idCliente']);
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
                                } else {
                                    //Se reinicia a 0 los intentos
                                    if ($clientes->updateIntentos(0)) {
                                        $result['error'] = 1;
                                        $result['message'] = 'Hemos detectado que ya es tiempo de actualizar tu contraseña por seguridad.';  
                                    }
                                }
                            } else {
                                //En caso la contraseña es incorrecta se verifica la cantidad de intentos
                                if ($data = $clientes->checkIntentos()){
                                    if ($data['intentos'] < 3) {
                                        if ($clientes->updateIntentos($data['intentos'] + 1)) {
                                            $result['exception'] = 'La contraseña es incorrecta.';
                                        }
                                    } else {
                                        if($clientes->suspenderRow()) {
                                            $result['exception'] = 'Has superado el máximo de intentos. Se ha bloqueado el usuario por 24 horas.';
                                            $clientes->registerActionOut('Bloqueo','Bloqueo por clave incorrecta');
                                        }
                                    }
                                }
                            }
                        } else {
                            $result['exception'] = 'La cuenta ha sido desactivada.';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
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
                        $mail->addAddress($_SESSION['correoCliente']);    
                    
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
                    $_POST = $clientes->validateForm($_POST);
                    if ($_SESSION['codigoVerificacion'] == $_POST['txtCodigo']) {
                        $_SESSION['idCliente'] = $_SESSION['idCliente_temp'];
                        unset($_SESSION['codigoVerificacion']);
                        unset($_SESSION['idCliente_temp']);
                        $result['status'] = 1;
                        $result['message'] = 'Sesión iniciada correctamente.';
                    } else {
                        $result['exception'] = 'El código que usted ha ingresado es invalido.';
                    }
                    
                    break;
                //Caso para obtener los registros de usuarios que han pasado 24 horas de block
                case 'checkBlockUsers':
                    if ($result['dataset'] = $clientes->checkBlockUsers()) {
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
                //Caso para activar un registro bloqueado por 24 horas
                case 'activar':
                    if ($clientes->setId($_POST['idCliente'])) {
                        if ($clientes->activarRow()) {
                            if($clientes->updateIntentos(0)) {
                                if($clientes->updateBitacora()){
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
                    $_POST = $clientes->validateForm($_POST);
                    if ($clientes->checkUser($_POST['correo'])) {
                        if ($clientes->checkEstado()) {
                            $result['status'] = 1;
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
                    $_POST = $clientes->validateForm($_POST);
                    if($clientes->setCorreo($_POST['correo'])) {
                        $clientes->setToken(random_int(1000,9999));
                        if($clientes->updateToken()){
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
                                $mail->addAddress($clientes->getCorreo());    
                            
                                //Contenido
                                $mail->isHTML(true);                                  
                                $mail->Subject = 'Recupera tu clave';
                                $mail->Body    = 'Hemos recibido una petición para recuperar tu contraseña. 
                                                    El código de seguridad <b>'.$clientes->getToken().'</b>';
    
                                if($mail->send()){
                                    $result['status'] = 1;
                                    $_SESSION['correoCliente'] = $clientes->getCorreo();
                                    $_SESSION['codigocliente'] = $clientes->getId();
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
                    $_POST = $clientes->validateForm($_POST);
                    if ($clientes->checkToken($_POST['tokeningresado'])){
                        $result['status'] = 1;
                        $result['message'] = 'Código verificado correctamente.';
                    } else {
                        $result['exception'] = 'El código no coincide.';
                    }
                    break;
                //Reestablecer contraseña
                case 'updatePasswordOut':
                    if ($_POST['txtNuevaContraseña'] == $_POST['txtConfirmarContraseña']) {
                        if ($clientes->setContrasenia($_POST['txtNuevaContraseña'])) {
                            if ($clientes->changePasswordOut()) {
                                if($clientes->updateClaveRequest()){
                                    $result['status'] = 1;
                                    $result['message'] = 'Contraseña actualizada correctamente.';
                                    $clientes->registerActionOut2('Actualizar','Cambio de clave');
                                    unset($_SESSION['correoCliente']);
                                    unset($_SESSION['codigocliente']);          
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
    } else{
        print(json_encode('El recurso no está disponible'));
    }
