//Constante para la ruta de la API
const API_USUARIOS = '../../app/api/dashboard/usuarios.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/usuarios.php?action=readTipoUsuario';

//Evento que se ejecuta cuando el dom haya cargado
document.addEventListener('DOMContentLoaded', function(){
    clearForm('agregarUsuario-form')
    fillSelect(ENDPOINT_TIPOS, 'cbTipoUsuario', null);

    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtFechaNacimiento').setAttribute('max', date);
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
                    previewSavePicture('divFoto', '',0);
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

document.getElementById('limpiar').addEventListener('click', function(event){

    //función para que no recargue la pagina
    event.preventDefault();
    
    //Limpiando formulario
    clearForm('agregarUsuario-form');
    previewSavePicture('divFoto', '',0);
})

//*****Validaciones del lado del cliente******//

//Obtener los elementos de la vista
const formulario = document.getElementsByTagName('input');
const direccion = document.getElementById('txtDireccion')


//Creación de los eventos change para cada uno de los input
formulario[0].addEventListener('change', function(){
    checkInputLetras(0);
});

formulario[1].addEventListener('change', function(){
    checkInputLetras(1)
});

formulario[3].addEventListener('change', function(){
    checkTelefono(3);
});

formulario[5].addEventListener('change', function(){
    checkCorreo(5);
});

formulario[6].addEventListener('change', function(){
    checkInput(6);
});

direccion.addEventListener('change', function(){
    checkDireccion();
});

function clearValidate(){
    for (let index = 0; index < 9; index++) {
        formulario[index].classList.remove('success');
        formulario[index].classList.remove('error');
    }

    direccion.classList.remove('success');
    direccion.classList.remove('error');
}
