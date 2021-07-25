//Constante de la ruta de la API
const API_PRODUCTOS2 = '../../app/api/dashboard/productos.php?action=';
const API_RESEÑAS2 = '../../app/api/dashboard/reseñas.php?action=';

//Método que se ejecuta cuando carga la página
document.addEventListener('DOMContentLoaded', function(){
    //Se carga la grafica con un valor predeterminado
    priceHistory();
    bestScore();
});

//Funcion que se ejecuta para cargar la tabla de productos en el dashboard
document.getElementById('btnHistorialPrecio').addEventListener('click',function(event){
    event.preventDefault();
    //Ejecutamos la funcion
    readProductsOnDashboard();    
});



//Funcion que carga los productos en el dashboard
function readProductsOnDashboard(){
    fetch(API_PRODUCTOS2 + 'readAllOnDashboard', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillProductos(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillProductos(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.nombre}</td>
                <td>${row.marca}</td>

                <th scope="row">
                    <div class="row justify-content-end">
                        <div class="col-12 d-flex justify-content-end">               
                            <a href="#" onclick="setProductOnGraph(${row.idproducto})" class="btn btn-outline-primary"><i class="fas fa-plus tamanoBoton"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-historialPrecio').innerHTML = content;
}

//Se ejecuta al presionar el boton del formulario
document.getElementById('priceHistory-form').addEventListener('submit',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();
    //Se ejecuta la función con la petición
    priceHistory();
})

//Funcion que se ejecuta al hacer click en un registro
function setProductOnGraph(id){
    //Se asigna el id del producto seleccionado al input invisible
    document.getElementById('id_producto').value = id;
    //Se hace click al input invisible para accionar el metodo submit del form
    document.getElementById('btnPriceHistory').click();
    //Se cierra el modal
    closeModal('seleccionarProductoPrecio');
}

//Petición para obtener información y setearla a la funcion lineGraph ubicada en components.js
function priceHistory(){
    fetch(API_PRODUCTOS2 + 'priceHistory', {
        method: 'post',
        body: new FormData(document.getElementById('priceHistory-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let fechas = [];
                    let precio = [];
                    let titulo = [];    
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        titulo.push(row.nombre);
                        precio.push(row.precio);
                        fechas.push(row.fecha);
                    });
                    //Se destruye el grafico actual para poder crear otro;
                    document.getElementById('priceHistorydiv').removeChild(document.getElementById('historialPrecio'));
                    //Creamos un nuevo canvas
                    var graph = document.createElement('canvas');
                    //Asignamos el mismo id
                    graph.id = 'historialPrecio';
                    //Aplicamos tamaños
                    graph.width = '20';
                    graph.height = '20';
                    //Añadimos el elemento al div
                    document.getElementById('priceHistorydiv').appendChild(graph);
                    //lineGraph
                    lineGraph('historialPrecio',fechas, precio, titulo[1]+' ($)');
                } else{
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
}

//Función que obtiene los datos de los productos mejor puntuados
function bestScore(){
    fetch(API_RESEÑAS2 + 'bestScore', {
        method: 'get'    
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let productos = [];
                    let promedios = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        productos.push(row.nombre);
                        promedios.push(row.promedio);
                        cantidad.push(row.puntuaciones);
                    });

                    //Hacemos un substring al arreglo para eliminar todos los 0
                    for (let index = 0; index < promedios.length; index++) {
                        promedios[index] = promedios[index].substring(0,3);
                    }

                    let datos = [];
                    for (let index = 0; index < cantidad.length; index++) {
                        productos[index] = productos[index] + ', Opiniones: ' + cantidad[index];
                    }

                    console.log(productos);
                    console.log(promedios);

                    pieGraph(promedios, 'mejorPuntuados', productos);
                } else{
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
}

//Funcion que se ejecuta en el evento submit del formulario de busqueda
document.getElementById('search-historialPrecio').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault()
    //Mandamos a llamar a la función
    searchRowsOnDashboard();
})

//Funcion que reinicia la busqueda al presionar el boton btnReiniciarProductos
document.getElementById('btnReiniciarProductos').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Cargamos la funcion
    readProductsOnDashboard();
})

//Funcion para realizar busquedas de productos
function searchRowsOnDashboard() {
    fetch(API_PRODUCTOS2 + 'searchOnDashboard', {
        method: 'post',
        body: new FormData(document.getElementById('search-historialPrecio'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillProductos(response.dataset);
                    sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(2, response.exception, null);
                    console.log("error");
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}



