const API_PEDIDOS = '../../app/api/dashboard/pedidos.php?action=';
const ENDPOINT_ESTADOPEDIDO = '../../app/api/dashboard/pedidos.php?action=readAllEstadoPedido';

document.addEventListener('DOMContentLoaded', function(){
    readRows(API_PEDIDOS);
    fillSelect(ENDPOINT_ESTADOPEDIDO,'cbEstadoPedidoSearch',null);
});

//Funcion para el llenado de tablas.
function fillTable(dataset){
    let content = ' ';

    dataset.map(function(row){
        content += `
        <tr>
            <td>${row.idpedido}</td>
            <td>${row.cliente}</td>
            <td>${row.fechapedido}</td>
            <td>${row.estadopedido}</td>
            <th scope="row">
                <div class="row">
                    <div class="col-12 d-flex">
                        <!-- Button trigger modal -->
                        <a href="#" data-bs-toggle="modal" onclick="openInfoDialog(${row.idpedido})" data-bs-target="#administrarPedidos" class="btn btn-outline-primary"><i
                                class="fas fa-info tamanoBoton"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `
    })

    document.getElementById('tbody-rows').innerHTML = content;
}

document.getElementById('search-form').addEventListener('submit',function(event){
    event.preventDefault();

    searchRows(API_PEDIDOS, 'search-form');
})

function openInfoDialog(id){
    const data = new FormData();
    data.append('idPedido', id);

    fetch(API_PEDIDOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    
                    fetch(API_PEDIDOS + 'getProducts', {
                        method: 'post',
                        body: data
                    }).then(function (request) {
                        if (request.ok) {
                            request.json().then(function (response) {
                                if (response.status) {  
                                    let data = response.dataset;   
                                    let content = '';     
                                    data.map(function(row){
                                        content += `${row.nombre}: ${row.cantidad}
                                        `;
                                    })                          
                                    document.getElementById('detallePedido').value = content;
                                }
                            });
                        } else {
                            console.log(request.status + ' ' + request.statusText);
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    
                    document.getElementById('idPedido').textContent = (response.dataset.idpedido);
                                   
                    document.getElementById('txtCliente').textContent= (response.dataset.cliente);
                                 
                    document.getElementById('txtFechaPedido').textContent = (response.dataset.fechapedido);
                                   
                    document.getElementById('txtEstadoPedido').textContent = (response.dataset.estadopedido);

                    fetch(API_PEDIDOS + 'getTotalPrice', {
                        method: 'post',
                        body: data
                    }).then(function (request) {
                        if (request.ok) {
                            request.json().then(function (response) {
                                if (response.status) {                                  
                                    document.getElementById('txtPrecioTotal').textContent = (response.dataset.totalpedido);
                                }
                            });
                        } else {
                            console.log(request.status + ' ' + request.statusText);
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                    document.getElementById('txtDireccion').textContent = (response.dataset.direccion);

                    
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

document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_PEDIDOS, 'search-form');
})

document.getElementById('btnFiltrar').addEventListener('click', function(){
    filtrarPorEstado();
})


restartSearch('btnReiniciar', API_PEDIDOS);

function filtrarPorEstado(){
    document.getElementById('search-form-estado').addEventListener('submit', function(event){

        //Evento para que no recargue la pagina
        event.preventDefault();
    
        fetch(API_PEDIDOS + 'searchRowsEstadoPedido', {
            method: 'post',
            body: new FormData(document.getElementById('search-form-estado'))
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                        fillTable(response.dataset);
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
    })
}

