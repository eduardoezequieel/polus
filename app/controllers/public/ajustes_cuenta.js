//Constante para establecer la ruta de la API
const API_CLIENTES = '../../app/api/public/clientes.php?action=';

// Al cargar la pagina
document.addEventListener('DOMContentLoaded', function(){
    // Carga la informacion del cliente
    obtenerInfo();
});

//Obtener info
function obtenerInfo(){
    fetch(API_CLIENTES + 'readProfile', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //Se asigna la informacion a los campos correspondientes
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtTelefono').value = response.dataset.telefono;
                    document.getElementById('txtFechaNacimiento').value = response.dataset.fechanacimiento;
                    document.getElementById('txtGenero').value = response.dataset.genero;
                    document.getElementById('txtApellido').value = response.dataset.apellido;
                    document.getElementById('txtDireccion').value = response.dataset.direccion;
                    document.getElementById('lblUsuario').textContent = response.dataset.usuario;
                    document.getElementById('lblCorreo').textContent = response.dataset.correo;
                    previewSavePicture('divFoto', response.dataset.foto,2);
                } else {
                    sweetAlert(4, response.exception, 'index.php');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Al ejecutar el evento submit del formulario
document.getElementById('micuenta-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_CLIENTES + 'editProfile', {
        method: 'post',
        body: new FormData(document.getElementById('micuenta-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    sweetAlert(1, response.message, 'mi_cuenta.php');
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
});

//Al ejecutar el evento submit del formulario updateUser-form
document.getElementById('updateUser-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_CLIENTES + 'updateUser', {
        method: 'post',
        body: new FormData(document.getElementById('updateUser-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    sweetAlert(1, response.message, 'mi_cuenta.php');
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
});

//Al ejecutar el evento submit del formulario updateUser-form
document.getElementById('updateEmail-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_CLIENTES + 'updateEmail', {
        method: 'post',
        body: new FormData(document.getElementById('updateEmail-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    sweetAlert(1, response.message, 'mi_cuenta.php');
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
});

//Al ejecutar el evento submit del formulario updatePassword-form
document.getElementById('updatePassword-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_CLIENTES + 'updatePassword', {
        method: 'post',
        body: new FormData(document.getElementById('updatePassword-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    sweetAlert(1, response.message, 'mi_cuenta.php');
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
});

//Función para mostrar contraseña
function showHidePassword3(checkbox, pass1, pass2, pass3) {
    var check = document.getElementById(checkbox);
    var password = document.getElementById(pass1);
    var password2 = document.getElementById(pass2);
    var password3 = document.getElementById(pass3);

    //Verificando el estado del check
    if (check.checked == true) {
        password.type = 'text';
        password2.type = 'text';
        password3.type = 'text';

    } else {
        password.type = 'password';
        password2.type = 'password';
        password3.type = 'password';
    }
}

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');