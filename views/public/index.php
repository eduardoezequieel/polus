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
      <div class="row">
        <div class="col-6" id="title">
          <h1 class="titulos">Nunca es<br>suficiente ropa</h1>
          <button class="boton mt-4"><i class="fas fa-shopping-cart" id="carrito"></i>Comprar Productos</button>
        </div>

        <div class="col-6" id="imagen">
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
        <div class="col-6">
          <h1 class="titulos2" id="parrafo" style="background-color: #22242C;"><spanstyle="font-weight:bolder">Misión</span></h1>
          <p class="parrafo" style="text-align: justify;">Lorem, ipsum dolor
          sit amet consectetur adipisicing elit. Voluptatem architecto facilis est explicabo suscipit dolorem dolores
          autem delectus rem reprehenderit modi quaerat, expedita ut ipsum illo vitae neque id similique!</p>
          <img src="../../resources/img/development.png" class="img-fluid centrarImagenes" style="width: 300px; height: 300px; margin-top: 100px; margin-bottom: 100px;">
        </div>

        <div class="col-6">
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

    <div class="container-fluid">
      <div class="row">
        <div class="col-3">

        </div>
        <div class="col-6">

        </div>
        <div class="col-3">

        </div>
      </div>
    </div>
  </section>

  <!--Inicio de Categoria-->
  <section>
    <div class="container-fluid" id="catalogo">
      <div class="row">
        <h1 class="titulos2" style="text-align: center;">Mira lo que tenemos para ofrecerte</h1>
        <p class="parrafo" style="text-align: center;"> Increibles productos para ti </p>
      </div>
      <div id="info" class="row seccion">

        <div class="col-xl-4 col-lg-6 col-md-12 article1">
          
          <div class="card border-secondary" >					
            <div class="card-body" style="background-color: #22242C;">
              <h3 class="card-title text-center " style="color: aliceblue;">
                Sueteres
              </h3>
              <center>
                <img id="productos" src="../../resources/img/hoodie.png" width="175" height="175">
              </center> 
              <center><button class="btn btn-outline-light"">Ver más</button></center>
            </div>
          </div>
        </div>
        <br>
        <div class="col-xl-4 col-lg-6 col-md-12 article3">
          <div class="card border-secondary mb-3">
            <div class="card-body"style="background-color: #22242C;">
              <h3 class="card-title text-center">
                Camisetas
              </h3>
              <center>
                <img id="productos" src="../../resources/img/camisaroja.png" width="175" height="175">
              </center>
              <center><button class="btn btn-outline-light"">Ver más</button></center>
            </div>
          </div>		
        </div>
        <br>
        <div class="col-xl-4 col-lg-6 col-md-12 article3">
          <div class="card border-secondary mb-3">
            <div class="card-body" style="background-color: #22242C;">
              <h3 class="card-title text-center">
                Mascarillas
              </h3>
              <center>
                <img id="productos" src="../../resources/img/mascarilla.png" width="175" height="175">
              </center>
              <center><button class="btn btn-outline-light"">Ver más</button></center>
            </div>
          </div>		
        </div>
      </div>
    </div>
    
  </section>
  <!--Fin de Categoria-->

  <section>
    <div class="container-fluid" id="acercaNosotros">
      <div class="row">
        <h1 class="titulos2" style="text-align: center;">Somos tu mejor <b>opción</b>.</h1>
        <p class="parrafo">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, hic rerum unde vitae, maxime nam, iure obcaecati aliquam ipsa ex excepturi. Dolores dolorem expedita reiciendis nesciunt ipsum tenetur sunt atque?</p>
      </div>
    </div>
  </section>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>

  <!-- IONICONS -->
  <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</body>

</html>