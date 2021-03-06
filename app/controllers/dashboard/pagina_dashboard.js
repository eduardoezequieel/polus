//Constante de la ruta de la API
const API_PRODUCTOS2 = '../../app/api/dashboard/productos.php?action=';
const API_RESEÑAS2 = '../../app/api/dashboard/reseñas.php?action=';
const API_PEDIDOS2 = '../../app/api/dashboard/pedidos.php?action=';
const API_INVENTARIO2 = '../../app/api/dashboard/inventario.php?action=';
const API_CLIENTES2 = '../../app/api/dashboard/clientes.php?action=';
const API_USUARIOS2 = '../../app/api/dashboard/usuarios.php?action=';

//Método que se ejecuta cuando carga la página
document.addEventListener('DOMContentLoaded', function(){
    //metodos para cargar las graficas
    priceHistory();
    bestScore();
    orderPercentages();
    inventoryHistory();
    clientesMes();

    //Para registrar las sesiones
    createSesionHistory();
});

//Funcion que registra la sesión
function createSesionHistory(){
    fetch(API_USUARIOS2 + 'createSesionHistory', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //console.log(response.message);
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Funcion que se ejecuta para cargar la tabla de productos en el dashboard
document.getElementById('btnHistorialPrecio').addEventListener('click',function(event){
    event.preventDefault();
    //Ejecutamos la funcion
    readProductsOnDashboard();    
});

//Funcion que se ejecuta para cargar la tabla de productos en el dashboard
document.getElementById('btnInventarioPrecio').addEventListener('click',function(event){
    event.preventDefault();
    //Ejecutamos la funcion
    readInventoryOnDashboard();    
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

//Funcion que carga los productos en el dashboard
function readInventoryOnDashboard(){
    fetch(API_INVENTARIO2 + 'readAll', {
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
                fillInventory(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Funcion que carga los clientes registrados por los ultimos 5 meses
function clientesMes(){
    fetch(API_CLIENTES2 + 'clientesMes', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //Se crean arreglos para almacenar los datos
                    let mesNum = [];
                    let cantidadClientes = [];

                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        mesNum.push(row.mes);
                        cantidadClientes.push(row.clientesregistrados);
    
                    });

                    //Creamos un arreglo para guardar los meses de forma textual
                    let meses = [];
                    //Se recorre el arreglo que contiene los meses en numero y se evalua cual es, en base a esto se asigna en texto.
                    for (let index = 0; index < mesNum.length; index++) {
                        if (mesNum[index] == 1) {
                            meses[index] = 'Enero';
                        } else if (mesNum[index] == 2) {
                            meses[index] = 'Febrero';
                        } else if (mesNum[index] == 3) {
                            meses[index] = 'Marzo';
                        } else if (mesNum[index] == 4) {
                            meses[index] = 'Abril';
                        } else if (mesNum[index] == 5) {
                            meses[index] = 'Mayo';
                        } else if (mesNum[index] == 6) {
                            meses[index] = 'Junio';
                        } else if (mesNum[index] == 7) {
                            meses[index] = 'Julio';
                        } else if (mesNum[index] == 8) {
                            meses[index] = 'Agosto';
                        } else if (mesNum[index] == 9) {
                            meses[index] = 'Septiembre';
                        } else if (mesNum[index] == 10) {
                            meses[index] = 'Octubre';
                        } else if (mesNum[index] == 11) {
                            meses[index] = 'Noviembre';
                        } else if (mesNum[index] == 12) {
                            meses[index] = 'Diciembre';
                        } 
                    }

                    barGraph2(cantidadClientes, 'clientesMes', meses, 'Ultimos 5 meses', 'Clientes registrados: ');
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillInventory(dataset){
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
                        <div class="col-12 d-flex justify-content-end">               
                            <a href="#" onclick="setInventoryOnGraph(${row.idinventario})" class="btn btn-outline-primary"><i class="fas fa-plus tamanoBoton"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-historialInventario').innerHTML = content;
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

//Se ejecuta al presionar el boton del formulario
document.getElementById('inventoryHistory-form').addEventListener('submit',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();
    //Se ejecuta la función con la petición
    inventoryHistory();
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

//Funcion que se ejecuta al hacer click en un registro
function setInventoryOnGraph(id){
    //Se asigna el id del producto seleccionado al input invisible
    document.getElementById('id_inventario').value = id;
    //Se hace click al input invisible para accionar el metodo submit del form
    document.getElementById('btnInventoryHistory').click();
    //Se cierra el modal
    closeModal('seleccionarInventario');
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
                    lineGraph('historialPrecio',fechas, precio, titulo[1], 'Precio: $');
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

//Petición para obtener información y setearla a la funcion lineGraph ubicada en components.js
function inventoryHistory(){
    fetch(API_INVENTARIO2 + 'inventoryHistory', {
        method: 'post',
        body: new FormData(document.getElementById('inventoryHistory-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let nombre = [];
                    let cantidad = [];
                    let fecha = [];    
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        nombre.push(row.nombre);
                        cantidad.push(row.cantidad);
                        fecha.push(row.fecha);
                    });
                    //Se destruye el grafico actual para poder crear otro;
                    document.getElementById('inventoryHistorydiv').removeChild(document.getElementById('historialInventario'));
                    //Creamos un nuevo canvas
                    var graph = document.createElement('canvas');
                    //Asignamos el mismo id
                    graph.id = 'historialInventario';
                    //Aplicamos tamaños
                    graph.width = '100';
                    graph.height = '100';
                    //Añadimos el elemento al div
                    document.getElementById('inventoryHistorydiv').appendChild(graph);
                    //lineGraph
                    lineGraph('historialInventario',fecha, cantidad, nombre[1], 'En Stock: ');
               
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

//Funcion para obtener los estados de los pedidos registrados en porcentajes.
function orderPercentages(){
    fetch(API_PEDIDOS2 + 'orderPercentages', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let estados = [];
                    let porcentajes = [];

                    response.dataset.map(function(row){
                        estados.push(row.estadopedido);
                        porcentajes.push(row.porcentajestados);
                    });

                    barGraph(porcentajes, 'pedidosPorcentaje', estados, 'Pedidos');
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

//Funcion que se ejecuta en el evento submit del formulario de busqueda
document.getElementById('search-historialInventario').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault()
    //Mandamos a llamar a la función
    searchInventoryOnDashboard();
})

//Funcion que reinicia la busqueda al presionar el boton btnReiniciarProductos
document.getElementById('btnReiniciarProductos').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Cargamos la funcion
    readProductsOnDashboard();
});

//Funcion que reinicia la busqueda al presionar el boton btnReiniciarInventario
document.getElementById('btnReiniciarInventario').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Cargamos la funcion
    readInventoryOnDashboard();
});

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

//Funcion para realizar busquedas de productos
function searchInventoryOnDashboard(){
    fetch(API_INVENTARIO2 + 'search', {
        method: 'post',
        body: new FormData(document.getElementById('search-historialInventario'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillInventory(response.dataset);
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

