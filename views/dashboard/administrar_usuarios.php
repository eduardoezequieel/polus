<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('usuarios_privado_estilos.css', 'Polus - Dashboard');
?>
    <!--Fin del sidebar-->
    <!-- Contenido de la Pagina -->
    <div id="page-content-wrapper">
        <!-- Contenedor de la barra inicial -->
        <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
        <!-- Inicio del contenido -->
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 title"><h1>Administrar usuarios</h1></div>
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
                <!-- Fila de primeros tres apartados -->
                <div class="row">
                    <!-- Columna de información personal -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Información personal:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
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
                                        <label for="Fecha de nacimiento" class="form-label">Fecha de nacimiento:</label>
                                        <input type="text" class="form-control" id="Fecha de nacimiento" placeholder="dd-mm-aaaa">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Género:</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Femenino</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><br>
                    <!-- Columna de cuenta -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Cuenta:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <div class="row">
                            <!-- Formulario de cuenta -->
                            <div class="col-12 formulario">
                                <form>
                                    <div class="mb-3">
                                        <label for="Correo" class="form-label">Correo:</label>
                                        <input type="email" class="form-control" id="Correo" aria-describedby="emailHelp" placeholder="ejemplo@mail.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Usuario" class="form-label">Usuario:</label>
                                        <input type="text" class="form-control" id="Usuario">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Tipo de usuario" class="form-label">Tipo de usuario:</label>
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                                                Tipos de usuario
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Administrador</a></li>
                                                <li><a class="dropdown-item" href="#">Empleado</a></li>
                                                <li><a class="dropdown-item" href="#">Repartidor</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Columna de foto -->
                    <div class="col-lg-4 foto">
                        <img src="../../resources/img/dashboard_img/user.png" class="img-fluid imagenUsuario1">
                        <button class="btn btn-outline-dark" id="agregarFoto">Agregar foto</button>
                    </div>
                </div><br><br>
                <!-- Fila de ultimos dos apartados -->
                <div class="row">
                    <!-- Columna de contacto -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Contacto:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                            <div class="row">
                                <!-- Formulario de contacto -->
                                <div class="col-12 formulario">
                                    <form>
                                        <div class="mb-3">
                                            <label for="Teléfono" class="form-label">Teléfono:</label>
                                            <input type="text" class="form-control" id="Teléfono" placeholder="0000-0000">
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
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <!-- Botones -->
                        <div class="col-12 formulario1">
                            <div class="mb-3">
                                <label for="selecciona" class="form-label">Selecciona:</label><br>
                                <button class="btn btn-outline-dark" id="selecciona">Actualizar</button>
                                <button class="btn btn-outline-dark" id="selecciona">Suspender</button><br><br>
                                <button class="btn btn-outline-dark" id="selecciona">Activar</button>
                                <button class="btn btn-outline-dark" id="selecciona">Reiniciar cuenta</button>
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <!-- Fila de la tabla -->
                <div class="row">
                    <!-- Columnas de tabla de datos -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Tabla de datos:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                    </div>
                    <div class="col-12">
                        <table class="table table-hover table-responsive-lg">
                            <thead class="bg-dark tabla">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Género</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Tipo de usuario</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Nacimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Katherine Andrea</td>
                                    <td>González Salinas</td>
                                    <td>Femenino</td>
                                    <td>katy06salinas@gmail.com</td>
                                    <td>kath34</td>
                                    <td>Administrador</td>
                                    <td>7173-7109</td>
                                    <td>San Salvador</td>
                                    <td>03-02-2002</td>
                                </tr>
                                    <td>Eduardo Ezequiel</td>
                                    <td>López Rivera</td>
                                    <td>Masculino</td>
                                    <td>eduardoxlr@gmail.com</td>
                                    <td>eduardxlr</td>
                                    <td>Empleado</td>
                                    <td>7543-0245</td>
                                    <td>San Salvador</td>
                                    <td>17-04-2002</td>
                                </tr>
                                <tr>
                                    <td>Eduardo Antonio</td>
                                    <td>Magaña Hernandez</td>
                                    <td>masculino</td>
                                    <td>magaña@gmail.com</td>
                                    <td>emagaña</td>
                                    <td>Repartidor</td>
                                    <td>8042-1840</td>
                                    <td>San Salvador</td>
                                    <td>12-12-2003</td>
                                </tr>
                            </tbody>
                        </table> 
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

