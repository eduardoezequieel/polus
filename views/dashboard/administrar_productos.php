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
                    <h1>Administrar productos</h1>
                </div>
            </div><br>
            <!-- Espacio para buscar -->
            <div class="row animate__animated animate__fadeInUp animate__faster">
                <div class="col-lg-8 formulario2" >
                    <form class="d-flex" id="search-form">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" id="search" name="search">
                        <button class="btn btn-outline-dark" type="submit">Buscar</button>
                    </form>
                </div>
            </div><br><br>
            <!-- Fila de la tabla -->
            <div class="row animate__animated animate__fadeInUp animate__faster table-responsive-lg">
                <div class="col-12">
                    <table class="table">
                        <thead class="bg-dark tabla">
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Tipo de producto</th>
                                <th scope="col">Marca</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-rows">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fin de la tabla -->
            <!-- Modal para Administrar Productos -->
            <div class="modal fade" id="administrarProductos" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollablemodal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>Administrar Productos</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn fas fa-times" data-bs-dismiss="modal" aria-label="">

                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">

                            <form method="post" id='administrarProducto-form'>
                                <!-- Inicio del contenido-->
                                <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                                <input class="visually-hidden" type="number" id="idProducto" name="idProducto">
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
                                                        <img src="../../resources/img/dashboard_img/imagen.png"
                                                            class="img-fluid imagenUsuario1">
                                                        <input id="archivo_producto" type="file" name="archivo_producto" accept=".gif, .jpg, .png">
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
                                                                <button type="submit" class="btn btn-outline-dark active" id="selecciona">Actualizar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
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
    dashboard_Page::sidebarTemplateMovement('administrar_productos.js');
    ?>