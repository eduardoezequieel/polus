// Constante para establecer la ruta y parámetros de comunicación con la API.
const API = '../../app/api/dashboard/usuarios.php?action=';

document.addEventListener('DOMContentLoaded', function(){
    openProfileDialog();
    getSesionHistory();

    //Para inicializar los tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
})

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');

function getSesionHistory() {
    fetch(API + 'getSesionHistory', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Variable que contendra el codigo html
                    let content = '';
                    response.dataset.map(function(row){
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                            content += `
                            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 mt-3">
                                <div class="tarjetaDispositivo">
                                    <div class="d-flex">
                                        <div class="d-flex justify-content-end align-items-center p-3" style="width: 100px;">
                                            <span style="font-size: 24px;" class="fas fa-desktop text-muted"></span>
                                        </div>
                                        <div class="p-3">
                                            <h1 class="lead">${row.phpinfo}</h1>
                                            <h1 class="lead">${row.fechasesion}</h1>
                                        </div>
                                        <div>
                                            <button onclick="deleteSessionHistory(${row.idhistorialsesion_a})" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar" class="btn"><span class="fas fa-times"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('contenedorDispositivos').innerHTML = content;

                } else {
                    //Se muestra el mensaje
                    document.getElementById('mensaje').className = 'lead text-center';
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function deleteSessionHistory(id) {
    const data = new FormData();
    data.append('idHistorialSesion', id);

    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar este dispositivo?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API + 'deleteSesionHistory', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            sweetAlert(1, response.message, 'mi_cuenta.php');
                        } else {
                            sweetAlert(2, response.exception, null);
                            console.log(response.status + ' ' + response.statusText);
                        }
                    });
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    });
}

function openProfileDialog() {

    fetch(API + 'readProfile', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del usuario que ha iniciado sesión.
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtApellidos').value = response.dataset.apellido;
                    document.getElementById('txtEmail').value = response.dataset.correo;
                    document.getElementById('txtUsuario').value = response.dataset.usuario;
                    document.getElementById('txtTelefono').value = response.dataset.telefono;
                    document.getElementById('txtDireccion').value = response.dataset.direccion;
                    document.getElementById('txtGenero').value = response.dataset.genero;
                    document.getElementById('txtfechaNacimiento').value = response.dataset.fechanacimiento;
                    document.getElementById('switchValue').value = response.dataset.dobleautenticacion;
                    if (response.dataset.dobleautenticacion == 'si') {
                        document.getElementById('switchAuth').setAttribute('checked', true);
                    } else {
        
                    }
                    previewSavePicture('divFoto', response.dataset.foto,1);
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

document.getElementById('info-form').addEventListener('submit', function(event){
    //Evento para prevenir recargar la pagina
    event.preventDefault();

    //Obtener datos
    fetch(API + 'updateProfileInfo', {
        method: 'post',
        body: new FormData(document.getElementById('info-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, 'mi_cuenta.php');
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
});

//Función para mostrar contraseña
function showHidePassword1(checkbox, pass1, pass2, pass3) {
    var check = document.getElementById(checkbox);
    var password1 = document.getElementById(pass1);
    var password2 = document.getElementById(pass2);
    var password3 = document.getElementById(pass3);

    //Verificando el estado del check
    if (check.checked == true) {
        password1.type = 'text';
        password2.type = 'text';
        password3.type = 'text';
    } else {
        password1.type = 'password';
        password2.type = 'password';
        password3.type = 'password';
    }
}

//Cuando se presiona el switch
document.getElementById('switchAuth').addEventListener('change',function(){
    if (document.getElementById('switchValue').value == 'no') {
        document.getElementById('switchValue').value = 'si';
    } else {
        document.getElementById('switchValue').value = 'no';
    }
})

//Al activar el evento submit del formulario updateAuth-form
document.getElementById('updateAuth-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API + 'updateAuth', {
        method: 'post',
        body: new FormData(document.getElementById('updateAuth-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //Mandando mensaje de exito
                    closeModal('cambiarAuth');
                    if (document.getElementById('switchValue').value == 'si') {
                        sweetAlert(1, 'Usted ha habilitado la autenticación en dos pasos, podra ver los cambios la proxima vez que inicie sesión.', 'mi_cuenta.php');
                    } else if(document.getElementById('switchValue').value == 'no') {
                        sweetAlert(1, 'Usted ha deshabilitado la autenticación en dos pasos, podra ver los cambios la proxima vez que inicie sesión.', 'mi_cuenta.php');
                    }
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
})

//Al activar el evento submit del formulario de cambio de usuario
document.getElementById('updateUser-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API + 'updateUser', {
        method: 'post',
        body: new FormData(document.getElementById('updateUser-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //Mandando mensaje de exito
                    closeModal('cambiarUsuario');
                    sweetAlert(1, response.message, 'mi_cuenta.php');
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
});

//Al activar el evento submit del formulario de cambio de correo
document.getElementById('updateEmail-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API + 'updateEmail', {
        method: 'post',
        body: new FormData(document.getElementById('updateEmail-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //Mandando mensaje de exito
                    closeModal('cambiarCorreo');
                    sweetAlert(1, response.message, 'mi_cuenta.php');
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
});

//Al activar el evento submit del formulario de cambio de contraseña
document.getElementById('updatePassword-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API + 'updatePassword', {
        method: 'post',
        body: new FormData(document.getElementById('updatePassword-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //Mandando mensaje de exito
                    closeModal('cambiarContraseña');
                    sweetAlert(1, response.message, 'mi_cuenta.php');
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
});

