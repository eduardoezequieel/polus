//Constante para la ruta de la API 
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/usuarios.php?action=readTipoUsuario';

//evento que se ejecuta al cargar la pagina
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_USUARIO);
    fillSelect(ENDPOINT_TIPOS, 'cbTipoUsuario',null);
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

    //console.log(formulario);
})

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');

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
                <td>${row.tipousuario}</td>
                <th scope="row">
                    <div class="row justify-c">
                        <div class="col-12 d-flex">
                                            
                            <a href="#" onclick="openUpdateDialog(${row.idadmon})"data-bs-toggle="modal" data-bs-target="#administrarUsuarios"
                                class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i>
                            </a>

                            <h5 class="mx-1">
                            </h1>

                            <a href="#" onclick="openDeleteDialog(${row.idadmon})" class="btn btn-outline-danger"><i class="fas fa-exclamation tamanoBoton"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

//Actualizar
function openUpdateDialog(id){
    // Se establece el campo de archivo como obligatorio.
     document.getElementById('archivo_usuario').required = false;
     //Se llama el elemento select
     fillSelect(ENDPOINT_TIPOS, 'cbTipoUsuario',null);
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idAdmon', id);

    fetch(API_USUARIO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idAdmon').value = response.dataset.idadmon;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtApellidos').value = response.dataset.apellido;
                    document.getElementById('txtEmail').value = response.dataset.correo;
                    document.getElementById('txtGenero').value = response.dataset.genero;
                    document.getElementById('txtDireccion').value = response.dataset.direccion;
                    document.getElementById('txtTelefono').value = response.dataset.telefono;
                    document.getElementById('txtFechaNacimiento').value = response.dataset.fechanacimiento;
                    document.getElementById('txtUsuario').value = response.dataset.usuario;
                    fillSelect(ENDPOINT_TIPOS, 'cbTipoUsuario', response.dataset.idtipousuario);
                    previewSavePicture('divFoto', response.dataset.foto,1);

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

 
document.getElementById('administrarUsuario-form').addEventListener('submit', function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Obtener datos
    fetch(API_USUARIO + 'update', {
        method: 'post',
        body: new FormData(document.getElementById('administrarUsuario-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //cargando de nuevo la tabla
                    readRows(API_USUARIO);
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, closeModal('administrarUsuarios'));
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



//Buscar
document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_USUARIO, 'search-form');
})

//Eliminar
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idAdmon', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_USUARIO, data);
}

restartSearch('btnReiniciar', API_USUARIO);

document.getElementById('btnCancelar').addEventListener('click',function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Método para suspender
    confirmSuspender();
})

document.getElementById('btnActivar').addEventListener('click',function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Método para suspender
    confirmActivar();
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
            fetch(API_USUARIO + 'suspender', {
                method: 'post',
                body: new FormData(document.getElementById('administrarUsuario-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, closeModal('administrarUsuarios'));
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
            fetch(API_USUARIO + 'activar', {
                method: 'post',
                body: new FormData(document.getElementById('administrarUsuario-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, closeModal('administrarUsuarios'));
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


//Creación de los eventos change para cada uno de los input
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