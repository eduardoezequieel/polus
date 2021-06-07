// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = '../../app/api/public/productos.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const id = params.get('id');    
    console.log(id);
    // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    readProduct(id);
});

function readProduct(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idProducto', id);

    fetch(API_CATALOGO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let foto = '';
                    console.log(response.dataset);
                    foto = `
                        <img src="../../resources/img/dashboard_img/producto_fotos/${response.dataset.imagenprincipal}" class="imagenProducto mt-4">
                        `;
                    document.getElementById('columnaImagen').innerHTML = foto;
                    document.getElementById('tituloProducto').textContent = response.dataset.nombre;
                    document.getElementById('descripcionProducto').textContent = response.dataset.descripcion;
                    document.getElementById('precioProducto').textContent = response.dataset.precio;

                   
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