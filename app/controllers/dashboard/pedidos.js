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
        `
        if (`${row.estadopedido}` == 'En proceso') {
            content +=`
            <th scope="row">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <!-- Button trigger modal -->
                            <a href="#" data-bs-toggle="modal" onclick="finishOrder(${row.idpedido})" class="btn btn-outline-success"><i
                                    class="fas fa-check tamanoBoton"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
            `
        }else{
            content +=`
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
        }
        
    })

    document.getElementById('tbody-rows').innerHTML = content;
}

document.getElementById('search-form').addEventListener('submit',function(event){
    event.preventDefault();

    searchRows(API_PEDIDOS, 'search-form');
})

var idCliente = null;

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
                    
                    document.getElementById('idPedido').value = (response.dataset.idpedido);

                    document.getElementById('txtPedido').textContent = (response.dataset.idpedido);
                                   
                    document.getElementById('txtCliente').textContent= (response.dataset.cliente);
                                 
                    document.getElementById('txtFechaPedido').textContent = (response.dataset.fechapedido);
                                   
                    document.getElementById('txtEstadoPedido').textContent = (response.dataset.estadopedido);

                    idCliente = response.dataset.idcliente;

                    var estadopedido = response.dataset.estadopedido;
                    console.log(estadopedido);

                    if (estadopedido == 'Activo') {
                        document.getElementById('btnActivar').className='d-none';
                        document.getElementById('btnCancelar').className='d-block btn btn-outline-dark my-1';
                        document.getElementById('btnEntregar').className='d-block btn btn-outline-dark my-1';
                    }
                    else if(estadopedido == 'Completado'){
                        document.getElementById('btnActivar').className='d-none';
                        document.getElementById('btnCancelar').className='d-none';
                        document.getElementById('btnEntregar').className='d-none';
                    }                    
                    else if(estadopedido == 'Cancelado'){
                        document.getElementById('btnActivar').className='d-block btn btn-outline-dark my-1';
                        document.getElementById('btnCancelar').className='d-none'; 
                        document.getElementById('btnEntregar').className='d-none';
                    }

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

document.getElementById('btnContactar').addEventListener('click',function(){
    document.getElementById('idCliente').value = '';
    openContactDialog(idCliente);
})

function openContactDialog(id){
    const data = new FormData();
    data.append('idCliente', id);

    fetch(API_PEDIDOS + 'readClient', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtNombre').textContent = (response.dataset.nombre);
                    document.getElementById('txtApellido').textContent = (response.dataset.apellido);
                    document.getElementById('txtFechaNacimiento').textContent = (response.dataset.fechanacimiento);
                    document.getElementById('txtTelefono').textContent = (response.dataset.telefono);
                    document.getElementById('txtGenero').textContent = (response.dataset.genero);
                    document.getElementById('txtCorreo').textContent = (response.dataset.correo);
                    document.getElementById('txtUsuario').textContent = (response.dataset.usuario);
                    document.getElementById('txtDireccion2').textContent = (response.dataset.direccion);
                    console.log(response.dataset.foto);
                    previewSavePicture('divFoto', response.dataset.foto,2);
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

document.getElementById('btnCancelar').addEventListener('click',function(){
    cancelOrder();
})

document.getElementById('btnEntregar').addEventListener('click',function(){
    deliverOrder();
})

document.getElementById('btnActivar').addEventListener('click',function(){
    activateOrder();
})

function cancelOrder(){
    document.getElementById('informacionPedido-form').addEventListener('submit', function(event){

        event.preventDefault();
    
        swal({
            title: 'Advertencia',
            text: '¿Desea cancelar el pedido?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_PEDIDOS + 'cancelOrder', {
                    method: 'post',
                    body: new FormData(document.getElementById('informacionPedido-form'))
                }).then(function(request){
                    //Verificando si la petición fue correcta
                    if(request.ok){
                        request.json().then(function(response){
                            //Verificando respuesta satisfactoria
                            if(response.status){
                                //cargando de nuevo la tabla
                                readRows(API_PEDIDOS);
                                //Mandando mensaje de exito
                                sweetAlert(1, response.message, closeModal('administrarPedidos'));
                            } else{
                                sweetAlert(4, response.exception, null);
                            }
                        })
                    } else {
                        console.log(request.status + ' ' + request.statusText);
                    }
                }).catch(function(error){
                    console.log(error);
                });
            }
        });
    });
}

function finishOrder(id){
        swal({
            title: 'Advertencia',
            text: '¿Desea finalizar el pedido?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                const data = new FormData();
                data.append('idPedido',id);
                fetch(API_PEDIDOS + 'finishOrder', {
                    method: 'post',
                    body: data
                }).then(function(request){
                    //Verificando si la petición fue correcta
                    if(request.ok){
                        request.json().then(function(response){
                            //Verificando respuesta satisfactoria
                            if(response.status){
                                //cargando de nuevo la tabla
                                readRows(API_PEDIDOS);
                                //Mandando mensaje de exito
                                sweetAlert(1, response.message, null);
                            } else{
                                sweetAlert(4, response.exception, null);
                            }
                        })
                    } else {
                        console.log(request.status + ' ' + request.statusText);
                    }
                }).catch(function(error){
                    console.log(error);
                });
            }
        });
}

function activateOrder(){
    document.getElementById('informacionPedido-form').addEventListener('submit', function(event){

        event.preventDefault();
    
        swal({
            title: 'Advertencia',
            text: '¿Desea activar el pedido?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_PEDIDOS + 'activateOrder', {
                    method: 'post',
                    body: new FormData(document.getElementById('informacionPedido-form'))
                }).then(function(request){
                    //Verificando si la petición fue correcta
                    if(request.ok){
                        request.json().then(function(response){
                            //Verificando respuesta satisfactoria
                            if(response.status){
                                //cargando de nuevo la tabla
                                readRows(API_PEDIDOS);
                                //Mandando mensaje de exito
                                sweetAlert(1, response.message, closeModal('administrarPedidos'));
                            } else{
                                sweetAlert(4, response.exception, null);
                            }
                        })
                    } else {
                        console.log(request.status + ' ' + request.statusText);
                    }
                }).catch(function(error){
                    console.log(error);
                });
            }
        });
    });
}

function deliverOrder(){
    document.getElementById('informacionPedido-form').addEventListener('submit', function(event){

        event.preventDefault();
    
        swal({
            title: 'Advertencia',
            text: '¿Desea entregar el pedido?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_PEDIDOS + 'deliverOrder', {
                    method: 'post',
                    body: new FormData(document.getElementById('informacionPedido-form'))
                }).then(function(request){
                    //Verificando si la petición fue correcta
                    if(request.ok){
                        request.json().then(function(response){
                            //Verificando respuesta satisfactoria
                            if(response.status){
                                //cargando de nuevo la tabla
                                readRows(API_PEDIDOS);
                                //Mandando mensaje de exito
                                sweetAlert(1, response.message, closeModal('administrarPedidos'));
                            } else{
                                sweetAlert(4, response.exception, null);
                            }
                        })
                    } else {
                        console.log(request.status + ' ' + request.statusText);
                    }
                }).catch(function(error){
                    console.log(error);
                });
            }
        });
    });
}





