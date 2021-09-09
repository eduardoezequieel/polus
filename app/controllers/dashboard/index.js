// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {

    // Petición para verificar si existen usuarios.
    fetch(API_USUARIO + 'readAll')
    .then(function (request) {
        // Se verifica si la petición es correcta.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {
                    /*sweetAlert(4, 'Debe autenticarse para ingresar', 'primer_uso.php');*/
                } else {
                    // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
                    if (response.error) {
                        sweetAlert(2, response.exception, null);
                    } else {
                        sweetAlert(3, response.exception, 'primer_uso.php');
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

//Método botón submit
document.getElementById('login-form').addEventListener('submit', function(event){

    //Desactivar el recargar página
    event.preventDefault();

    //Capturando datos 
    fetch(API_USUARIO + 'logIn', {
        method: 'post',
        body: new FormData(document.getElementById('login-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    sweetAlert(1, response.message, 'pagina_dashboard.php');
                } else{
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    })

})

//Función para limpiar contraseña
function clearPassword(){
    let contra = document.getElementById('txtContrasenia');
    contra.value = '';
}
