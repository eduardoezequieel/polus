//Constante para la ruta de la API
const API_USUARIOS = '../../app/api/dashboard/usuarios.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/usuarios.php?action=readTipoUsuario';

//Evento que se ejecuta cuando el dom haya cargado
document.addEventListener('DOMContentLoaded', function(){
    clearForm('agregarUsuario-form')
    fillSelect(ENDPOINT_TIPOS, 'cbTipoUsuario', null);
});

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');

document.getElementById('agregarUsuario-form').addEventListener('submit', function(event){

    //función para que no recargue la pagina
    event.preventDefault();
    
    //Capturando datos 
    fetch(API_USUARIOS + 'create', {
        method: 'post',
        body: new FormData(document.getElementById('agregarUsuario-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    sweetAlert(1, response.message, clearForm('agregarUsuario-form'));
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
})
