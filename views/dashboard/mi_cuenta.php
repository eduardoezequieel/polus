<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Mi Cuenta',' ');
?>
    <!--Fin del sidebar-->
    <!-- Contenido de la Pagina -->
    <div class="page-content p-5" id="content">
      <!-- Contenedor de la barra inicial -->
      <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
       <!-- Contenido -->

       <div class="row mt-3">
            <div class="col-12">
                <h1 class="tituloMiCuenta animate__animated animate__fadeInUp animate__faster">INFORMACIÓN PERSONAL</h1>
            </div>
       </div>

        <div class="row mt-3 justify-content-center animate__animated animate__fadeInUp animate__faster">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                <div class="divFotografia">
                    <img src="../../resources/img/94727019_1061011630965244_4502845736055996416_o.jpg" alt="" class="img-fluid rounded-circle">
                </div>
                <form>
                    <button class="btn btn-outline-dark mt-3"><span class="fas fa-plus"></span></button>
                </form>
            </div>
        </div>

        <div class="row justify-content-end mt-4 animate__animated animate__fadeInUp animate__faster">
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-end align-items-right centrarContenido">
                <form>
                    <label for="nombre" class="form-label mt-2">Nombres:</label>
                    <input type="text" class="form-control inputMiCuenta" id="nombre">

                    <label for="telefono" class="form-label mt-2">Teléfono:</label>
                    <input type="text" class="form-control inputMiCuenta" id="telefono">

                    <label for="fechaNacimiento" class="form-label mt-2">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control inputMiCuenta" id="fechaNacimiento">

                    <div class="mt-2">
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
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-start align-items-left centrarContenido">
                <form>
                    <label for="apellido" class="form-label mt-2">Apellidos:</label>
                    <input type="text" class="form-control inputMiCuenta" id="apellido">

                    <label for="Dirección" class="form-label mt-2">Dirección:</label>
                    <textarea class="form-control textareaMiCuenta" id="direccion"></textarea>
                    
                </form>
            </div>
        </div>

        <div class="row justify-content-center mt-4 animate__animated animate__fadeInUp animate__faster">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <button class="btn btn-outline-dark">Confirmar</button>
            </div>
        </div>

        <div class="row mt-5 animate__animated animate__fadeInUp animate__faster">
            <div class="col-12">
                <h1 class="tituloMiCuenta">AJUSTES DE LA CUENTA</h1>
            </div>
       </div>
        <div class="row justify-content-end mt-4 animate__animated animate__fadeInUp animate__faster">
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-end align-items-right centrarContenido">
                <form>
                    <label for="nombre" class="form-label mt-2">Usuario:</label>
                    <input type="text" class="form-control inputMiCuenta" id="nombre" readonly>
                </form>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-start align-items-left centrarContenido">
                <form>
                    <label for="telefono" class="form-label mt-2">Correo Electrónico:</label>
                    <input type="text" class="form-control inputMiCuenta" id="telefono" readonly>
                </form>
            </div>
        </div>

        <div class="row justify-content-center animate__animated animate__fadeInUp animate__faster">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <form>
                    <label for="apellido" class="form-label mt-2">Contraseña:</label>
                    <input type="password" class="form-control inputMiCuenta" id="apellido" readonly>
                </form>
            </div>
        </div>

        <div class="row justify-content-center mt-4 animate__animated animate__fadeInUp animate__faster">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <button class="btn btn-outline-dark">Actualizar Ajustes</button>
            </div>
        </div>
       <!-- Final del contenido -->
       
        
    </div>
    <!-- Bootstrap core JavaScript -->
    <?php
    //Se imprime el script para las direcciones de Bootstrap core JavaScript
    dashboard_Page::scriptBTJS();
    ?>

    <!-- Movimiento sidebar -->
    <?php
    //Se imprime el script para el movimiento del sidebar
    dashboard_Page::sidebarTemplateMovement('mi_cuenta.js');
    ?>