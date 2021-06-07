//constante para la ruta de la API y ENDPOINTS
const API_PRODUCTO = '../../app/api/dashboard/productos.php?action=';
const API_RESEÑAS = '../../app/api/dashboard/reseñas.php?action=';
const ENDPOINT_COMMENTS = '../../app/api/dashboard/reseñas.php?action=readAllStates';
const ENDPOINT_MARCA = '../../app/api/dashboard/productos.php?action=readAllMarca';
const ENDPOINT_SUB = '../../app/api/dashboard/productos.php?action=readAllSub';
const ENDPOINT_IMG= '../../app/api/dashboard/productos.php?action=readImg';

//Constante para agarrar el album
const idAlbum = document.getElementById('idAlbum')
idAlbum.style.visibility = 'hidden';
const idproducto6 = document.getElementById('idProducto6')
const imagenTabla = document.getElementById('imagen6')

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

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto1', 'archivo_producto1');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_producto1','divFoto1');

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto2', 'archivo_producto2');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPictureMultiple('archivo_producto2','divFoto2');

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

function openCreateDialog(){
    fillSelect(ENDPOINT_MARCA,'cbMarca1',null);
    fillSelect(ENDPOINT_SUB,'cbSubcategoria1',null);

}

//Constante para agarrar el id
const idPro = document.getElementById('idProducto1')
const idPro1 = document.getElementById('idProducto2')


