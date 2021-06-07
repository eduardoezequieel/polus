// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = '../../app/api/public/productos.php?action=';
const ENDPOINT_SUBCATEGORIA = '../../app/api/public/productos.php?action=readSubcategorias';


// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    fillSelectProducts(ENDPOINT_SUBCATEGORIA, 'cbSubcategorias', null);
    
    readOrderDetail()
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const id = params.get('id');
    const name = params.get('name');

    if (id == 2 || id==3) {
        document.getElementById('search-talla').className='d-none'
    }else{
        
    }

   
    // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    readProducts(id, name);

});

document.getElementById('search-subcategoria').addEventListener('submit', function(event){
    event.preventDefault();
    searchProducts(API_CATALOGO, 'search-subcategoria','searchBySubcategory');
})

document.getElementById('search-form').addEventListener('submit', function(event){
    event.preventDefault();
    searchProducts(API_CATALOGO, 'search-form','search');
})

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
                    console.log(response.dataset);
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    fillProducts(response.dataset, name);
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

function searchProducts(api, form, action) {
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const id = params.get('id');
    const name = params.get('name');
    const data = new FormData(document.getElementById(form));
    data.append('idCategoria', id);
    fetch(api + action, {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillProducts(response.dataset, name)
                    sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(2, response.exception, null);
                    console.log("error");
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillSelectProducts(endpoint, select, selected) {
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const id = params.get('id');
    const data = new FormData();
    data.append('idCategoria', id);
    fetch(endpoint, {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let content = '';
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Si no existe un valor para seleccionar, se muestra una opción para indicarlo.
                    if (!selected) {
                        content += '<option disabled selected>Seleccione una opción</option>';
                    }
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se obtiene el dato del primer campo de la sentencia SQL (valor para cada opción).
                        value = Object.values(row)[0];
                        // Se obtiene el dato del segundo campo de la sentencia SQL (texto para cada opción).
                        text = Object.values(row)[1];
                        // Se verifica si el valor de la API es diferente al valor seleccionado para enlistar una opción, de lo contrario se establece la opción como seleccionada.
                        if (value != selected) {
                            content += `<option value="${value}">${text}</option>`;
                        } else {
                            content += `<option value="${value}" selected>${text}</option>`;
                        }
                    });
                } else {
                    content += '<option>No hay opciones disponibles</option>';
                }
                // Se agregan las opciones a la etiqueta select mediante su id.
                document.getElementById(select).innerHTML = content;
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillProducts(dataset, name){
    let content = '';
    dataset.map(function (row) {
        
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
                <li><a class="dropdown-item" href="#" onclick="openCantidadDialog(${row.idproducto})" data-bs-toggle="modal" data-bs-target="#cantidadModal"><span class="fas fa-cart-plus me-2"></span>Agregar al carrito</a></li>
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
}

function openCantidadDialog(id){
    console.log(id)

    document.getElementById('idProducto2').value = id;

}

document.getElementById('agregarCart').addEventListener('click', function(){
  //Obtener datos
  fetch(API_PEDIDO + 'checkStock',{
    method: 'post',
    body: new FormData(document.getElementById('cantidad-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    let data = []
                    data = response.dataset;
                    data.map(function (row){
                        console.log(row.resta)
                        if(row.resta < 1){
                            sweetAlert(3, 'No hay unidades suficientes en stock', null);
                        } else{
                            //Obtener datos
                            fetch(API_PEDIDO + 'createDetail',{
                                method: 'post',
                                body: new FormData(document.getElementById('cantidad-form'))
                                }).then(function(request){
                                    //Verificando si la petición fue correcta
                                    if(request.ok){
                                        request.json().then(function(response){
                                            //Verificando respuesta satisfactoria
                                            if(response.status){
                                                sweetAlert(1, response.message , null);
                                                readOrderDetail()
                                            } else{
                                                sweetAlert(4, response.exception, null);
                                            }
                                        })
                                    }else{
                                        console.log(request.status + ' ' + request.statusText);
                                    }
                                }).catch(function(error){
                                    console.log(error);
                                })
                        }
                    })
                    

                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        }else{
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    })
})