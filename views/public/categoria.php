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
                    <h1 id="titulo">Productos</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="row d-flex justify-content-center" id="products-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
public_Page::footerTemplate('productos.js');
?>