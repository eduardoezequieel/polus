<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador');
?>
<link rel="stylesheet" href="../../resources/css/pago_publico.css">
<div id="background">
      <div id="form">
      <h1 class="titulo">Confirma tu compra</h1>
        <p class="texto mt-3">Verifica que tu información sea la correcta:</p>
        <div id="background">
        <p class="">Tipo de envio: domicilio</p> 
        <p class="">Dirección de envio: Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi incidunt vel rerum natus quo iusto odit dignissimos pariatur amet est! Tempore quas quod consequatur nam corporis suscipit quo animi asperiores!</p>
        <button type="button" class="btn btn-outline-light">Editar Datos</button>    
        </div>
        <br>
        <div id="background">
        <p class="">Datos del usuarios </p> 
        <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias laborum voluptate esse molestias maiores officia debitis magni doloribus. Assumenda culpa sequi sed corrupti iure consectetur numquam perferendis natus quas modi. </p>
        <button type="button" class="btn btn-outline-light">Editar Datos</button>  
        </div>
        <div class="row justify-content-center mt-4">
            
          <div class="col-6 minimizarDiv">
            <a href="" class="btn boton">Confirmar Compra</a>
          </div>
        </div>
      </div>
</div>