<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador');
?>
<section>
    <div class="container-fluid" style="background-color: #22242C;">
        <div class="row">
            <h1 class="titulos2" id="parrafo" style="background-color: #22242C;">
                <spanstyle="font-weight:bolder">Cuidado de la piel</span>
            </h1>
        </div>
        <div>
            <center>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-light active disable">Mascarillas</button>
                </div>

                <div class="card-group">
                    <div class="card border-light text-white bg-dark mb-3">
                        <center>
                        <img class="card-img-top" src="../../resources/img/aloe.png" style="width: 250px; margin-top: 50px;" alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Mascarilla de Aloe Vera</h5>
                            <center>
                            <button type="button" class="btn btn-outline-light">Ver más</button>
                            </center>
                        </div>
                    </div>
                    <div class="card border-light text-white bg-dark mb-3">
                        <center>
                        <img class="card-img-top" src="../../resources/img/acuacate.png" style="width: 350px; height:280px; margin-top: 50px;" alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Mascarilla de Aguacate</h5>   
                            <center>
                            <button type="button" class="btn btn-outline-light">Ver más</button>
                            </center>
                        </div>
                    </div>
                    <div class="card border-light text-white bg-dark mb-3">
                        <center>
                        <img class="card-img-top" src="../../resources/img/pepino.png" style="width: 270px; height:280px; margin-top: 50px;" alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Mascarilla de Pepino</h5>
                                <center>
                                <button type="button" class="btn btn-outline-light">Ver más</button>
                                </center>
                        </div>
                    </div>
                </div>
            </center>
</section>

<?php
public_Page::footerTemplate();
?>