document.getElementById('agregarProducto-form').addEventListener('submit',function(event){

    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Se establece el campo de archivo como obligatorio.
    document.getElementById('archivo_producto1').required = true;
    //Obtener datos
    fetch(API_PRODUCTO + 'create',{
        method: 'post',
        body: new FormData(document.getElementById('agregarProducto-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //previewSavePicture('divFoto1', '',0);
                    
                    readRows(API_PRODUCTO);

                    //Obtener datos
                    fetch(API_PRODUCTO + 'ultimoID',{
                        method: 'post',
                        body: new FormData(document.getElementById('agregarProducto-form'))
                    }).then(function(request){
                        //Verificando si la petición fue correcta
                        if(request.ok){
                            request.json().then(function(response){
                                //Verificando respuesta satisfactoria
                                if(response.status){
                                    //previewSavePicture('divFoto1', '',0);
                                    mostrarImagenes()
                                    let data = []
                                    data = response.dataset;
                                    data.map(function (row){
                                        idPro.value = row.idproducto;
                                        idPro1.value = row.idproducto;
                                        console.log(row.idproducto)
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

document.getElementById('limpiar').addEventListener('click', function(event){

    //función para que no recargue la pagina
    event.preventDefault();
    
    //Limpiando formulario
    clearForm('agregarProducto-form');
    previewSavePicture('divFoto1', '',0);
})

document.getElementById('idAlbum').addEventListener('click', function(event){

    //función para que no recargue la pagina
    event.preventDefault();
    
})

//Función para comprobar si el usuario quiere o no agregar imagenes secuandarias
function mostrarImagenes(){
    swal({
        title: 'Advertencia',
        text: '¿Desea agregar imagenes secundarias?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {

            //Abriendo modal de imagenes
            openModal('administrarImagenes')
            //Cerrando modal de agregar producto
            closeModal('agregarProducto')

        } else{
            sweetAlert(1, 'Se ha agregado el producto correctamente', null);
            clearForm('agregarProducto-form')
            closeModal('agregarProductos')
            previewSavePicture('divFoto1', '',0)
        }
    });
}

//Actualizar
document.getElementById('btnResponder').addEventListener('click',function(){
    
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
    idproducto6.value = id;
    console.log(idproducto6.value)
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

//Eliminar
function openDeleteDialogImg(id, imagen){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idProducto6', id);
    data.append('imagen6', imagen);
    // Se llama a la función que elimina un registro.
    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_PRODUCTO + 'deleteImg', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            readRowsImg(ENDPOINT_IMG);
                            sweetAlert(1, response.message, null);
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
}

restartSearch('btnReiniciar', API_PRODUCTO);

//Imagenes multiples 
let img = [];
let error = 0;

function previewPictureMultiple(idInputExaminar, idDivFoto){
    document.getElementById(idInputExaminar).onchange=function(e){

        var files = this.files;
        var element;
        var supportedImages = ["image/jpeg", "image/png", "image/gif"];
        var seEncontraronElementoNoValidos = false;

        for (var i = 0; i < files.length; i++) {
            element = files[i];

            if (supportedImages.indexOf(element.type) != -1) {
                createPreview(element);
            }
            else {
                seEncontraronElementoNoValidos = true;
            }
        }

        if (seEncontraronElementoNoValidos) {
            console.log("Se encontraron archivos no validos.");
        }
        else {
            console.log("Todos los archivos se subieron correctamente.");
            //console.log(archivo_producto2.files)
            img.push(this.files);

            const data = new FormData();
            data.append('archivo_producto2', archivo_producto2.files[0]);
            data.append('idProducto2', idPro1.value)
            //Capturando datos 
            fetch(API_PRODUCTO + 'saveFoto', {
                method: 'post',
                body: data
            }).then(function(request){
                //Verificando si la petición fue correcta
                if(request.ok){
                    request.json().then(function(response){
                        //Verificando respuesta satisfactoria
                        if(response.status){
                            //sweetAlert(1, response.message, null);
                            error = 0;
                        } else{
                            sweetAlert(4, response.exception, null);
                            error = 1;
                            console.log(error);
                        }
                    })
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
}

function createPreview(file) {
    var imgCodified = URL.createObjectURL(file);
    //var img = $('<div class="d-flex flex-column justify-content-center align-items-center"><div class="divFotografia"> <figure> <img src="' + imgCodified + '" alt="Foto del usuario"> <figcaption> <i class="icon-cross"></i> </figcaption> </figure> </div></div>');
    //Parte de la pagina web en donde se incrustara la imagen
    let preview=document.getElementById('divFoto2');
    
    //Se crea el elemento IMG que contendra la preview
    image = document.createElement('img');

    //Se le asigna la ruta al elemento creado
    image.src = imgCodified;

    //Se aplican las respectivas clases para que la preview aparezca estilizada
    image.className = 'rounded-circle fotografiaPerfil';

    //Se quita lo que este dentro del div (en caso de que exista otra imagen)
    preview.innerHTML = ' ';

    //Se agrega el elemento recien creado
    preview.append(image);
    $(image).insertBefore("#divFoto2");

    if(error === 1){
        previewSavePicture('divFoto2', '',0);
    }
} 

document.getElementById('botonFoto3').addEventListener('click', function(){
    guardarImagenes();
})

let imagenesg = document.getElementById('txtImg')

function guardarImagenes(){
    if(error === 1){
        sweetAlert(4, 'Hubo problemas al subir algunas fotos', null);
    } else{
        
        sweetAlert(1, 'Todas las imagenes se agregaron correctamente', location.reload());
        /*clearForm('agregarProducto-form')
        closeModal('agregarProductos')
        closeModal('administrarImagenes')
        previewSavePicture('divFoto2', '',0);
        previewSavePicture('divFoto1', '',0);*/
        
    }
}

//Evento para abrir modal de album
document.getElementById('album').addEventListener('click', function(event){
    event.preventDefault();
    closeModal('administrarProductos')
    readRowsImg()
})


function readRowsImg() {
    
    const data = new FormData();
    data.append('idProducto6', idproducto6.value);
    fetch(ENDPOINT_IMG, {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                            <tr>
                                <td><img src="../../resources/img/dashboard_img/producto_fotos/${row.imagen}" height="120"></td>
                                <td>${row.nombre}</td>
                                <th scope="row">
                                    <div class="row justify-c">
                                        <div class="col-12 d-flex">
                                                            
                                            <a href="#" onclick="openUpdateDialog(${row.idproducto})"data-bs-toggle="modal" data-bs-target="#administrarProductos"
                                                class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i>
                                            </a>

                                            <h5 class="mx-1">
                                            </h5>

                                            <a href="#" onclick="openDeleteDialogImg(${row.idproducto})" class="btn btn-outline-danger"><i class="fas fa-exclamation tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                            </h5>

                                        </div>
                                    </div>
                                </th>
                            </tr>
                        `; 
                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('tbodyImg-rows').innerHTML = content
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}



