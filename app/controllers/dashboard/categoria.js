//Constante para la ruta de la API
const API_CATEGORIA = '../../app/api/dashboard/categoria.php?action=';

//Cuando se carga la pagina web
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_CATEGORIA);
});

//Funcion para el llenado de tablas.
function fillTable(dataset){
    let content = ' ';

    dataset.map(function(row){
        content += `
        <tr>
            <td>${row.categoria}</td>
            <th scope="row">
                <div class="row justify-content-end">
                    <div class="col-12 d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <a href="#" data-bs-toggle="modal" onclick="openUpdateDialog(${row.idcategoria})" data-bs-target="#editarCategoria" class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i></a>

                        <h5 class="mx-1"></h1>

                        <a href="#" data--bs-toggle="modal" onclick="openDeleteDialog(${row.idcategoria})" data-bs-target="#" class="btn btn-outline-danger"><i class="fas fa-trash-alt tamanoBoton"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `
    })

    document.getElementById('tbody-rows').innerHTML = content;
}

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto1', 'archivo_usuario1');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario1','divFoto1');

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');


//Agregar
document.getElementById('agregarCategoria-form').addEventListener('submit', function(event){

    //función para que no recargue la pagina
    event.preventDefault();
    
    //Capturando datos 
    fetch(API_CATEGORIA + 'create', {
        method: 'post',
        body: new FormData(document.getElementById('agregarCategoria-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    previewSavePicture('divFoto1', '',0);
                    sweetAlert(1, response.message, closeModal('agregarCategoria'));
                    readRows(API_CATEGORIA);
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
})

function openUpdateDialog(id){
    // Se establece el campo de archivo como obligatorio.
    document.getElementById('archivo_usuario').required = false;

    const data = new FormData();
    data.append('idCategoria', id);

    fetch(API_CATEGORIA + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idCategoria').value = response.dataset.idcategoria;
                    document.getElementById('txtCategoria2').value = response.dataset.categoria;
                    previewSavePicture('divFoto', response.dataset.imagen,1);
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
document.getElementById('editarCategoria-form').addEventListener('submit', function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Obtener datos
    fetch(API_CATEGORIA + 'update', {
        method: 'post',
        body: new FormData(document.getElementById('editarCategoria-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //cargando de nuevo la tabla
                    readRows(API_CATEGORIA);
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, closeModal('editarCategoria'));
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
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idCategoria', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_CATEGORIA, data);
    readRows(API_CATEGORIA);
}

document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_CATEGORIA, 'search-form');
})
    
restartSearch('btnReiniciar', API_CATEGORIA);
