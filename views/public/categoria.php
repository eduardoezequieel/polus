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
        <div class="col-lg-3 col-md-12 mt-5 mb-5 animate__animated animate__bounceInLeft">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">Filtrar por:</h3>
                </div>
            </div>
            <!--Apartados de filtros-->
            <div class="row justify-content-center">
                <!--Inicio sección de talla-->
                <form method="post" id="search-talla">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <label for="#" class="text-white text-center me-2">Talla:</label>
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
                </form>
                <form method="post" id="search-subcategoria">
                    <div class="form-group mt-3 d-flex justify-content-center align-items-center flex-column">
                        <label for="#" class="text-white text-center my-2">Subcategoria:</label>
                        <select id="cbSubcategorias" name="cbSubcategorias" class="form-select personalizacionPolus2" aria-label="Default select example"></select>                        
                        <button class="btn btn-outline-light">Buscar</button>
                    </div>
                </form>
                <form method="post" id="search-form">
                    <div class="form-group mt-3 d-flex justify-content-center align-items-center flex-column">
                        <label for="#" class="text-white text-center my-2">Escriba algo:</label>
                        <input type="text" class="form-control personalizacionPolus2" name="search" id="search" placeholder="{Nombre del Producto}">
                        <button class="btn btn-outline-light">Buscar</button>
                    </div>
                </form>
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
    <!-- Modal -->
    <div class="modal fade" id="cantidadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel"><span class="fas fa-info-circle mx-3 text-white"></span>Cantidad de unidades</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-white"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-12 d-flex justify-content-center">
                                    <form id="cantidad-form" method="post">
                                        <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                                    <input class="visually-hidden" type="number" id="idProducto2" name="idProducto2">
                                    <label for="precio" class="form-label">Cantidad:</label><br>
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">uds</span>
                                    <input type="number" class="form-control" placeholder="cantidad" id="txtCantidad" name="txtCantidad" Required></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-light" id="agregarCart">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
</div>
<?php
public_Page::footerTemplate('productos.js');
?>