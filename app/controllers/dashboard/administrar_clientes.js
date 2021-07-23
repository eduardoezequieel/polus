//Constante para la ruta de la API
const API_CLIENTE = '../../app/api/dashboard/clientes.php?action=';

//Evento que se ejecuta al cargar la pagina
document.addEventListener('DOMContentLoaded',function(){
    cargarTabla()
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtFechaNacimiento').setAttribute('max', date);

    console.log(formulario);
})

function cargarTabla(){
    //Obtener datos
    fetch(API_CLIENTE + 'readAll')
    .then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    readRows(API_CLIENTE);
                } else{
                    sweetAlert(2,response.exception, null)
                }
            })
        } else{
            console.log(request.status,' ',request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    })
}

//Llenado de tabla
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.apellido}</td>
                <td>${row.nombre}</td>
                <td>${row.correo}</td>
                <td>${row.usuario}</td>
                <td>${row.estadousuario}</td>
                <th scope="row">
                    <div class="row justify-c">
                        <div class="col-12 d-flex">
                                            
                            <a href="#" onclick="openUpdateDialog(${row.idcliente})"data-bs-toggle="modal"
                                class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i>
                            </a>

                            <h5 class="mx-1">
                            </h1>

                            <a href="#" onclick="openDeleteDialog(${row.idcliente})" class="btn btn-outline-danger"><i class="fas fa-exclamation tamanoBoton"></i></a>
                            
                            <h5 class="mx-1">
                            </h1>

                            <a href="#" data-bs-toggle="modal" onclick="openInfoDialog(${row.idcliente})" class="btn btn-outline-primary"><i
                                    class="fas fa-info tamanoBoton"></i></a>
                            
                                    <h5 class="mx-1">
                            </h1>

                            <a href="../../app/reports/dashboard/comentarios_cliente.php?id=${row.idcliente}" target="_blank" data-tooltip="Reporte de comentarios por cliente"
                                class="btn btn-outline-dark"><i class="fas fa-book tamanoBoton"></i></a>

                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    clearForm('administrarClientes-form');
    previewSavePicture('divFoto', '',0);
    //Abriendo modal
    openModal('administrarClientes');
    document.getElementById('selecciona').textContent = 'Agregar';
    document.getElementById('btnCancelar').className = 'd-none';
    document.getElementById('btnActivar').className = 'd-none';
}

//Actualizar
function openUpdateDialog(id){
    // Se establece el campo de archivo como obligatorio.
     document.getElementById('archivo_usuario').required = false;
     clearForm('administrarClientes-form');
    //Abriendo modal
    openModal('administrarClientes');
    document.getElementById('selecciona').textContent = 'Actualizar';
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData(); 
    data.append('idCliente', id);

    fetch(API_CLIENTE + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idCliente').value = response.dataset.idcliente;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtApellidos').value = response.dataset.apellido;
                    document.getElementById('txtEmail').value = response.dataset.correo;
                    document.getElementById('txtGenero').value = response.dataset.genero;
                    document.getElementById('txtDireccion').value = response.dataset.direccion;
                    document.getElementById('txtTelefono').value = response.dataset.telefono;
                    document.getElementById('txtFechaNacimiento').value = response.dataset.fechanacimiento;
                    document.getElementById('txtUsuario').value = response.dataset.usuario;
                    previewSavePicture('divFoto', response.dataset.foto,2);

                    let estadousuario = response.dataset.idestadousuario;

                    if (estadousuario == 1) {
                        document.getElementById('btnActivar').className='d-none';
                        document.getElementById('btnCancelar').className='d-block btn btn-outline-dark my-1';
                    }   else if(estadousuario == 2){
                        document.getElementById('btnActivar').className='d-block btn btn-outline-dark my-1';
                        document.getElementById('btnCancelar').className='d-none'; 
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

//Método submit del botón del formulario
document.getElementById('administrarClientes-form').addEventListener('submit',function(event){

    //Evento para prevenir que recargue la página
    event.preventDefault();


     // Se define una variable para establecer la acción a realizar en la API.
     let action = '';
     // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
     if (document.getElementById('idCliente').value) {
         action = 'update'
     } else {
         action = 'create'
     }
     saveRow(API_CLIENTE, action, 'administrarClientes-form', 'administrarClientes');

})

//Buscar
document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para evitar que recargue la pagina
    event.preventDefault();

    searchRows(API_CLIENTE, 'search-form')
})

//Eliminar
function openDeleteDialog(id){
    //Se define el objeto con los datos del registro seleccionado
    const data = new FormData();
    data.append('idCliente', id);

    //Se llama a la función para eliminar
    confirmDelete(API_CLIENTE, data)
}

restartSearch('btnReiniciar', API_CLIENTE);

function openInfoDialog(id){
    clearForm('administrarClientes-form');
    //Abriendo modal
    openModal('administrarPedidos');

    const data = new FormData();
    data.append('idCliente', id);

    fetch(API_CLIENTE + 'getPedido', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let dataPedido = response.dataset;   
                    let content = '';     
                    dataPedido.map(function(row){
                    content += `
                    Factura: ${row.idpedido} 
                    Fecha del pedido: ${row.fechapedido} 
                    Cliente: ${row.cliente} 
                    Estado del pedido: ${row.estadopedido} 
                                
                                `; })                          
                    document.getElementById('Pedido').value = content;                     
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

document.getElementById('btnCancelar').addEventListener('click',function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Método para suspender
    confirmSuspender();
    cargarTabla()
})

document.getElementById('btnActivar').addEventListener('click',function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Método para suspender
    confirmActivar();
    cargarTabla()
})

function confirmSuspender() {
    swal({
        title: 'Advertencia',
        text: '¿Desea suspender el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_CLIENTE + 'suspender', {
                method: 'post',
                body: new FormData(document.getElementById('administrarClientes-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, closeModal('administrarClientes'));
                            cargarTabla()
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

function confirmActivar() {
    swal({
        title: 'Advertencia',
        text: '¿Desea activar el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_CLIENTE + 'activar', {
                method: 'post',
                body: new FormData(document.getElementById('administrarClientes-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, closeModal('administrarClientes'));
                            cargarTabla()
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

const formulario = document.getElementsByTagName('input');
const direccion = document.getElementById('txtDireccion')

formulario[2].addEventListener('change', function(){
    checkInputLetras(2);
});

formulario[3].addEventListener('change', function(){
    checkInputLetras(3)
});

formulario[5].addEventListener('change', function(){
    checkTelefono(5);
});

formulario[7].addEventListener('change', function(){
    checkCorreo(7);
});

formulario[8].addEventListener('change', function(){
    checkInput(8);
});

direccion.addEventListener('change', function(){
    checkDireccion();
});

function clearValidate(){
    for (let index = 0; index < 9; index++) {
        formulario[index].classList.remove('success');
        formulario[index].classList.remove('error');
    }

    direccion.classList.remove('success');
    direccion.classList.remove('error');
}
