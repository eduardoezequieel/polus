//Constante para la ruta de la API 
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/usuarios.php?action=readTipoUsuario';

//evento que se ejecuta al cargar la pagina
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_USUARIO);
    fillSelect(ENDPOINT_TIPOS, 'cbTipoUsuario',null);
})


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
                <td>${row.tipousuario}</td>
                <th scope="row">
                    <div class="row justify-c">
                        <div class="col-12 d-flex">
                                            
                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarUsuarios"
                                class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i>
                            </a>

                            <h5 class="mx-1">
                            </h1>

                            <a href="#" data--bs-toggle="modal" data-bs-target="#administrarUsuarios"
                                class="btn btn-outline-danger"><i class="fas fa-exclamation tamanoBoton"></i>
                            </a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}