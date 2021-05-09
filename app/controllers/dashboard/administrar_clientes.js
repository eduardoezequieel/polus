//Constante para la ruta de la API
const API_CLIENTE = '../../app/api/dashboard/clientes.php?action=';

//Evento que se ejecuta al cargar la pagina
document.addEventListener('DOMContentLoaded',function(){

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
})

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
                <th scope="row">
                    <div class="row justify-c">
                        <div class="col-12 d-flex">
                                            
                            <a href="#" onclick="openUpdateDialog(${row.idadmon})"data-bs-toggle="modal" data-bs-target="#administrarClientes"
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