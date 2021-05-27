<?php
    class public_Page{
        public static function navbarTemplate($titulo, $css){
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
                <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 

                <!-- Font Awesome -->
                <script src="https://kit.fontawesome.com/43634cb7dc.js" crossorigin="anonymous"></script>

                <title>'.$titulo.'</title>
                </head>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Catalogo
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown" id>
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../views/public/categoria.php">Pagina X Catalogo</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#AcercaNosotros">Acerca de Nosotros</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#Soporte">Soporte</a>
                        </li>

                        </ul>
                        <form id="controlesNavbar">
                            <button id="btnCarrito" data-bs-toggle="modal" data-bs-target="#carritoModal" class="btn text-white"><i class="fas fa-shopping-cart mx-2"></i>$4.99</button>
                            <a href="../../views/public/iniciar_sesion.php" class="btn btn-outline-light">Acceder</a>
                            <a href="../../views/public/crear_cuenta.php" class="btn btn-outline-secondary">Registrarse</a>
                            
                        </form>
                    </div>
                    </div>
                </nav>

                
                '
            );
        }

        public static function footerTemplate(){
            print('
            <!-- Modal -->
            <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel"><span class="fas fa-info-circle mx-3 text-white"></span>Carrito</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-white"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-12 d-flex justify-content-center table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>T-SHIRT MORADA</td>
                                                <td>$2.99</td>
                                                <th>
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 d-flex justify-content-center">
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-minus"></i></button>
                                                            <div class="row mt-1">
                                                                <div class="col-12">
                                                                    <h1 class="text-white mx-2 contadorCantidad">2</h1>
                                                                </div>
                                                            </div>
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>$5.99</td>
                                                <th>
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 d-flex justify-content-center">
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>T-SHIRT MORADA</td>
                                                <td>$2.99</td>
                                                <th>
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 d-flex justify-content-center">
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-minus"></i></button>
                                                            <div class="row mt-1">
                                                                <div class="col-12">
                                                                    <h1 class="text-white mx-2 contadorCantidad">2</h1>
                                                                </div>
                                                            </div>
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>$5.99</td>
                                                <th>
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 d-flex justify-content-center">
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>T-SHIRT MORADA</td>
                                                <td>$2.99</td>
                                                <th>
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 d-flex justify-content-center">
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-minus"></i></button>
                                                            <div class="row mt-1">
                                                                <div class="col-12">
                                                                    <h1 class="text-white mx-2 contadorCantidad">2</h1>
                                                                </div>
                                                            </div>
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>$5.99</td>
                                                <th>
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 d-flex justify-content-center">
                                                            <button class="btn botonContador btn-outline-light text-center"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-light" data-bs-target="#pedidoModal" data-bs-toggle="modal" data-bs-dismiss="modal">Siguiente</button>
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
          
            <!-- IONICONS -->
            <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
          
          </body>
          
          </html>
            ');
        }

    }
?>