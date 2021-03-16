<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador','producto_estilos.css');
?>

<!--Inicio del Contenedor Principal-->
<section>
    <div class="container-fluid">
        <div class="row">
            <!--Imagen-->
            <div class="col-6" id="columnaImagen">

            </div>
            <!--Información-->
            <div class="col-6" id="columnaInformacion">
                <h1 class="titulos">Short 100% Algodon</h1>
                <p class="parrafo">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia sequi quod et ducimus repellat, earum ad unde doloremque veritatis reprehenderit molestias ea incidunt perferendis a dignissimos eveniet suscipit vel. Eveniet!</p>
            </div>
        </div>
    </div>
</section>

<?php
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::footerTemplate();
?>