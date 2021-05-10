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
                case 'readOne':
                    $_POST = $clientes->validateForm($_POST);
                    if($clientes->setId($_POST['idCliente'])){
                        if($result['dataset'] = $clientes->readOne()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Cliente inexistente';
                            }
                        }
                    } else{
                        $result['exception'] = 'Cliente seleccionado incorrecto';
                    }
                    break;
                case 'search':
                    break;
                case 'update':
                    $_POST = $clientes->validateForm($_POST);
                    if($clientes->setId($_POST['idCliente'])){
                        if($data = $clientes->readOne()){
                            if($clientes->setNombres($_POST['txtNombre'])){
                                if($clientes -> setApellidos($_POST['txtApellidos'])){
                                    if(isset($_POST['txtGenero'])){
                                        if($clientes -> setGenero($_POST['txtGenero'])){
                                            if($clientes -> setCorreo($_POST['txtEmail'])){
                                                if($clientes -> setNacimiento($_POST['txtFechaNacimiento'])){
                                                    if($clientes -> setTelefono($_POST['txtTelefono'])){
                                                        if($clientes -> setDireccion($_POST['txtDireccion'])){
                                                            if($clientes -> setUsuario($_POST['txtUsuario'])){
                                                                if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                                    if ($clientes->setFoto($_FILES['archivo_usuario'])) {
                                                                        if ($clientes->updateRow($data['foto'])) {
                                                                            $result['status'] = 1;
                                                                            if ($clientes->saveFile($_FILES['archivo_usuario'], $clientes->getRuta(), $clientes->getFoto())) {
                                                                                $result['message'] = 'Cliente registrado correctamente';
                                                                            } else {
                                                                                $result['message'] = 'Cliente registrado pero no se guardó la imagen';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = Database::getException();
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = $result->getImageError();
                                                                    }
                                                                } else {
                                                                    if ($clientes->updateRow($data['foto'])) {
                                                                        $result['status'] = 1;
                                                                        $result['message'] = 'Cliente modificado correctamente';
                                                                    } else {
                                                                        $result['exception'] = Database::getException();
                                                                    }
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
                            $result['exception'] = 'Cliente no existente';
                        }
                    } else {
                        $result['exception'] = 'Cliente seleccionado incorrecto';
                    }
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