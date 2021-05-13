//Constante para la ruta de la API 
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/usuarios.php?action=readTipoUsuario';

//evento que se ejecuta al cargar la pagina
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_USUARIO);
    fillSelect(ENDPOINT_TIPOS, 'cbTipoUsuario',null);
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