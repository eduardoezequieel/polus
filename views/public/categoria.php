<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador');
?>
<!--Fin del navbar-->
<link rel="stylesheet" type="text/css" href="../../resources/css/categoria_publico.css">
<!--Inicio del Contenedor Principal-->
<div class="container-fluid" id="contenedorPrincipal">
    <div class="row">
        <!--Inicio del Contenedor de filtro-->
        <div class="col-lg-3 col-md-12" id="filtro">
            <div class="row">
                <div class="col-12">
                    <h3>Filtros</h3>
                </div>
            </div>
            <!--Apartados de filtros-->
            <div class="row">
                <!--Inicio sección de talla-->
                <div class="col-12">
                    <h4>Talla</h4>
                </div>
                <div class="col-12">
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
            </div>
        </div>
        <!--Inicio del Contenedor de categoria/productos-->
        <div class="col-lg-9 col-md-12" id="categoria">
            <div class="row">
                <div class="col-12">
                    <h1>Productos</h1>
                </div>
                <div class="col-12 ">
                    <div class="card-group">
                        <div class="row">
                            <!--Inicio de la tarjeta 1-->
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="card bg-dark ">
                                    <img src="../../resources/img/ropa.jpg" class="card-img-top imagenPrincipal" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Ropa</h5>
                                        <p class="card-text">Ropa hecha 100% en El Salvador con materiales de calidad y diseños únicos que sin duda te harán lucir.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-outline-light" id="agregarFoto">Ver más</button>
                                        <a href="">
                                            <p class="card-text btn btn-outline-light">  Agregar al carrito</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--Inicio de la tarjeta 2-->
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="card bg-dark">
                                    <img src="../../resources/img/mascarilla.png" class="card-img-top imagenPrincipal" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Cuidado facial</h5>
                                        <p class="card-text">Consigue las mejores mascarillas ecónomicas del mercado 100% recomendadas para que cuides tu piel</p>
                                        
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-outline-light" id="agregarFoto">Ver más</button>
                                        <a href="">
                                            <p class="card-text btn btn-outline-light">  Agregar al carrito</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--Inicio de la tarjeta 3-->
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="card bg-dark">
                                    <img src="../../resources/img/maquillaje.jpg" class="card-img-top img-fluid imagenPrincipal" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Maquillaje</h5>
                                        <p class="card-text">Consigue el mejor maquillaje que te puedas imaginar, sombras, brochas y mucho más para lucir tu belleza.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-outline-light" id="agregarFoto">Ver más</button>
                                        <a href="">
                                            <p class="card-text btn btn-outline-light">  Agregar al carrito</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
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