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
                    <div class="row justify-content-end">
                        <div class="col-12 d-flex justify-content-end align-items-end">
                                            
                            <a href="#" onclick="openUpdateDialog(${row.idinventario})"
                                class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i>
                            </a>

                            <h5 class="mx-1"></h5>

                            <a href="#" onclick="openDeleteDialog(${row.idinventario})" class="btn btn-outline-danger">
                                <i class="fas fa-trash-alt tamanoBoton"></i>
                            </a>

                            <h5 class="mx-1"></h5>

                            <a href="#" onclick="changeAmount(${row.idinventario},'${row.nombre}','${row.talla}', ${row.cantidad})" class="btn btn-outline-primary"><i class="fas fa-plus tamanoBoton"></i></a>

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

//Se ejecuta al abrir el modal 'sumarCantidad';
function changeAmount(id, nombre, talla, cantidad) {
    openModal('sumarCantidad');

    //se asignan los respectivos datos.
    document.getElementById('lblNombreProducto').textContent = nombre + ' ' + talla;
    document.getElementById('stockActual').value = cantidad;
    document.getElementById('idProductoInventario').value = id;
}

//Se ejecuta al presionar el btnMinus
document.getElementById('btnMinus').addEventListener('click',function(event){
    event.preventDefault();
    
    //Se resta una unidad para bajar el contador
    var cantidad = document.getElementById('lblContador').textContent;
    cantidad--;

    //Se valida que el numero no sea negativo o 0.
    if (cantidad == 0) {
        sweetAlert(2, 'No se pueden agregar cantidades nulas.',null);
        document.getElementById('lblContador').textContent = 1;
        document.getElementById('txtContador').value = 1;
    } else {
        document.getElementById('lblContador').textContent = cantidad;
        document.getElementById('txtContador').value = cantidad;
    }
});

// Se ejecuta al presionar el boton btnPlus
document.getElementById('btnPlus').addEventListener('click',function(event){
    event.preventDefault();

    //Captura la cantidad actual y la incrementa en uno cada vez que se presiona el boton.
    var cantidad = document.getElementById('lblContador').textContent;
    cantidad++;

    //Se asigna a un input invisible y al contador visible.
    document.getElementById('lblContador').textContent = cantidad;
    document.getElementById('txtContador').value = cantidad;
})

//Metodo submit del formulario para sumar stock en el inventario.
document.getElementById('sumarCantidad-form').addEventListener('submit',function(event){
    event.preventDefault();

    //Convertimos los valores a integer para hacer una suma.
    var stockActual = parseInt(document.getElementById('stockActual').value);
    var contador = parseInt(document.getElementById('txtContador').value);
    //Suma
    var resultado = stockActual + contador;
    //Le damos el resultado a un input invisible
    document.getElementById('stockNuevo').value = resultado;

    //Capturando datos 
    fetch(API_INVENTARIO + 'updateStock', {
        method: 'post',
        body: new FormData(document.getElementById('sumarCantidad-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    sweetAlert(1, response.message, closeModal('sumarCantidad'));
                    readRows(API_INVENTARIO);
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
    saveRow(API_INVENTARIO, action, 'inventario-form', 'inventario');
})

//Eliminar
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idInventario', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_INVENTARIO, data);
}

restartSearch('btnReiniciar', API_INVENTARIO);
