//Constante para la ruta de la API
const API_CATEGORIA = '../../app/api/public/categoria.php?action=';

//Cuando se carga la pagina web
document.addEventListener('DOMContentLoaded', function(){
    
});

document.getElementById('dropdownCategorias').addEventListener('click', function(){
    readCategoriesDropdown(API_CATEGORIA);
    console.log('hola')
})

//Funcion para el llenado de tablas.
function fillCategories(dataset){
    let content = ' ';

    dataset.map(function(row){
        url = `categoria.php?id=${row.idcategoria}&name=${row.categoria}`;

        content += `
        <li><a class="dropdown-item" href="${url}">${row.categoria}</a></li>
        `
    })

    document.getElementById('dropdownCategories-body').innerHTML = content;
}

function readCategoriesDropdown(api) {
    fetch(api + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                    console.log(data);
                    fillCategories(data);
                } else {
                    sweetAlert(4, response.exception, null);
                    console.log('hola')
                }
                // Se envían los datos a la función del controlador para que llenen las categorias en la vista.
                
                console.log(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para mostrar un mensaje de confirmación al momento de cerrar sesión.
function logOutCliente() {
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch('../../app/api/public/clientes.php?action=logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'index.php');
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
        } else {
            //sweetAlert(4, 'Puede continuar con la sesión', null);
        }
    });
}