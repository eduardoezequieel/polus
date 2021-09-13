<?php
    class dashboard_Page{
        public static function sidebarTemplate($titulo, $css){
            session_start();
            print('
                
            <!DOCTYPE html>
            <html>
            
            <head>
                <title>'.$titulo.'</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <meta http-equiv="Expires" content="0">
                <meta http-equiv="Last-Modified" content="0">
                <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
                <meta http-equiv="Pragma" content="no-cache">
                
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
            
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="../../resources/css/dashboard_page_estilos.css">
         
                <link rel="stylesheet" href="../../resources/css/'.$css.'">
                <script src="https://kit.fontawesome.com/43634cb7dc.js" crossorigin="anonymous"></script>
                
            
                
            </head>
            
            <body>
                '
            );

            //Se obtiene el nombre del archivo de la pagina web actual
            $filename = basename($_SERVER['PHP_SELF']);
            //Se comprueba si existe una sesión de admin para mostrar las opcines
            if (isset($_SESSION['idAdmon'])){
                //Se verifica si la pag es diferente a index o primer usuario
                if ($filename != 'index.php' && $filename != 'primer_uso.php'){

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
                            unset($_SESSION['idAdmon']); 
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
                                    
                        <!-- Vertical navbar -->
                        <div class="vertical-nav" id="sidebar">
                            <div class="py-4 px-3 mb-2 fondoOscuro">
                                <div class="media d-flex align-items-center">
                                <a href="../../views/dashboard/pagina_dashboard.php"><img src="../../resources/img/polus tipografia.png" alt="" class="img-fluid" width="250px"></a>
                                
                                </div>
                            </div>
                            <p class="titulosSidebar px-3 small pb-2 mb-0">ADMINISTRACIÓN</p>
                            <ul class="nav flex-column mb-0">
                                <li class="nav-item">
                                    <a href="#" id="usuariosbtn" class="nav-link text-white"><span class="fas fa-user-tie lead mx-3"></span><span id="usuarioLabel">Usuarios</span> <i class="fas fa-caret-down padding1"></i></a>
                                    <ul class="ocultar animate__animated animate__fadeInLeft animate__faster animate__delay-0s" id="usuarios-mostrar">
                                        <li><a href="../../views/dashboard/agregar_usuarios.php" class="nav-link text-white submenu">Agregar Usuarios</a></li>
                                        <li><a href="../../views/dashboard/administrar_usuarios.php" class="nav-link text-white submenu">Administrar Usuarios</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="../../views/dashboard/administrar_clientes.php" class="nav-link text-white "><span class="fas fa-user-tag lead mx-3"></span>Clientes</a>            
                                </li>
                            </ul>
                    
                            <p class="titulosSidebar px-3 small pb-2 pt-4 mb-0">TIENDA</p>
                            <ul class="nav flex-column mb-0">
                                <li class="nav-item">
                                    <a href="#" id="productosbtn" class="nav-link text-white "><span class="fas fa-store-alt lead mx-3"></span>Productos<i class="fas fa-caret-down padding2"></i></a>
                                    <ul class="ocultar animate__animated animate__fadeInLeft animate__faster animate__delay-0s" id="productos-mostrar">
                                        
                                        <li><a href="../../views/dashboard/administrar_productos.php" class="nav-link text-white submenu">Administrar Productos</a></li>
                                        <li><a href="../../views/dashboard/inventario.php" class="nav-link text-white submenu">Inventario</a></li>
                                    </ul>           
                                </li>
                                <li class="nav-item">
                                    <a href="../../views/dashboard/pedidos.php" class="nav-link text-white "><span class="fas fa-truck lead mx-3"></span>Pedidos</a>            
                                </li>
                                
                                
                            </ul>
                            
                        </div>
                    ');

                } else {
                    header('location: index.php');
                }
            } else {
                // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a 'primer_uso.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
                if ($filename != 'index.php' && $filename != 'primer_uso.php') {
                    header('location: index.php');
                } 
            }
        }

        public static function mensajeBienvenida(){
            print('
            <div class="row">
                <div class="col-12 title my-4 animate__animated animate__fadeInUp animate__faster"><h1>¡Bienvenido ' . $_SESSION['usuario'] . '!</h1></div>
            </div>
          ');
        }

        public static function scriptBTJS(){
            print(
                '<script src="https://code.jquery.com/jquery-3.6.0.min.js"
                    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous">
                </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                    crossorigin="anonymous">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

               
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>    '
            );
        }

        public static function sidebarTemplateMovement($controller){

            // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.
            if (isset($_SESSION['idAdmon'])) {
                $scripts = '
                    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/chart.min.js"></script>
                    <script type="text/javascript" src="../../app/helpers/components.js"></script>
                    <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
                ';
            } else {
                $scripts = '
                    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/chart.min.js"></script>
                    <script type="text/javascript" src="../../app/helpers/components.js"></script>
                    <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
                ';
            }
            
            print(
                
                '' . $scripts . ' 
                <!-- Iconos en Movimiento -->
                
                <script>
                $(\'#usuariosbtn\').click(function(){
                    $(\'#usuarios-mostrar\').toggle();
                    $(\'#productos-mostrar\').hide();
                });
        
                $(\'#productosbtn\').click(function(){
                    $(\'#productos-mostrar\').toggle();
                    $(\'#usuarios-mostrar\').hide();
                });
        
                $(function() { 
                $(\'#sidebarCollapse\').on(\'click\', function() {
                  $(\'#sidebar, #content\').toggleClass(\'active\');
                });
              });
            </script>
                
                    
                </body>
            </html>'
            
            );
        }

        public static function barraInicial(){
            
            //Se obtiene el nombre del archivo de la pagina web actual
            $filename = basename($_SERVER['PHP_SELF']);
            //Se comprueba si existe una sesión de admin para mostrar las opcines
            if (isset($_SESSION['idAdmon'])){
                //Se verifica si la pag es diferente a index o primer usuario
                if ($filename != 'index.php' && $filename != 'primer_uso.php'){
                    print('
                        <div class="container" id="barraInicial">
                            <div class="row justify-content-end">
                                <div class="col-3">
                                    <button type="button" class="btn" id="sidebarCollapse"><i class="fas fa-bars lead p-2 text-black"></i></button>
                                </div>
                                <div class="col-9 d-flex justify-content-end align-items-right">
                                    <div class="dropdown">
                                        <button class="btn d-flex" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="../../resources/img/dashboard_img/admon_fotos/' . $_SESSION['fotoUsuario'] . '" id="fotoPerfil" alt="" class="rounded-circle fotografiaPerfil2" width="40px">
                                                <h5 class="text-center mx-3 paddingUsername">' . $_SESSION['usuario'] . '</h5>
                                                <i class="fas fa-caret-down paddingFlecha"></i>
                                        </button>
                                        <ul class="dropdown-menu  animate__animated animate__bounceIn m-5" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="mi_cuenta.php">Mi Cuenta</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar Sesión</a></li>
                                        </ul>
                                    </div>  
                                </div>
                            </div>
                        </div>'
                    );

                } else {
                    header('location: index.php');
                }
            } else {
                // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a 'primer_uso.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
                if ($filename != 'index.php' && $filename != 'primer_uso.php') {
                    header('location: index.php');
                } 
                
            }
        }
    }
?>