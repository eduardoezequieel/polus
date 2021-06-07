//Constante para la ruta de la API
const API_CATEGORIA = '../../app/api/public/categoria.php?action=';
const API_PEDIDO = '../../app/api/public/pedidos.php?action=';

//Cuando se carga la pagina web
document.addEventListener('DOMContentLoaded', function(){
    
});

document.getElementById('dropdownCategorias').addEventListener('click', function(){
    readCategoriesDropdown(API_CATEGORIA);
    console.log('hola')
})

//Funcion para el llenado de tablas.
function fillCategories(dataset){
    let content = ' ';

    dataset.map(function(row){
        url = `categoria.php?id=${row.idcategoria}&name=${row.categoria}`;

        content += `
        <li><a class="dropdown-item" href="${url}">${row.categoria}</a></li>
        `
    })

    document.getElementById('dropdownCategories-body').innerHTML = content;
}

function readCategoriesDropdown(api) {
    fetch(api + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                    console.log(data);
                    fillCategories(data);
                } else {
                    sweetAlert(4, response.exception, null);
                    console.log('hola')
                }
                // Se envían los datos a la función del controlador para que llenen las categorias en la vista.
                
                console.log(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para mostrar un mensaje de confirmación al momento de cerrar sesión.
function logOutCliente() {
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch('../../app/api/public/clientes.php?action=logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'index.php');
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    });
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        } else {
            //sweetAlert(4, 'Puede continuar con la sesión', null);
        }
    });
}

// Función para obtener el detalle del pedido (carrito de compras).
function readOrderDetail() {
    fetch(API_PEDIDO + 'readOrderDetail', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                    let content = '';
                    // Se declara e inicializa una variable para calcular el importe por cada producto.
                    let subtotal = 0;
                    // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
                    let total = 0;
                    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        subtotal = row.precioproducto * row.cantidad;
                        total += subtotal;
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                            <tr>
                                <td>${row.nombre}</td>
                                <td>${row.precioproducto}</td>
                                <td>${row.cantidad}</td>
                                <td>${subtotal.toFixed(2)}</td>
                                <th scope="row">
                                    <div class="row justify-c">
                                        <div class="col-12 d-flex">
                                                            
                                            <a href="#" onclick="openDeleteDialogCart(${row.iddetallepedido})"
                                                class="btn btn-outline-secondary"><i class="fas fa-window-close tamanoBoton"></i>
                                            </a>

                                        </div>
                                    </div>
                                </th>
                            </tr>
                        `;
                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('tbodyCart-rows').innerHTML = content;
                    // Se muestra el total a pagar con dos decimales.
                    //document.getElementById('pago').textContent = total.toFixed(2);
                } else {
                    sweetAlert(4, response.exception, 'index.php');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para mostrar un mensaje de confirmación al momento de eliminar un producto del carrito.
function openDeleteDialogCart(id) {
    swal({
        title: 'Advertencia',
        text: '¿Está seguro de remover el producto?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario no se hace nada.
        if (value) {
            // Se define un objeto con los datos del registro seleccionado.
            const data = new FormData();
            data.append('id_detalle', id);

            fetch(API_PEDIDO + 'deleteDetail', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un producto del carrito.
                            readOrderDetail();
                            sweetAlert(1, response.message, null);
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    });
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    });
}