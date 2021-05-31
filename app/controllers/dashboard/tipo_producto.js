//Constante para la ruta de la API
const API_PRODUCTO = '../../app/api/dashboard/tipoProducto.php?action=';
const ENDPOINT_CAT = '../../app/api/dashboard/tipoProducto.php?action=readcategoria';

//Cuando se carga la pagina web
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_PRODUCTO);
    fillSelect(ENDPOINT_CAT,'cbProducto',null);
    fillSelect(ENDPOINT_CAT,'cbProducto1',null);
});

//Funcion para el llenado de tablas.
function fillTable(dataset){
    let content = ' ';

    dataset.map(function(row){
        content += `
        <tr>
            <td>${row.subcategoria}</td>
            <td>${row.genero}</td>
            <td>${row.categoria}</td>
            <th scope="row">
                <div class="row justify-content-end">
                    <div class="col-12 d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <a href="#" data-bs-toggle="modal" onclick="openUpdateDialog(${row.idsubcategoria})" data-bs-target="#administrarTipo" class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i></a>

                        <h5 class="mx-1"></h1>

                        <a href="#" data--bs-toggle="modal" onclick="openDeleteDialog(${row.idsubcategoria})" data-bs-target="#administrarInventario" class="btn btn-outline-danger"><i class="fas fa-trash-alt tamanoBoton"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `
    })


    document.getElementById('tbody-rows').innerHTML = content;
}
function prueba(id){
    console.log(id)
}
function openUpdateDialog(id){
    const data = new FormData();
    data.append('sub', id);
    console.log(id)

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
                    document.getElementById('sub').value = response.dataset.subcategoria;
                    document.getElementById('txtGenero').value = response.dataset.genero;
                    fillSelect(ENDPOINT_CAT,'cbProducto',response.dataset.idcategoria);
                    document.getElementById('idSubcategoria1').value= response.dataset.idsubcategoria;
                    
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

//Eliminar
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idSubcategoria1', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_PRODUCTO, data);
}

//Buscar

document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_PRODUCTO, 'search-form');
})
    
restartSearch('btnReiniciar', API_PRODUCTO);

document.getElementById('agregarTipo-form').addEventListener('submit', function(event){

    event.preventDefault();

    fetch(API_PRODUCTO + 'createRow', {
        method: 'post',
        body: new FormData(document.getElementById('agregarTipo-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //cargando de nuevo la tabla
                    readRows(API_PRODUCTO);
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, closeModal('agregarTipo'));
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

document.getElementById('administrarTipo-form').addEventListener('submit', function(event){

    event.preventDefault();

    fetch(API_PRODUCTO + 'updateRow', {
        method: 'post',
        body: new FormData(document.getElementById('administrarTipo-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //cargando de nuevo la tabla
                    readRows(API_PRODUCTO);
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, closeModal('administrarTipo'));
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

