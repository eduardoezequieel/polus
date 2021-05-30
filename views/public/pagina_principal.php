<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador','.');
?>
<!-- Inicio del carousel con imagenes de prueba-->
<div class="container-fluid pb-5" style="background-color:#16181D;">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center animate__animated animate__zoomInUp">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="../../resources/img/carrusel1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="../../resources/img/carrusel2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="../../resources/img/carrusel3.jpg" class="d-block w-100" alt="...">
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
    </div>
    
    <div class="row pt-2 mt-4 mb-2 animate__animated animate__fadeInDown">
        <div class="col-12">
            <h1 class="titulos2 text-center">¿Qué tenemos hoy?</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center">
            <div class="row d-flex justify-content-center">
                <div class="col d-flex justify-content-center">
                    <a href="categoria.php" class="btn botonCategoria animate__animated animate__fadeInDown d-flex flex-column justify-content-center align-items-center">
                        <img src="../../resources/img/tshirt.png" alt="#" class="img-fluid w-25 mb-2"> 
                        Prueba
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="categoria.php" class="btn botonCategoria animate__animated animate__fadeInDown d-flex flex-column justify-content-center align-items-center">
                        <img src="../../resources/img/tshirt.png" alt="#" class="img-fluid w-25 mb-2"> 
                        Prueba
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="categoria.php" class="btn botonCategoria animate__animated animate__fadeInDown d-flex flex-column justify-content-center align-items-center">
                        <img src="../../resources/img/tshirt.png" alt="#" class="img-fluid w-25 mb-2"> 
                        Prueba
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="categoria.php" class="btn botonCategoria animate__animated animate__fadeInDown d-flex flex-column justify-content-center align-items-center">
                        <img src="../../resources/img/tshirt.png" alt="#" class="img-fluid w-25 mb-2"> 
                        Prueba
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="categoria.php" class="btn botonCategoria animate__animated animate__fadeInDown d-flex flex-column justify-content-center align-items-center">
                        <img src="../../resources/img/tshirt.png" alt="#" class="img-fluid w-25 mb-2"> 
                        Prueba
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="categoria.php" class="btn botonCategoria animate__animated animate__fadeInDown d-flex flex-column justify-content-center align-items-center">
                        <img src="../../resources/img/tshirt.png" alt="#" class="img-fluid w-25 mb-2"> 
                        Prueba
                    </a>
                </div>
                
            </div> 
        </div>
    </div>
</div>





<?php
public_Page::footerTemplate();
?>