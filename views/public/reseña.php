<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador');
?>
<link rel="stylesheet" type="text/css" href="../../resources/css/reseña_publico.css">
<section>
    <div class="container-fluid" style="background-color: #22242C;">
        <div class="row">
            <h1 class="titulos2" id="parrafo" style="background-color: #22242C;">
                <spanstyle="font-weight:bolder">Escribe tu reseña</span>
            </h1>
            <center>
                <div class="form col-md-6">
                    <input type="" class="form-control" placeholder="Escribe aqui:">
                    <h4>Valora tu experiencia</h4>
                    <h1 class="titulos2" id="parrafo" style="background-color: #22242C;">
                        <spanstyle="font-weight:bolder">Valora tu experiencia con nosotros</span>
                    </h1>
                    <div class="valoracion">
                        <input id="radio1" type="radio" name="estrellas" value="5">
                        <label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4">
                        <label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3">
                        <label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2">
                        <label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1">
                        <label for="radio5">★</label>
                    </div>
                    <button class="btn btn-outline-light centrarImagenes2" style="margin-top:40px;">Enviar Reseña</button><br><br>
                </div>
            </center>
        </div>
    </div>
</section>
<div class="media">
    <div class="media-body">


    </div>


</div>


<?php
public_Page::footerTemplate();
?>