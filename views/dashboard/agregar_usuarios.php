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
                    <div class="col-lg-12 title"><h1>Agregar usuarios</h1></div>
                </div><br>
                <!-- Fila de primeros tres apartados -->
                <div class="row">
                    <!-- Columna de información personal -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Información personal:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <div class="row">
                            <!-- Formulario del información personao -->
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
                        <div class="col-12 formulario">
                            <div class="mb-3">
                                <label for="selecciona" class="form-label">Selecciona:</label><br>
                                <button class="btn btn-outline-dark active" id="selecciona">Agregar</button>
                                <button class="btn btn-outline-dark" id="selecciona">Cancelar</button>
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
