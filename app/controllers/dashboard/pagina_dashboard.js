//Constante de la ruta de la API
const API_USUARIOS = '../../api/dashboard/usuario.php?=action';
const API_PRODUCTOS2 = '../../api/dashboard/productos.php?=action';

//Método que se ejecuta cuando carga la página
document.addEventListener('DOMContentLoaded', function(){
    //let imageName = '60948d8a0ef5f.jpg';
    //document.getElementById('boton').textContent = imageName;
    lineGraph();
});

//Funcion que se ejecuta para cargar la tabla de productos en el dashboard
document.getElementById('btnHistorialPrecio').addEventListener('click',function(event){
    event.preventDefault();

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

});

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
                    <div class="row justify-c">
                        <div class="col-12 d-flex">               
                            <a href="#" onclick="" class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-historialPrecio').innerHTML = content;
}

function lineGraph(){
    var ctx = document.getElementById('historialPrecio').getContext('2d');
    let lineChart = new Chart(ctx, {
        type: 'line',
        data: data = {
            labels: ["January","February","March","April","May"],
            datasets: [{
                label: 'Precio del producto',
                data: [65, 59, 100, 20, 30],
                fill: false,
                borderColor: 'rgb(0, 0, 0)',
                tension: 0.1
              }]
        }
    });
}



