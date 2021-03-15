<?php
    class dashboard_Page{
        public static function sidebarTemplate($titulo, $css){
            print('
                
            <!DOCTYPE html>
            <html>
            
            <head>
                <title>'.$titulo.'</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
            
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="../../resources/css/dashboard_page_estilos.css">
                <link rel="stylesheet" href="../../resources/css/'.$css.'">
                
            
                <!-- Font Awesome -->
                <script src="https://kit.fontawesome.com/43634cb7dc.js" crossorigin="anonymous"></script>
            </head>
            
            <body>
            
                <!-- Vertical navbar -->
                <div class="vertical-nav" id="sidebar">
                    <div class="py-4 px-3 mb-2 fondoOscuro">
                        <div class="media d-flex align-items-center">
                        <a href="../../views/dashboard/index.php"><img src="../../resources/img/polus tipografia.png" alt="" class="img-fluid" width="250px"></a>
                        
                        </div>
                    </div>
                    <p class="titulosSidebar px-3 small pb-2 mb-0">ADMINISTRACIÓN</p>
                    <ul class="nav flex-column mb-0">
                        <li class="nav-item">
                            <a href="#" id="usuariosbtn" class="nav-link text-white"><span class="fas fa-user-tie lead mx-3"></span><span id="usuarioLabel">Usuarios</span> <i class="fas fa-caret-down padding1"></i></a>
                            <ul class="ocultar" id="usuarios-mostrar">
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
                            <ul class="ocultar" id="productos-mostrar">
                                <li><a href="../../views/dashboard/agregar_productos.php" class="nav-link text-white submenu">Agregar Productos</a></li>
                                <li><a href="../../views/dashboard/administrar_productos.php" class="nav-link text-white submenu">Administrar Productos</a></li>
                                <li><a href="../../views/dashboard/inventario.php" class="nav-link text-white submenu">Inventario</a></li>
                                <li><a href="../../views/dashboard/administrar_imagenes.php" class="nav-link text-white submenu">Administrar Imagenes</a></li>
                                <li><a href="../../views/dashboard/tipos_producto.php" class="nav-link text-white submenu">Tipos de Productos</a></li>
                                <li><a href="../../views/dashboard/marca.php" class="nav-link text-white submenu">Marcas</a></li>
                            </ul>           
                        </li>
                        <li class="nav-item">
                            <a href="../../views/dashboard/pedidos.php" class="nav-link text-white "><span class="fas fa-truck lead mx-3"></span>Pedidos</a>            
                        </li>
                    </ul>
                    
                </div>
                '
            );
        }

        public static function scriptBTJS(){
            print(
                '<script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
            </script>'
            );
        }

        public static function sidebarTemplateMovement(){
            print(
                '<!-- Iconos en Movimiento -->
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
            </script>'
            );
        }

        public static function barraInicial(){
            print(
                '<div class="container" id="barraInicial"> 
                    <div class="row">
                    <div class="col-11">
                        <button type="button" class="btn" id="sidebarCollapse"><i class="fas fa-bars lead p-2 text-black"></i></button>
                    </div>
                    <div class="col-1">
                        <button class="btn"><img src="../../resources/img/dashboard_img/user.png" class="img-fluid imagenUsuario"></button>
                    </div>
                    </div>
                </div>'
            );
        }
    }
?>