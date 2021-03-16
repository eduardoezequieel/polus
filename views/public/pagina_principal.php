<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador','.');
?>
<!-- Inicio del carousel con imagenes de prueba-->
<div class="container-fluid pb-5" style="background-color:#22242C;">
    <div class="row pt-5 justify-content-center">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <a href="carrito.php" class="btn btn-outline-light ml-4 mt-2">Carrito</a>
        </div>
    </div>
    <div class="row pt-2 mb-5">
        <div class="col-12">
            <h1 class="titulos2 text-center">¿Qué tenemos hoy?</h1>
        </div>
    </div>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../resources/img/carrusel1.jpg" class="d-block m-auto w-50" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-dark display-2">Ropa</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../resources/img/carrusel2.jpg" class="d-block m-auto w-50" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-light display-2">Descuentos</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../resources/img/carrusel3.jpg" class="d-block m-auto w-50" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-dark display-2">Calidad-Precio</h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Fin del carousel con imagenes de prueba-->
<div class="container-fluid mb-5" id="contenedorCategorias" style="background-color: #16181D;">
    <div class="row" id="categoria">
        <h1 class="titulos2" style="text-align: center;">Mira nuestras <span
                style="color: #605AC3;"><b>categorias.</b></span></h1>
        <div class="container my-4 w-50">

            <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../resources/img/ropaslider.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-dark">Ropa</h5>
                            <p class="text-dark">Some representative placeholder content for the first slide.</p>
                            <a href="categoria.php" class="btn btn-dark">Ver Más</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../../resources/img/mujercuidadofacial.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-dark">Cuidado Personal</h5>
                            <p class="text-dark">Some representative placeholder content for the second slide.</p>
                            <a href="categoria.php"class="btn btn-dark">Ver Más</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../../resources/img/cosmeticoslider (2).jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-dark">Cosmeticos</h5>
                            <p class="text-dark">Some representative placeholder content for the third slide.</p>
                            <a href="categoria.php" class="btn btn-dark">Ver Más</a>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions2"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions2"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php
public_Page::footerTemplate();
?>