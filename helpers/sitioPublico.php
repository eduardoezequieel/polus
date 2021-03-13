<?php
    class sitioPublico{
        public static function navbarTemplate($titulo){
            print(
                '<!doctype html>
                <html lang="es">

                <head>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

                <link rel="stylesheet" href="/css/indexEstilos.css">

                <!-- Fuentes Personalizadas -->
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

                <!-- Font Awesome -->
                <script src="https://kit.fontawesome.com/43634cb7dc.js" crossorigin="anonymous"></script>

                <title>'.$titulo.'</title>
                </head>
                <!--Inicio del navbar-->
                <body>
                <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                    <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="/img/p icono.png" alt="img-fluid" height="40px" width="40px">
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
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Acerca de Nosotros</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Soporte</a>
                        </li>

                        </ul>
                        <form class="d-flex">
                        <button class="btn btn-outline-light botonEstilo">Iniciar Sesión</button>
                        </form>
                    </div>
                    </div>
                </nav>
                '
            );
        }
    }
?>