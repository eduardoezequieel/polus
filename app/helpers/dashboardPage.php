<?php
    class dashboard_Page{
        public static function sidebarTemplate($titulo){
            print(
                '
                <!doctype html>
                <html lang="es">
                <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">

                    <!-- Bootstrap core CSS -->
                    <link href="../../app/bootstrap/css/bootstrap.min.css" rel="stylesheet">


                    <link rel="stylesheet" href="../../resources/css/indexPrivadoEstilos.css">

                    <link rel="preconnect" href="https://fonts.gstatic.com">
                    
                    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">

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
                                <li><a href="">Agregar Usuarios</a></li>
                                <li><a href="">Administrar Usuarios</a></li>
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
    }
?>