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
            <div class="row animate__animated animate__fadeInUp animate__faster">
                <div class="col-lg-12 title">
                    <h1>Agregar usuarios</h1>
                </div>
            </div><br>
            <form method='post' id='agregarUsuario-form' enctype="multipart/form-data">
                <!-- Fila de primeros tres apartados -->
                <div class="row justify-content-center animate__animated animate__fadeInUp animate__faster">
                    <!-- Columna de información personal -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">

                        <div class="row">
                            <!-- Formulario del información personao -->
                            <div class="col-12 formulario">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" Required>
                                </div>
                                <div class="mb-3">
                                    <label for="Apellido" class="form-label">Apellido:</label>
                                    <input type="text" class="form-control" id="txtApellidos" name="txtApellidos"
                                        Required>
                                </div>
                                <div class="mb-3">
                                    <label for="Fecha de nacimiento" class="form-label">Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" id="txtFechaNacimiento"
                                        name="txtFechaNacimiento" placeholder="dd/mm/aaaa" Required>
                                </div>

                                <div class="mb-3">
                                    <label for="Teléfono" class="form-label">Teléfono:</label>
                                    <input type="text" class="form-control" id="txtTelefono" name="txtTelefono"
                                        placeholder="0000-0000" Required>
                                </div>
                                <div class="mb-3">
                                    <label for="Dirección" class="form-label">Dirección:</label>
                                    <textarea class="form-control" id="txtDireccion" name="txtDireccion"
                                        Required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="txtGenero" class="form-label">Género:</label>
                                    <select id="txtGenero" name="txtGenero" class="form-select"
                                        aria-label="Default select example" Required>
                                        <option selected>Seleccionar...</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Masculino">Masculino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!-- Columna de cuenta -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">

                        <div class="row">
                            <!-- Formulario de cuenta -->
                            <div class="col-12 formulario">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="bordeDivFotografia">
                                        <div class="divFotografia" id="divFoto">

                                        </div>
                                    </div>
                                    <div id="btnAgregarFoto" class="mt-4">
                                        <button class="btn btn-outline-dark" id="botonFoto"><span
                                                class="fas fa-plus"></span></button>
                                    </div>
                                    <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario"
                                        accept=".gif, .jpg, .png">
                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="Correo" class="form-label">Correo:</label>
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                        aria-describedby="emailHelp" placeholder="ejemplo@mail.com" Required>
                                </div>
                                <div class="mb-3">
                                    <label for="Usuario" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" Required>
                                </div>
                                <div class="mb-3">
                                    <label for="cbTipoUsuario" class="form-label">Tipo de Usuario:</label>
                                    <select id="cbTipoUsuario" name="cbTipoUsuario" class="form-select"
                                        aria-label="Default select example">
                                    </select>
                                </div>
                                <div class="justify-content-center align-items-center d-flex mt-5">
                                    <button class="btn btn-dark float-center me-3" type='submit'
                                        id="selecciona">Agregar</button>
                                    <button class="btn btn-outline-dark " id="limpiar">Limpiar campos</button>
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
    dashboard_Page::sidebarTemplateMovement('agregar_usuarios.js');
?>
