//Constante para la API
const API_INVENTARIO = '../../app/api/dashboard/inventario.php?action=';
const ENDPOINT_TALLA = '../../app/api/dashboard/inventario.php?action=readAllTalla';
const ENDPOINT_PRODUCTO = '../../app/api/dashboard/inventario.php?action=readAllProducto';

//Evento cargada la pagina
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_INVENTARIO);  
})

//Llenado de tabla
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.nombre}</td>
                <td>${row.talla}</td>
                <td>${row.cantidad}</td>
                <th scope="row">
                    <div class="row justify-c">
                        <div class="col-12 d-flex">
                                            
                            <a href="#" onclick="openUpdateDialog(${row.idinventario})"
                                class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i>
                            </a>

                            <h5 class="mx-1">
                            </h1>

                            <a href="#" onclick="openDeleteDialog(${row.idinventario})" class="btn btn-outline-danger"><i class="fas fa-exclamation tamanoBoton"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

//Buscar
document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_INVENTARIO, 'search-form');
})

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    clearForm('inventario-form');
    //Abriendo modal
    openModal('inventario');
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_PRODUCTO, 'cbProducto', null);
    fillSelect(ENDPOINT_TALLA, 'cbTalla', null);
}

//Actualizar
function openUpdateDialog(id){
    clearForm('inventario-form');
    //Abriendo modal
    openModal('inventario');
     //Se llama el elemento select
     fillSelect(ENDPOINT_PRODUCTO, 'cbProducto', null);
     fillSelect(ENDPOINT_TALLA, 'cbTalla', null);
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idInventario', id);

    fetch(API_INVENTARIO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idInventario').value = response.dataset.idinventario;
                    document.getElementById('Cantidad').value = response.dataset.cantidad;
                    fillSelect(ENDPOINT_PRODUCTO, 'cbProducto', response.dataset.idproducto);
                    fillSelect(ENDPOINT_TALLA, 'cbTalla', response.dataset.idtalla);
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

document.getElementById('inventario-form').addEventListener('submit', function(event){
    //Evento para que no recargue
    event.preventDefault();

    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('idInventario').value) {
        action = 'update'
    } else {
        action = 'create'
    }
    saveRow(API_INVENTARIO, action, 'inventario-form');
})

//Eliminar
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idInventario', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_INVENTARIO, data);
}

