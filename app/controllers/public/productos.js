// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = '../../app/api/public/productos.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const id = params.get('id');
    const name = params.get('name');
    console.log(id);
    // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    readProducts(id, name);
});

// Función para obtener y mostrar los productos de acuerdo a la categoría seleccionada.
function readProducts(id, name) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idCategoria', id);

    fetch(API_CATALOGO + 'readAll', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    console.log(response.dataset);
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se crean y concatenan las tarjetas con los datos de cada producto.
                        url = `producto.php?id=${row.idproducto}`;

                        content += `
                        <div class="dropdown dropend col-xl-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center animate__animated animate__bounceIn">
                            <button class="btn btnCategoria" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="divFotoproducto">
                                    <img src="../../resources/img/dashboard_img/producto_fotos/${row.imagenprincipal}" alt="#" class="encajarImagen" height="150px" width="200px">
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-7 d-flex justify-content-center">
                                        <h1 class="tituloProducto">${row.nombre}</h1>  
                                    </div>
                                    <div class="col-5">
                                        <h1 class="textoPrecio">$${row.precio}</h1>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__bounceIn mx-5" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
                                <li><a class="dropdown-item" href="${url}"><span class="fas fa-info-circle me-2"></span>Ver detalles</a></li>
                            </ul>
                        </div>
                        `;
                    });
                    // Se asigna como título la categoría de los productos.
                    //document.getElementById('title').textContent = 'Categoría: ' + categoria;
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar los productos.
                    document.getElementById('products-body').innerHTML = content;

                    document.getElementById('titulo').textContent = name;
                   
                } else {
                    // Se presenta un mensaje de error cuando no existen datos para mostrar.
                    //document.getElementById('title').innerHTML = `<i class="material-icons small">cloud_off</i><span class="red-text">${response.exception}</span>`;
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}