//constante para la ruta de la API y ENDPOINTS
const API_PRODUCTO = '../../app/api/dashboard/productos.php?action=';
const API_RESEÑAS = '../../app/api/dashboard/reseñas.php?action=';
const ENDPOINT_MARCA = '../../app/api/dashboard/productos.php?action=readAllMarca';
const ENDPOINT_SUB = '../../app/api/dashboard/productos.php?action=readAllSub';

//Evento cargada la pagina
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_PRODUCTO);
    fillSelect(ENDPOINT_MARCA,'cbMarca',null);
    fillSelect(ENDPOINT_SUB,'cbSubcategoria',null);
})

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_producto');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_producto','divFoto');

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

                            <a href="#" onclick="openCommentsDialog(${row.idproducto})" class="btn btn-outline-primary"><i class="fas fa-info tamanoBoton"></i></a>

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

    searchRows(API_PRODUCTO, 'search-form');
})

function openCommentDialog(id){
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

//Actualizar
function openUpdateDialog(id){
    // Se establece el campo de archivo como obligatorio.
     document.getElementById('archivo_producto').required = false;
     //Se llama el elemento select
    fillSelect(ENDPOINT_MARCA,'cbMarca',null);
    fillSelect(ENDPOINT_SUB,'cbSubcategoria',null);
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
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idProducto', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_PRODUCTO, data);
}

restartSearch('btnReiniciar', API_PRODUCTO);
