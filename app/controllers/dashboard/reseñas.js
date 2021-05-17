const API_RESEÑAS = '../../app/api/dashboard/reseñas.php?action=';

document.addEventListener('DOMContentLoaded', function(){
    readRows(API_RESEÑAS);
});

function fillTable(dataset){
    let content = ' ';

    dataset.map(function(row){
        content += `
        <tr>
            <td>${row.cliente}</td>
            <td>${row.fechapedido}</td>
            <td>${row.puntuacion}</td>
            <th scope="row">
                <div class="row">
                    <div class="col-12 d-flex">
                        <!-- Button trigger modal -->
                        <a href="#" data-bs-toggle="modal" onclick="openUpdateDialog(${row.idresena})" data-bs-target="#administrarResenas" class="btn btn-outline-primary"><i
                                class="fas fa-info tamanoBoton"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `
        
    })

    document.getElementById('tbody-rows').innerHTML = content;
}

function openUpdateDialog(id){
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
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idReseña').value = response.dataset.idresena;
                    document.getElementById('txtCliente').textContent = response.dataset.cliente;
                    document.getElementById('txtFecha').textContent = response.dataset.fechapedido;
                    document.getElementById('txtPuntuacion').textContent = response.dataset.puntuacion;
                    document.getElementById('txtIdPedido').textContent = response.dataset.idpedido;
                    document.getElementById('txtReseña').value = response.dataset.comentario;
                    document.getElementById('txtRespuesta').value = response.dataset.respuesta;
                    
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

document.getElementById('btnReiniciar').addEventListener('click',function(){
    console.log('Hola');
    restartSearch('btnReiniciar',API_RESEÑAS);
});

//Buscar

document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_RESEÑAS, 'search-form');
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
                                readRows(API_RESEÑAS);
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
                        //cargando de nuevo la tabla
                        readRows(API_RESEÑAS);
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


    
