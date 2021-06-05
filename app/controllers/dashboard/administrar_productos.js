//constante para la ruta de la API y ENDPOINTS
const API_PRODUCTO = '../../app/api/dashboard/productos.php?action=';
const API_RESEÑAS = '../../app/api/dashboard/reseñas.php?action=';
const ENDPOINT_COMMENTS = '../../app/api/dashboard/reseñas.php?action=readAllStates';
const ENDPOINT_MARCA = '../../app/api/dashboard/productos.php?action=readAllMarca';
const ENDPOINT_SUB = '../../app/api/dashboard/productos.php?action=readAllSub';

//Evento cargada la pagina
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_PRODUCTO);
    fillSelect(ENDPOINT_MARCA,'cbMarca',null);
    fillSelect(ENDPOINT_SUB,'cbSubcategoria',null);
    fillSelect(ENDPOINT_COMMENTS,'txtEstadoResena',null);
})

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_producto');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_producto','divFoto');

//Llenado de tabla
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td><img src="../../resources/img/dashboard_img/producto_fotos/${row.imagenprincipal}" height="80"></td>
                <td>${row.nombre}</td>
                <td>${row.precio}</td>
                <td>${row.subcategoria}</td>
                <td>${row.marca}</td>
                <th scope="row">
                    <div class="row justify-c">
                        <div class="col-12 d-flex">
                                            
                            <a href="#" onclick="openUpdateDialog(${row.idproducto})"data-bs-toggle="modal" data-bs-target="#administrarProductos"
                                class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i>
                            </a>

                            <h5 class="mx-1">
                            </h5>

                            <a href="#" onclick="openDeleteDialog(${row.idproducto})" class="btn btn-outline-danger"><i class="fas fa-exclamation tamanoBoton"></i></a>

                            <h5 class="mx-1">
                            </h5>

                            <a href="#" onclick="openCommentsDialog(${row.idproducto})" data-bs-toggle="modal" data-bs-target="#listaResenas" class="btn btn-outline-primary"><i class="fas fa-comment tamanoBoton"></i></a>

                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

//Llenado de tabla de reseñas
function fillTableReseñas(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
            <td>${row.cliente}</td>
            <td>${row.fecha}</td>
            <td>${row.hora.substring(0,8)}</td>
            <td>${row.puntuacion}</td>
            <td>${row.estadoresena}</td>
            <th scope="row">
                <div class="row">
                    <div class="col-12 d-flex">              
                        <button href="#" onclick="openEditDialog(${row.idresena})" data-bs-toggle="modal" data-bs-target="#administrarResenas" data-bs-dismiss="modal"
                            class="btn btn-outline-success"><i class="fas fa-info tamanoBoton"></i>
                        </button>
                    </div>
                </div>
            </th>
        </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows-reseñas').innerHTML = content;
}

//Buscar
document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_PRODUCTO, 'search-form');
})

//Buscar reseñas

document.getElementById('search-resena-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRowsReseña(API_RESEÑAS, 'search-resena-form');
})

