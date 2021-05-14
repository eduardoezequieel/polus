//Constante para la ruta de la API
const API_MARCAS = '../../app/api/dashboard/marcas.php?action=';

//Cuando se carga la pagina web
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_MARCAS);
});

//Funcion para el llenado de tablas.
function fillTable(dataset){
    let content = ' ';

    dataset.map(function(row){
        content += `
        <tr>
            <td>${row.marca}</td>
            <th scope="row">
                <div class="row justify-content-end">
                    <div class="col-12 d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#administrarMarcas" class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i></a>

                        <h5 class="mx-1"></h1>

                        <a href="#" data--bs-toggle="modal" data-bs-target="#administrarInventario" class="btn btn-outline-danger"><i class="fas fa-trash-alt tamanoBoton"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `
    })

    document.getElementById('tbody-rows').innerHTML = content;
}

