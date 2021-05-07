//Constante para la ruta de la API
const API_USUARIOS = '../../api/dashboard/usuarios.php?=action';

//Evento que se ejecuta cuando el dom haya cargado
document.addEventListener('DOMContentLoaded', function(){

    document.getElementById('agregarUsuario-form').reset();
});

document.getElementById('agregarUsuario-form').addEventListener('submit', function(event){

    //función para que no recargue la pagina
    event.preventDefault();
    
    //Obtener datos con fetch
    fetch(API_USUARIOS + 'register')
    .then(function(request){
        //Verificando si la petición es correcta
        if(request.ok){
            request.json().then(function(response){
                if(response.status){
                    sweetAlert(1,response.message, null);
                } else{
                    sweetAlert(2, message.exception, null)
                }
            })
        }
    }).catch(function(error){
        console.log(error);
    })
})