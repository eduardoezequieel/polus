<?php
    class public_Page{
        public static function navbarTemplate($titulo, $css){

            // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
            session_start();

            print('
                <!doctype html>
                <html lang="es">

                <head>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="Expires" content="0">
                <meta http-equiv="Last-Modified" content="0">
                <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
                <meta http-equiv="Pragma" content="no-cache">

                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


                <link rel="stylesheet" href="../../resources/css/index_publico_styles.css">
                <link rel="stylesheet" href="../../resources/css/'.$css.'">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

                <!-- Fuentes Personalizadas -->
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
                <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
                <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

                <!-- Font Awesome -->
                <script src="https://kit.fontawesome.com/43634cb7dc.js" crossorigin="anonymous"></script>

                <title>'.$titulo.'</title>
                </head>
                '
            );

            // Se obtiene el nombre del archivo de la página web actual.
            $filename = basename($_SERVER['PHP_SELF']);
            // Se comprueba si existe una sesión de cliente para mostrar el menú de opciones, de lo contrario se muestra otro menú.
            if (isset($_SESSION['idCliente'])) {
                // Se verifica si la página web actual es diferente a login.php y register.php, de lo contrario se direcciona a index.php
                if ($filename != 'iniciar_sesion.php' && $filename != 'crear_cuenta.php') {

                    if(isset($_SESSION['tiempo']))
                    {
                    //
                    $tinactivo = 300;
                    //Calculamos tiempo de vida inactivo.
                    $tiempo = time() - $_SESSION['tiempo'];    
                        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
                        if($tiempo > $tinactivo)
                        {
                            //Removemos sesión.
                            unset($_SESSION['idCliente']); 
                            //Destruimos sesión.   
                            session_destroy();  
                            // Se redirecciona
                            header("Location: logout.php"); 
                            exit();
                        } else {  // si no ha caducado la sesion, actualizamos
                            $_SESSION['tiempo'] = time();
                        }
                    }
                    else
                    {
                    $_SESSION['tiempo'] = time();
                    }

                    print('
                        <!--Inicio del navbar-->
                        <body>
                        <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                            <div class="container">
                            <a class="navbar-brand" href="../../views/public/index.php">
                                <img src="../../resources/img/p icono.png" alt="img-fluid" height="40px" width="40px">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <ion-icon name="grid"></ion-icon>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown" id="dropdownCategorias">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Categorías
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown" id="dropdownCategories-body">
                                    
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#AcercaNosotros">Acerca de Nosotros</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#Soporte">Soporte</a>
                                </li>

                                </ul>
                                <form id="controlesNavbar">
                                    <button id="btnCarrito" data-bs-toggle="modal" data-bs-target="#carritoModal" class="btn text-white" onclick="readOrderDetail()"><i class="fas fa-shopping-cart mx-2"></i></button>
                                    
                                </form>
                                <div class="dropdown">
                                    <button class="btn d-flex" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="../../resources/img/dashboard_img/cliente_fotos/' . $_SESSION['fotoCliente'] . '" id="fotoPerfil" alt="" class="rounded-circle fotografiaPerfil2" width="40px">
                                            <h5 class="text-center mx-3 paddingUsername">' . $_SESSION['usuarioCliente'] . '</h5>
                                            <i class="fas fa-caret-down paddingFlecha"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark  animate__animated animate__bounceIn" aria-labelledby="dropdownMenuButton1">
                                        <li><a id="btnMisPedidos" onclick="readClientRecord()" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#pedidosClienteModal" href="#">Mis Pedidos</a></li>
                                        <li><a id="btnMiCuenta" class="dropdown-item" href="mi_cuenta.php">Mi Cuenta</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="logOutCliente()">Cerrar Sesión</a></li>
                                    </ul>
                                </div>  
                            </div>
                            </div>
                        </nav>
                    ');
                } else {
                    header('location: index.php');
                }
            } else {
                // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
                print('
                        <!--Inicio del navbar-->
                        <body>
                        <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                            <div class="container">
                            <a class="navbar-brand" href="../../views/public/index.php">
                                <img src="../../resources/img/p icono.png" alt="img-fluid" height="40px" width="40px">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <ion-icon name="grid"></ion-icon>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown" id="dropdownCategorias">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Categorías
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown" id="dropdownCategories-body">

                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#AcercaNosotros">Acerca de Nosotros</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#Soporte">Soporte</a>
                                </li>

                                </ul>
                                <form id="controlesNavbar">
                                    
                                    <a href="../../views/public/iniciar_sesion.php" class="btn btn-outline-light">Acceder</a>
                                    <a href="../../views/public/crear_cuenta.php" class="btn btn-outline-secondary">Registrarse</a>
                                    
                                </form>
                            </div>
                            </div>
                        </nav>
                    ');
            }
        }

        public static function footerTemplate($controller){
            print('
            <!-- Modal para ver pedidos del cliente -->
            <div class="modal fade" id="pedidosClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel"><span class="fas fa-info-circle mx-3 text-white"></span>Pedidos</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-white"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-12 d-flex justify-content-center table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Fecha del Pedido</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyPedidos-rows">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para ver productos del pedido -->
            <div class="modal fade" id="productosPedidoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#pedidosClienteModal"><span class="fas fa-chevron-left"></span></button>
                            <h5 class="modal-title text-white" id="exampleModalLabel"><span class="fas fa-info-circle mx-3 text-white"></span>Pedidos</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-white"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-12 d-flex justify-content-center">
                                    <textarea name="txtProductos" class="form-control personalizacionPolus" id="txtProductos" rows="5" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel"><span class="fas fa-info-circle mx-3 text-white"></span>Carrito</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-white"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                            <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                            <input class="visually-hidden" type="number" id="id_detalle" name="id_detalle">
                                <div class="col-12 d-flex justify-content-center table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyCart-rows">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p>TOTAL A PAGAR (US$) <b id="pago"></b></p>
                            <button type="button" id="finish" class="btn btn-outline-light" onclick="finishOrderCart()"><i class="fas fa-shipping-fast"></i> Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="actualizarCantidades" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white" id="exampleModalLabel"><span class="fas fa-info-circle mx-3 text-white"></span>Cambiar Cantidad</h5>
                                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-white"></i></button>
                                </div>
                                <div class="modal-body">
                                    <form id="cantidadUpdate-form" method="post">
                                        <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                                        <input class="visually-hidden" type="number" id="idProducto3" name="idProducto3">
                                        <input class="visually-hidden" type="number" id="idDetalle" name="idDetalle">
                                        <input class="visually-hidden" type="number" id="cantidadCart" name="cantidadCart">
                                        <input class="visually-hidden" type="number" id="stockReal" name="stockReal">
                                        <input class="visually-hidden" type="text" id="tipo2" name="tipo2">
                                        <input class="visually-hidden" type="text" id="txtCantidad4" name="txtCantidad4">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <div>
                                                    <h1 class="tituloProducto" id="stock2"><span class="textoProducto3"></span></h1>
                                                    <label for="#" id="labelTalla2" class="text-white text-center my-2">Confirme la talla:</label>
                                                    <select id="cbTallas" name="cbTallas" class="form-select personalizacionPolus3" aria-label="Default select example"
                                                    onchange="showClothesStockCart()"></select>                        
                                                    <label for="#" class="text-white text-center my-2">Cantidad:</label><br>
                                                    <div class="form-group d-flex mt-3 justify-content-center" id="columnaCantidad2">
                                                        <button class="btn btn-outline-light" id="btnminus"><span class="fas fa-minus"></span></button>
                                                        <h1 class="cantidadProducto mt-2 mx-4" id="cantidad2">1</h1>
                                                        <button class="btn btn-outline-light" id="btnplus"><span class="fas fa-plus"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-light" id="updateCart">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

            <!-- Modal para confirmar pedido -->
            <div class="modal fade" id="pedidoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-3 text-white"></span>Detalles</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fas fa-times text-white"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="tituloConfirmacion text-center">Información de Contacto</h1>
                                    <div class="d-flex justify-content-center" id="informacionClienteContenido">
                                        <div class="d-flex flex-column m-3">
                                            <h1 class="tituloInformacion">NOMBRE:</h1>
                                            <label class="informacionCliente">Eduardo Rivera</label>
                                        </div>
                                        <div class="d-flex flex-column m-3">
                                            <h1 class="tituloInformacion">CORREO:</h1>
                                            <label class="informacionCliente">riv.edu10@gmail.com</label>
                                        </div>
                                        <div class="d-flex flex-column m-3">
                                            <h1 class="tituloInformacion">TELÉFONO:</h1>
                                            <label class="informacionCliente">0000-0000</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                    <span class="tituloConfirmacion">Dirección del Envio</span>
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="form-group">
                                                        <textarea rows=2 class="form-control personalizacionPolus"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    <span class="tituloConfirmacion">Notas de Envio</span>
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingTwo"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="form-group">
                                                        <textarea rows=2 class="form-control personalizacionPolus"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-target="#carritoModal" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="readOrderDetail()">Regresar</button>
                            <button type="button" class="btn btn-outline-light">Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>

            <footer id="piePagina">
            <div class="container-fluid" style="background-color: #22242C; padding-top:40px; padding-bottom:30px;">
              <div class="row">
                <ul id="lista">
                  <li><a href="" class="padding1Link"><i class="fab fa-instagram"></i> Instagram</a></li>
                  <li><a href="" class="paddingLink"><i class="fab fa-facebook"></i> Facebook</a></li>
                  <li><a href="" class="paddingLink"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                </ul>
                <p class="textoFooter">Diseñado y creado por Eduardo Rivera, Katherine Salinas, Samuel Magaña</p>
                <p class="textoFooter">Todos los Derechos Reservados © 2021 - Polus El Salvador</p>
              </div>
            </div>
            </footer>
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
            
            <script>
                document.getElementById(\'controlesNavbar\').addEventListener(\'submit\',function(event){
                    event.preventDefault();
                });
            </script>

            <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../../app/helpers/components.js"></script>
            <script type="text/javascript" src="../../app/controllers/public/mi_cuenta.js"></script>
            <script type="text/javascript" src="../../app/controllers/public/'.$controller.'"></script>
          
            <!-- IONICONS -->
            <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
          
          </body>
          
          </html>
            ');
        }

    }
?>