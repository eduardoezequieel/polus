<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador','producto_estilos.css');
?>

<!--Inicio de X Producto-->
<section>
    <div class="container-fluid" id="XProducto">
        <div class="row animate__animated animate__fadeInDown">
            <!--Imagen-->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 " id="columnaImagen">
                <img src="../../resources/img/shortsprueba.png" alt="" class="img-fluid m-auto d-block redondearImagen mt-4" width="450px">
                
            </div>
            <!--Información-->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12" id="columnaInformacion">
                <h1 class="titulos">Short 100% Algodon</h1>
                <p class="parrafo">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia sequi quod et ducimus repellat, earum ad unde doloremque veritatis reprehenderit molestias ea incidunt perferendis a dignissimos eveniet suscipit vel. Eveniet!</p>
                <p class="estrellas">★★★★★<span class="reseña">441 reseñas.</span></p>
                <h1 class="precio">$9.99<span class="disponibilidad">Disponible</span></h1>
                <div class="row justify-content-center">
                    <div class="col-6 minimizarDiv">
                        <a href="pago.php" class="btn boton"><span class="fas fa-money-bill-alt p-2"></span>Comprar Ya</a>
                    </div>
                    <div class="col-6 minimizarDiv">
                        <a href="carrito.php" class="btn boton2"><span class="fas fa-cart-plus p-2"></span>Añadir al Carrito</a>
                    </div>
                </div>
            </div>
        </div>
        <!--Sugerencias-->
        <div class="row mt-5 pt-5">
            <h1 class="lead text-white text-center mb-5 pb-4">Tambien podrian gustarte:</h1>
            <div class="col-xl-2 col-md-2 col-sm-12 col-xs-12">
                <img src="../../resources/img/preview1.PNG" alt="" class="img-fluid m-auto d-block preview redondearImagen">
                <h1 class="titulos2">Shorts</h1>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12 col-xs-12">
                <img src="../../resources/img/preview2.PNG" alt="" class="img-fluid m-auto d-block preview redondearImagen">
                <h1 class="titulos2">Shorts</h1>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12 col-xs-12">
                <img src="../../resources/img/preview3.PNG" alt="" class="img-fluid m-auto d-block preview redondearImagen">
                <h1 class="titulos2">Shorts</h1>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12 col-xs-12">
                <img src="../../resources/img/preview4.PNG" alt="" class="img-fluid m-auto d-block preview redondearImagen">
                <h1 class="titulos2">Shorts</h1>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12 col-xs-12">
                <img src="../../resources/img/preview4.PNG" alt="" class="img-fluid m-auto d-block preview redondearImagen">
                <h1 class="titulos2">Shorts</h1>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12 col-xs-12">
                <img src="../../resources/img/preview4.PNG" alt="" class="img-fluid m-auto d-block preview redondearImagen">
                <h1 class="titulos2">Shorts</h1>
            </div>
        </div>
        
    </div>
</section>

<section>
    <div class="container my-5" id="comentario">
        <form>
            <div class="row">
                <h1 class="titulos">¿Qué te parece este producto?</h1>
                <h1 class="comentarioReseña text-white text-center mb-3">Puedes dejarnos un comentario acerca de tu opinión de este producto.</h1>
                <div class="col-12 justify-content-center">
                    <textarea class="form-control personalizacionPolus" rows="3" id="txtComentario"></textarea>
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <button class="btn btn-outline-light">Publicar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!--Reseñas-->
<section>
    <div class="container my-5" id="Reseñas">
        <div class="row mt-5">
            <!--Primera Columna-->
            <h1 class="titulos">Reseñas</h1>
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                
                <!--Reseña 1-->
                <div class="row pl-5 fondoComentario mx-1">
                    <div class="col-2">
                        <img src="../../resources/img/astronauta.PNG" alt="" class="img-fluid d-block m-auto">
                    </div>
                    <div class="col-10">
                        <h1 class="usuarioReseña text-white">Eduardo Rivera</h1>
                        <p class="comentarioReseña">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam cum commodi quo rem ducimus.</p>
                    </div>
                </div>

                <!--Reseña 2-->
                <div class="row pl-5 fondoComentario mx-1">
                    <div class="col-2">
                        <img src="../../resources/img/astronauta.PNG" alt="" class="img-fluid d-block m-auto">
                    </div>
                    <div class="col-10">
                        <h1 class="usuarioReseña text-white">Katherine González</h1>
                        <p class="comentarioReseña">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam cum commodi quo rem ducimus.</p>
                    </div>
                </div>

            </div>

            <!--Segunda Columna-->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                <!--Reseña 3-->
                <div class="row pl-5 fondoComentario mx-1">
                    <div class="col-2">
                        <img src="../../resources/img/astronauta.PNG" alt="" class="img-fluid d-block m-auto">
                    </div>
                    <div class="col-10">
                        <h1 class="usuarioReseña text-white">Samuel Magaña</h1>
                        <p class="comentarioReseña">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam cum commodi quo rem ducimus.</p>
                    </div>
                </div>

                <!--Reseña 4-->
                <div class="row pl-5 fondoComentario mx-1">
                    <div class="col-2">
                        <img src="../../resources/img/astronauta.PNG" alt="" class="img-fluid d-block m-auto">
                    </div>
                    <div class="col-10">
                        <h1 class="usuarioReseña text-white">Licenciado Jeffrey</h1>
                        <p class="comentarioReseña">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam cum commodi quo rem ducimus.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::footerTemplate();
?>