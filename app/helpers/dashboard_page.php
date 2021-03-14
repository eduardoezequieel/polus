<?php
    class dashboard_Page{
        public static function sidebarTemplate($css, $titulo){
            print(
                '
                <!doctype html>
                <html lang="es">
                <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">

                    <!-- Bootstrap core CSS -->
                    <link href="../../app/controllers/bootstrap/css/bootstrap.min.css" rel="stylesheet">


                    <link rel="stylesheet" href="../../resources/css/'.$css.'">

                    <link rel="preconnect" href="https://fonts.gstatic.com">
                    
                    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

                    <!-- Font Awesome -->
                    <script src="https://kit.fontawesome.com/43634cb7dc.js" crossorigin="anonymous"></script>


                    <title>'.$titulo.'</title>
                </head>
                <body>
                    <div class="d-flex" id="wrapper">
                    <!-- Sidebar -->
                    <div class="" id="sidebar-wrapper">
                        <div class="sidebar-heading">
                        <img src="../../resources/img/polus tipografia.png" alt="" class="img-fluid pt-2">
                        </div>
                        <nav class="sidebar-container" id="barraLado">
                        
                        <ul>
                            <h1 class="titulo1">ADMINISTRACIÓN</h1>
                            <li><a href="#" class="usuarios-btn"><span class="fas fa-user-tie lead" style="margin-right: 20px;"></span>Usuarios<i class="fas fa-caret-down primero flecha"></i></a></li>
                            <ul class="usuarios-mostrar">
                                <li><a href="../../views/dashboard/agregar_usuarios.php">Agregar Usuarios</a></li>
                                <li><a href="../../views/dashboard/administrar_usuarios.php">Administrar Usuarios</a></li>
                            </ul>
                            <li><a href=""><span class="fas fa-user-tag lead" style="margin-right: 10px;"></span> Clientes</a></li>
                            <h1 class="titulo1">TIENDA</h1>
                            <li><a href="#" class="productos-btn"><span class="fas fa-store-alt lead" style="margin-right: 10px;"></span> Productos<i class="fas fa-caret-down segundo flecha"></i></a></li>
                            <ul class="productos-mostrar">
                                <li><a href="">Agregar Productos</a></li>
                                <li><a href="">Administrar Productos</a></li>
                                <li><a href="">Inventario</a></li>
                                <li><a href="">Administrar Imagenes</a></li>
                                <li><a href="">Tipos de Productos</a></li>
                                <li><a href="">Marcas</a></li>
                            </ul>
                            <li><a href=""><span class="fas fa-truck lead" style="margin-right: 10px;"></span> Pedidos</a></li>
                        </ul>
                        </nav>
                    </div>
                '
            );
        }

        public static function scriptBTJS(){
            print(
                '<script src="../../app/controllers/jquery/jquery.min.js"></script>
                <script src="../../app/controllers/bootstrap/js/bootstrap.bundle.min.js"></script>'
            );
        }

        public static function sidebarTemplateMovement(){
            print(
                '<!-- Iconos en Movimiento -->
    
                <script>
                  $(\'.usuarios-btn\').click(function(){
                    $(\'nav ul .usuarios-mostrar\').toggleClass("mostrar");
                    $(\'nav ul .primero\').toggleClass("rotate");
                  });
                  $(\'.productos-btn\').click(function(){
                    $(\'nav ul .productos-mostrar\').toggleClass("mostrar1");
                    $(\'nav ul .segundo\').toggleClass("rotate");
                  });
                </script>
            
                  <!-- Menu Toggle Script -->
                <script>
                  $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                  });
                </script>'
            );
        }

        public static function barraInicial(){
            print(
                '<div class="container-fluid" id="barraInicial"> 
                    <div class="row">
                    <div class="col-11">
                        <button class="btn" id="menu-toggle"><i class="fas fa-bars lead p-2 text-black"></i></button>
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