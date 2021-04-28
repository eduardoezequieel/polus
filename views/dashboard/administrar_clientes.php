<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','usuarios_privado_estilos.css');
?>
    <!--Fin del sidebar-->
    <!-- Contenido de la Pagina -->
    <div class="page-content p-5" id="content">
        <!-- Contenedor de la barra inicial -->
        <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
        <!-- Inicio del contenido -->
        <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 title">
                    <h1>Administrar clientes</h1>
                </div>
            </div><br>
            <!-- Espacio para buscar -->
            <div class="row">
                <div class="col-lg-8 formulario2">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Buscar</button>
                    </form>
                </div>
            </div><br><br>
            <!-- Fila de la tabla -->
            <div class="row table-responsive">
                <!-- Columnas de tabla de datos -->
                <div class="col-12">
                    <table class="table">
                        <thead class="bg-dark tabla">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Samuel Eduardo</td>
                                <td>Magaña Martínez</td>
                                <td>samu17martinezz@gmail.com</td>
                                <td>samuelmtz5</td>
                                <th scope="row">
                                    <div class="row justify-c">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarClientes" class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1"> </h1>

                                            <a href="#" data--bs-toggle="modal" data-bs-target="#administrarClientes" class="btn btn-outline-danger"><i
                                                    class="fas fa-trash-alt tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            

            <!-- Modal para Administrar Clientes -->
            <div class="modal fade" id="administrarClientes" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>Administrar Clientes</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">

                            <!-- Fila de primeros tres apartados -->
                            <div class="row">
                                <!-- Columna de información personal -->
                                <div class="col-lg-4 col-sm-12 col-xs-12">
                                    <p class="apartado">Información personal:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <div class="row">
                                        <!-- Formulario del información personal -->
                                        <div class="col-12 formulario">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre:</label>
                                                    <input type="text" class="form-control" id="nombre">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Apellido" class="form-label">Apellido:</label>
                                                    <input type="text" class="form-control" id="Apellido">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Fecha de nacimiento" class="form-label">Fecha de
                                                        nacimiento:</label>
                                                    <input type="text" class="form-control" id="Fecha de nacimiento"
                                                        placeholder="dd-mm-aaaa">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Género:</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label"
                                                            for="inlineRadio1">Femenino</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">Masculino</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><br>
                                <!-- Columna de cuenta -->
                                <div class="col-lg-4 col-sm-12 col-xs-12">
                                    <p class="apartado">Cuenta:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <div class="row">
                                        <!-- Formulario de cuenta -->
                                        <div class="col-12 formulario">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="Correo" class="form-label">Correo:</label>
                                                    <input type="email" class="form-control" id="Correo"
                                                        aria-describedby="emailHelp" placeholder="ejemplo@mail.com">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Usuario" class="form-label">Usuario:</label>
                                                    <input type="text" class="form-control" id="Usuario">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Columna de foto -->
                                <div class="col-lg-4 foto">
                                    <img src="../../resources/img/dashboard_img/user.png"
                                        class="img-fluid imagenUsuario1">
                                    <button class="btn btn-outline-dark" id="agregarFoto">Agregar foto</button>
                                </div>
                            </div><br><br>
                            <!-- Fila de ultimos dos apartados -->
                            <div class="row">
                                <!-- Columna de contacto -->
                                <div class="col-lg-4 col-sm-12 col-xs-12">
                                    <p class="apartado">Contacto:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <div class="row">
                                        <!-- Formulario de contacto -->
                                        <div class="col-12 formulario">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="Teléfono" class="form-label">Teléfono:</label>
                                                    <input type="text" class="form-control" id="Teléfono"
                                                        placeholder="0000-0000">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Dirección" class="form-label">Dirección:</label>
                                                    <textarea class="form-control" id="direccion"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><br>
                                <!-- Columna de opciones -->
                                <div class="col-lg-4 col-sm-12 col-xs-12">
                                    <p class="apartado">Opciones:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <!-- Botones -->
                                    <div class="col-12 formulario1">
                                        <div class="mb-3">
                                            <label for="selecciona" class="form-label">Selecciona:</label><br>
                                            <button class="btn btn-outline-dark" id="selecciona">Actualizar</button>
                                            <button class="btn btn-outline-dark"
                                                id="selecciona">Suspender</button><br><br>
                                            <button class="btn btn-outline-dark" id="selecciona">Activar</button>
                                            <button class="btn btn-outline-dark" id="selecciona">Reiniciar
                                                cuenta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
            <br><br>

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

