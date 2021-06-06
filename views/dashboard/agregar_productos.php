<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','productos_privado_estilos.css');
?>
<!--Fin del sidebar-->
<!-- Contenido de la Pagina -->
<div class="page-content p-5" id="content">
    <!-- Contenedor de la barra inicial -->
    <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
    <!-- Section para mostrar contenido -->
    <section>
        <div class="container-fluid">
            <!-- Mostrar titulo -->
            <div class="row animate__animated animate__fadeInUp animate__faster">
                <div class="col-12 title">
                    <h1>Agregar productos</h1>
                </div>
            </div><br>
            <form method="post" id='agregarProducto-form'>
                <!-- Inicio del contenido-->
                <div class="row animate__animated animate__fadeInUp animate__faster">
                    <!-- Columna de la información del producto-->
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <p class="apartado">Información del producto:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <div class="row">
                            <!-- Columna 1 de la información del producto-->
                            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 formulario">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" Required>
                                    </div><br>
                                    <div class="mb-3 foto">
                                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <div class="bordeDivFotografia">
                                                    <div class="divFotografia" id="divFoto">

                                                    </div>
                                                </div>
                                                <div id="btnAgregarFoto" class="mt-4">
                                                    <button class="btn btn-outline-dark" id="botonFoto"><span class="fas fa-plus"></span></button>
                                                </div>
                                                <div class="mt-4"> 
                                                    <button class="btn btn-outline-dark" id="#"><span class="fas fa-images me-2"></span>Album de Fotos</button>
                                                </div>
                                                <input id="archivo_producto" type="file" class="d-none" name="archivo_producto" accept=".gif, .jpg, .png">
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="cbMarca" class="form-label">Marca:</label>
                                        <select id="cbMarca" name="cbMarca" class="form-select" aria-label="Default select example" Required>
                                        </select>
                                    </div>
                            </div>
                            <!-- Columna 2 de la información del producto-->
                            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 formulario">
                                <div class="mb-3">
                                    <label for="Descripciónn" class="form-label">Descripción:</label>
                                    <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" Required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="cbSubcategoria" class="form-label">Tipo de producto:</label>
                                    <select id="cbSubcategoria" name="cbSubcategoria" class="form-select" aria-label="Default select example">
                                    </select>
                                </div>
                                <label for="precio" class="form-label">Precio:</label><br>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input type="text" class="form-control" placeholder="0.00" id="txtPrecio" name="txtPrecio" Required></div><br>
                                <div class="row">
                                    <!-- Columna de opciones -->
                                    <div class="col-12">
                                        <p class="apartado1">Opciones:</p>
                                        <img src="../../resources/img/dashboard_img/separator.png"
                                            class="img-fluid imagenSeparator1">
                                        <!-- Botones -->
                                        <div class="col-12 formulario1">
                                            <div class="mb-3">
                                                <label for="selecciona" class="form-label">Selecciona:</label><br>
                                                <button type="submit" class="btn btn-outline-dark active" id="selecciona">Agregar</button>
                                                <button class="btn btn-outline-dark " id="limpiar">Limpiar campos</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- Bootstrap core JavaScript -->
<?php
    //Se imprime el script para las direcciones de Bootstrap core JavaScript
    dashboard_Page::scriptBTJS();
    ?>

<!-- Movimiento sidebar -->
<?php
    //Se imprime el script para el movimiento del sidebar
    dashboard_Page::sidebarTemplateMovement('agregar_productos.js');
    ?>