<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador');
?>

<link rel="stylesheet" type="text/css" href="../../resources/css/carrito_publico.css">

</head>
<body style="background-color: #22242C;">

<h1 class="titulos2" style="text-align: center;">Tu <span style="color: #605AC3;"><b>carrito</b></span></h1>

	<div class="container"style="background-color: #22242C;">

		
		<div class="main-bar">
			<div class="product">
                <h3 class="titulos2">Producto</h3>
			</div>
			<div class="quantity">
            <h3 class="titulos2">Cantidad</h3>
			</div>
			<div class="price">
            <h3 class="titulos2">Precio</h3>
			</div>
			<div class="clear"></div>
		</div>
		

		
		<div class="items">
			<div class="item1">
				<div class="close1">
					<div class="image1">
						<img src="images/item1.png" alt="imagen">
					</div>
					<div class="title1">
						<p><font face="calibri" color="black">Camisa Basica</font></p>
					</div>
					<div class="quantity1">
						<form action="action_page.php">
							<input type="number" name="quantity" min="1" max="10" value="1">
						</form>
					</div>
					<div class="price1">
						<p><font face="calibri">$15</font></p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="total">
			<div class="total1"><font face="calibri" color="white">Total</font></div>
			<div class="total2"><font face="calibri" color="white">$20</font></div>
			<div class="clear"></div>
		</div>
		<div class="checkout">
			<div class="discount">
				<span><font face="calibri">Aplica un codigo de descuento</font></span> <input type="text">
                
			</div>
			<div class="checkout-btn">
				<a href="#"><font face="calibri">Pagar</font></a>
			</div>
			<div class="clear"></div>
		</div>
	</div>

<?php
public_Page::footerTemplate();
?>