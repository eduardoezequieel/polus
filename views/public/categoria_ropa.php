<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador');
?>
<link rel="stylesheet" type="text/css" href="../../resources/css/categoria_ropa_publico.css">
<section>
    <div class="container-fluid" style="background-color: #22242C;">
        <div class="row">
            <h1 class="titulos2" id="parrafo" style="background-color: #22242C;">
                <spanstyle="font-weight:bolder">Ropa</span>
            </h1>
        </div>
        <div>
            <center>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-light active">Sueteres</button>
                    <button type="button" class="btn btn-outline-light">Camisas</button>
                    <button type="button" class="btn btn-outline-light">Para hombre</button>
                    <button type="button" class="btn btn-outline-light">Para Mujer</button>
                </div>

                <div class="card-group">
                    <div class="card text-white bg-dark mb-3">
                        <center>
                        <img class="card-img-top" src="../../resources/img/hoodie.png" style="width: 250px; margin-top: 50px;" alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Sueter Basico</h5>
                            <center>
                            <button type="button" class="btn btn-outline-light">Ver más</button>
                            </center>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mb-3">
                        <center>
                        <img class="card-img-top" src="../../resources/img/sueter.png" style="width: 300px; height:250px; margin-top: 50px;" alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Sueter cuello de tortuga</h5>   
                            <center>
                            <button type="button" class="btn btn-outline-light">Ver más</button>
                            </center>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mb-3">
                        <center>
                        <img class="card-img-top" src="../../resources/img/sueter4.png" style="width: 250px; height:250px; margin-top: 50px;" alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Sueter estampado</h5>
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