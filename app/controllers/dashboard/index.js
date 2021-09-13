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
                    checkBlockUsers();
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
                    if (response.auth == 'si') {
                        document.getElementById('idAdmonCorreo').value = response.dataset;
                        openModal('validarCorreo');
                    } else {
                        sweetAlert(1,response.message, 'pagina_dashboard.php');
                    }
                } else if (response.error) {
                    sweetAlert(3,response.message, 'cambiar_clave.php');
                } 
                else{
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    })

});

//Al activar el evento submit del formulario validar correo:
document.getElementById('validarCorreo-form').addEventListener('submit', function(event){
    //Desactivar el recargar página
    event.preventDefault();
    //Capturando datos 
    fetch(API_USUARIO + 'validateEmail', {
        method: 'post',
        body: new FormData(document.getElementById('validarCorreo-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    closeModal('validarCorreo');
                    sendVerificationCode();
                    openModal('validarCodigo');
                } else {
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    })

});

//Al activar el evento submit del formulario validar codigo:
document.getElementById('validarCodigo-form').addEventListener('submit', function(event){
    //Desactivar el recargar página
    event.preventDefault();
    //Capturando datos 
    fetch(API_USUARIO + 'validateCode', {
        method: 'post',
        body: new FormData(document.getElementById('validarCodigo-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    closeModal('validarCodigo');
                    sweetAlert(1, response.message, 'pagina_dashboard.php');
                } else {
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    })

});

//Enviar correo
function sendVerificationCode(){
    fetch(API_USUARIO + 'sendVerificationCode', {
        method: 'get'
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    console.log(response.message);
                } else {
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    })
}

//Función para limpiar contraseña
function clearPassword(){
    let contra = document.getElementById('txtContrasenia');
    contra.value = '';
}

//Función para verificar si hay usuarios bloqueados que ya han cumplido con las 24 horas
function checkBlockUsers() {
    // Petición para verificar si usuarios ya cumplidos con su penalización
    fetch(API_USUARIO + 'checkBlockUsers')
    .then(function (request) {
        // Se verifica si la petición es correcta.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        document.getElementById('idAdmon').value = row.idadmon;
                        fetch(API_USUARIO + 'activar', {
                            method: 'post',
                            body: new FormData(document.getElementById('login-form'))
                        }).then(function (request){
                            if(request.ok) {
                                request.json().then(function (response) {
                                    //Verificando respuesta satisfactoria
                                    if(response.status){
                                        /*sweetAlert(1, response.message, null);*/
                                    } 
                                })
                            } else {
                                console.log(request.status + ' ' + request.statusText);
                            }
                        })
                    });
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}