document.getElementById('state-form').addEventListener('submit',function(event){
    event.preventDefault();

   

    fetch(API_RESEÑAS + 'searchByState', {
        method: 'post',
        body: new FormData(document.getElementById('state-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTableReseñas(response.dataset);
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
})

document.getElementById('date-form').addEventListener('submit', function(event){
    event.preventDefault();

    fetch(API_RESEÑAS + 'searchByDate', {
        method: 'post',
        body: new FormData(document.getElementById('date-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTableReseñas(response.dataset);
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
});

function searchRowsReseña(api, form) {
    fetch(api + 'search', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTableReseñas(response.dataset);
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

function openEditDialog(id){
    const data = new FormData();
    data.append('idReseña', id);

    fetch(API_RESEÑAS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    console.log(response.dataset.precio);
                    document.getElementById('idReseña').value = response.dataset.idresena;
                    document.getElementById('lblHora').textContent = response.dataset.hora.substring(0,8);
                    document.getElementById('txtCliente').textContent = response.dataset.cliente;
                    document.getElementById('txtFecha').textContent = response.dataset.fecha;
                    document.getElementById('txtPuntuacion').textContent = response.dataset.puntuacion;
                    document.getElementById('txtProducto').textContent = response.dataset.nombre;
                    document.getElementById('lblPrecio').textContent = '$' + response.dataset.precio;
                    document.getElementById('txtReseña').value = response.dataset.comentario;
                    document.getElementById('txtRespuesta').value = response.dataset.respuesta;

                    if (response.dataset.idestadoresena == 1) {
                        document.getElementById('btnOcultar').className = ('btn btn-outline-dark float-right mx-1');
                        document.getElementById('btnMostrar').className = ('d-none');
                    }
                    else if (response.dataset.idestadoresena == 2) {
                        document.getElementById('btnMostrar').className = ('btn btn-outline-dark float-right mx-1');
                        document.getElementById('btnOcultar').className = ('d-none');
                    }
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

//Actualizar
document.getElementById('btnResponder').addEventListener('click',function(){
    console.log('hola');
    document.getElementById('administrarResena-form').addEventListener('submit', function(event){

        event.preventDefault();
    
        fetch(API_RESEÑAS + 'createOrUpdateAnswer', {
            method: 'post',
            body: new FormData(document.getElementById('administrarResena-form'))
        }).then(function(request){
            //Verificando si la petición fue correcta
            if(request.ok){
                request.json().then(function(response){
                    //Verificando respuesta satisfactoria
                    if(response.status){
                        //Mandando mensaje de exito
                        sweetAlert(1, response.message, closeModal('administrarResenas'));
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
    });
});

function openCommentsDialog(id){
    
    const data = new FormData();
    data.append('idProducto', id);

    fetch(API_RESEÑAS + 'readAll', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTableReseñas(data);
                document.getElementById('idProducto2').value = id;
                document.getElementById('idProducto3').value = id;
                document.getElementById('idProducto4').value = id;
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

//Actualizar
function openUpdateDialog(id){
    // Se establece el campo de archivo como obligatorio.
     document.getElementById('archivo_producto').required = false;
     //Se llama el elemento select
    fillSelect(ENDPOINT_MARCA,'cbMarca',null);
    fillSelect(ENDPOINT_SUB,'cbSubcategoria',null);
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idProducto', id);

    fetch(API_PRODUCTO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idProducto').value = response.dataset.idproducto;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtDescripcion').value = response.dataset.descripcion;
                    document.getElementById('txtPrecio').value = response.dataset.precio;
                    fillSelect(ENDPOINT_SUB, 'cbSubcategoria', response.dataset.idsubcategoria);
                    fillSelect(ENDPOINT_MARCA, 'cbMarca', response.dataset.idmarca);
                    previewSavePicture('divFoto', response.dataset.imagenprincipal,3);
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

document.getElementById('administrarProducto-form').addEventListener('submit', function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Obtener datos
    fetch(API_PRODUCTO + 'update', {
        method: 'post',
        body: new FormData(document.getElementById('administrarProducto-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //cargando de nuevo la tabla
                    readRows(API_PRODUCTO);
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, closeModal('administrarProductos'));
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    })  
})

//Eliminar
document.getElementById('btnEliminar').addEventListener('click',function(){
    document.getElementById('administrarResena-form').addEventListener('submit',function(event){
        event.preventDefault();
        swal({
            title: 'Advertencia',
            text: '¿Desea eliminar el comentario?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_RESEÑAS + 'deleteComment', {
                    method: 'post',
                    body: new FormData(document.getElementById('administrarResena-form'))
                }).then(function (request) {
                    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                    if (request.ok) {
                        request.json().then(function (response) {
                            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                            if (response.status) {
                                // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                                sweetAlert(1, response.message, closeModal('administrarResenas'));
                            } else {
                                sweetAlert(2, response.exception, null);
                                console.log(response.status + ' ' + response.statusText);
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
    });
});

//Ocultar
document.getElementById('btnOcultar').addEventListener('click',function(){
    document.getElementById('administrarResena-form').addEventListener('submit',function(event){
        event.preventDefault();
        swal({
            title: 'Advertencia',
            text: '¿Desea ocultar el comentario?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_RESEÑAS + 'hideComment', {
                    method: 'post',
                    body: new FormData(document.getElementById('administrarResena-form'))
                }).then(function (request) {
                    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                    if (request.ok) {
                        request.json().then(function (response) {
                            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                            if (response.status) {
                                // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                                sweetAlert(1, response.message, closeModal('administrarResenas'));
                            } else {
                                sweetAlert(2, response.exception, null);
                                console.log(response.status + ' ' + response.statusText);
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
    });
});

//Mostrar
document.getElementById('btnMostrar').addEventListener('click',function(){
    document.getElementById('administrarResena-form').addEventListener('submit',function(event){
        event.preventDefault();
        swal({
            title: 'Advertencia',
            text: '¿Desea mostrar nuevamente el comentario?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_RESEÑAS + 'showComment', {
                    method: 'post',
                    body: new FormData(document.getElementById('administrarResena-form'))
                }).then(function (request) {
                    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                    if (request.ok) {
                        request.json().then(function (response) {
                            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                            if (response.status) {
                                // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                                sweetAlert(1, response.message, closeModal('administrarResenas'));
                            } else {
                                sweetAlert(2, response.exception, null);
                                console.log(response.status + ' ' + response.statusText);
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
    });
});

//Eliminar
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idProducto', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_PRODUCTO, data);
}

restartSearch('btnReiniciar', API_PRODUCTO);
