<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador','.');
?>
<!--Fin del navbar-->
<link rel="stylesheet" type="text/css" href="../../resources/css/categoria_publico.css">
<!--Inicio del Contenedor Principal-->
<div class="container-fluid" id="contenedorPrincipal">
    <div class="row">
        <!--Inicio del Contenedor de filtro-->
        <div class="col-lg-3 col-md-12 mt-5 pt-5 mb-5 animate__animated animate__bounceInLeft">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">Filtrar por:</h3>
                </div>
            </div>
            <!--Apartados de filtros-->
            <div class="row justify-content-center">
                <!--Inicio sección de talla-->
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btncheck1">XS</label>

                        <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btncheck2">S</label>

                        <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btncheck3">M</label>

                        <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btncheck3">X</label>

                        <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btncheck3">XL</label>

                        <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btncheck3">XLL</label>
                    </div>
                    
                </div>
                <div class="form-group mt-3 d-flex justify-content-center align-items-center flex-column">
                    <input type="text" class="form-control personalizacionPolus2" name="" id="">
                    <button class="btn btn-outline-light">Buscar</button>
                </div>
            </div>
        </div>
        <!--Inicio del Contenedor de categoria/productos-->
        <div class="col-lg-9 col-md-12">
            <div class="row">
                <div class="col-12 animate__animated animate__bounceInDown">
                    <h1>Productos</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="row d-flex justify-content-center">
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/cosmeticoslider.jpg" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">CAMISETA TSHIRT NEGRO UNISEX</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$17.99</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="producto.php"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/cosmeticoslider.jpg" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">CAMISETA TSHIRT NEGRO UNISEX</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$17.99</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="producto.php"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/cosmeticoslider.jpg" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">CAMISETA TSHIRT NEGRO UNISEX</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$17.99</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="producto.php"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/cosmeticoslider.jpg" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">CAMISETA TSHIRT NEGRO UNISEX</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$17.99</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="producto.php"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/cosmeticoslider.jpg" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">CAMISETA TSHIRT NEGRO UNISEX</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$17.99</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="producto.php"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/cosmeticoslider.jpg" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">CAMISETA TSHIRT NEGRO UNISEX</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$17.99</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="producto.php"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/cosmeticoslider.jpg" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">CAMISETA TSHIRT NEGRO UNISEX</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$17.99</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="producto.php"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
public_Page::footerTemplate();
?>