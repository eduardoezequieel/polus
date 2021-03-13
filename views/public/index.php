<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/publicPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador');
?>
<!--Fin del navbar-->
<!--Inicio del Contenedor Principal-->
  <div class="container" id="contenedorPrincipal">
    <header>
      <div class="row" id="fila">
        <div class="col-lg-6" id="title">
          <h1 class="titulos">Nunca es<br><span style="color: #605AC3;"><b>suficiente</b></span> ropa.</h1>
          <button class="boton mt-4"><i class="fas fa-shopping-cart" id="carrito"></i>Comprar Productos</button>
        </div>

        <div class="col-lg-6" id="imagen">
          <img src="../../resources/img/polus iconos.png" class="img-fluid">
        </div>
      </div>
    </header>
  </div>
<!--Fin del Contenedor Principal-->

<!--Descripcion 1 inicio-->
  <section>
    <div class="container-fluid" style="background-color: #22242C;">
      <div class="row">
          <h1 class="titulos2" id="parrafo" style="background-color: #22242C;"><spanstyle="font-weight:bolder">Acerca de Nosotros</span></h1>
          <p class="parrafo" style="text-align: justify; margin-bottom: 50px;">Lorem, ipsum dolor
          sit amet consectetur adipisicing elit. Voluptatem architecto facilis est explicabo suscipit dolorem dolores
          autem delectus rem reprehenderit modi quaerat, expedita ut ipsum illo vitae neque id similique!</p>    
          <img src="../../resources/img/quienessomos.PNG" class="img-fluid centrarImagenes" style="width: 330px; height: 300px;">
      </div>

      <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <h1 class="titulos2" id="parrafo" style="background-color: #22242C;"><spanstyle="font-weight:bolder">Misión</span></h1>
          <p class="parrafo" style="text-align: justify;">Lorem, ipsum dolor
          sit amet consectetur adipisicing elit. Voluptatem architecto facilis est explicabo suscipit dolorem dolores
          autem delectus rem reprehenderit modi quaerat, expedita ut ipsum illo vitae neque id similique!</p>
          <img src="../../resources/img/development.png" class="img-fluid centrarImagenes" style="width: 300px; height: 300px; margin-top: 100px; margin-bottom: 100px;">
        </div>

        <div class=" col-lg-6 col-sm-12 col-xs-12">
          <h1 class="titulos2" id="parrafo" style="background-color: #22242C;"><spanstyle="font-weight:bolder">Visión</span></h1>
          <p class="parrafo" style="text-align: justify;">Lorem, ipsum dolor
          sit amet consectetur adipisicing elit. Voluptatem architecto facilis est explicabo suscipit dolorem dolores
          autem delectus rem reprehenderit modi quaerat, expedita ut ipsum illo vitae neque id similique!</p>
          <img src="../../resources/img/vision.PNG" class="img-fluid centrarImagenes" style="width: 300px; height: 300px; margin-top: 100px;">
        </div>
      </div>
    </div>

    <div class="container-fluid pt-3">
      <div class="row">
        <div class="col-md-6">
          <div class="contenedor">
            <div class="detalle">

            </div>
            <img src="../../resources/img/modelo1.png" class="img-fluid" alt="" width="">
          </div>
        </div>

        <div class="col-md-6">
          <div class="contenedor">
            <div class="detalle">

            </div>
            <img src="../../resources/img/modelo2.png" class="img-fluid mb-1" alt="" width="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Inicio de Categoria-->
  <section>

    <div class="container-fluid" id="contenedorCategorias"style="background-color: #22242C;">
      <div class="row" id="categoria">
        <h1 class="titulos2" style="text-align: center;">Mira lo que tenemos <span style="color: #605AC3;"><b>para</b></span> ofrecerte.</h1>
        <p class="parrafo mb-5 mt-5" style="text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi qui, tempora consectetur eum, quia nisi quidem ratione veniam incidunt quam earum iusto eos quisquam saepe autem non voluptatibus ducimus quae.</p>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <p class="titulos3" style="text-align: center;">Ropa</p>
          <img src="../../resources/img/clothes.png" style="width: 250px; margin-top: 50px;" class="img-fluid centrarImagenes2">
          <button class="btn btn-outline-light centrarImagenes2" style="margin-top:40px;">Ver más</button><br><br><br>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <p class="titulos3" style="text-align: center;">Cuidado facial</p>
          <img src="../../resources/img/skincare.png" style="width: 290px; margin-top:40px;" class="img-fluid centrarImagenes2">
          <button class="btn btn-outline-light centrarImagenes2" style="margin-top:40px;">Ver más</button><br><br>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <p class="titulos3" style="text-align: center;">Cosméticos</p>
          <img src="../../resources/img/cosmetics.png" style="width: 295px; margin-top:40px;" class="img-fluid centrarImagenes2">
          <button class="btn btn-outline-light centrarImagenes2" style="margin-top:40px;">Ver más</button><br><br><br>
        </div>
      </div>
    </div>
  </section>
  <!--Fin de Categoria-->

  <section>
    <div class="container" style="margin-bottom:30px;">
      <div class="row" >
        <h1 class="titulos2" style="text-align: center; margin-top:100px; margin-bottom:50px; padding-left:50px;">¿Tienes algún <span style="color: #605AC3;"><b>problema?</b></span> Podemos ayudarte.</h1>
        <div class="col-lg-8 col-xs-12">
          <p class="parrafo2" style="margin-top:100px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam necessitatibus, aspernatur, quia amet blanditiis, consectetur nostrum corrupti officia deserunt velit libero sed sint temporibus autem facilis reiciendis fugiat itaque! Labore.</p>
        </div>
        <div class="col-lg-4 col-xs-12">
          <img src="../../resources/img/mails.png" alt="" class="img-fluid centrarImagenes2 mt-5" style="width:200px;">
          <!-- Button trigger modal -->
          <button type="button" style="margin:auto; display:block; margin-top:30px" class="boton2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Contáctanos
          </button>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Contáctanos</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form>
                    <label>Usuario:</label><br>
                    <input type="text"><br><br>
                    <label">Mensaje:</label><br>
                    <textarea rows="4" cols="45"></textarea>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-outline-light">Enviar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <p style="text-align: center; margin-top:100px;">¿No has podido solucionar tu problema? Puedes contactarnos en nuestras redes sociales: </p>
    </div>
  </section>

<?php
public_Page::footerTemplate();
?>
