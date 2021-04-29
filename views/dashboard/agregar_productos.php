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
            <!-- Inicio del contenido-->
            <div class="row animate__animated animate__fadeInUp animate__faster">
                <!-- Columna de la información del producto-->
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <p class="apartado">Información del producto:</p>
                    <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                    <div class="row">
                        <!-- Columna 1 de la información del producto-->
                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 formulario">
                            <form>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div><br>
                                <div class="mb-3 foto">
                                    <img src="../../resources/img/dashboard_img/imagen.png"
                                        class="img-fluid imagenUsuario1">
                                    <button class="btn btn-outline-dark" id="agregarFoto">Agregar foto</button>
                                </div><br>
                                <div class="mb-3">
                                    <label class="form-label">Género:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Dama</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Caballero</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Columna 2 de la información del producto-->
                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 formulario">
                            <div class="mb-3">
                                <label for="Descripciónn" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="Descripción"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cbProducto" class="form-label">Tipos de producto:</label>
                                <select id="cbProducto" class="form-select" aria-label="Default select example">
                                    <option selected>Seleccionar...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <label for="precio" class="form-label">Precio:</label><br>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="text" class="form-control" placeholder="0.00"></div><br>
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
                                            <button class="btn btn-outline-dark active" id="selecciona">Agregar</button>
                                            <button class="btn btn-outline-dark" id="selecciona">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    dashboard_Page::sidebarTemplateMovement();
    ?>
</body>

</html>