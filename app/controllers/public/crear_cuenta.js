//Constante de la ruta para la API
const API_CLIENT = '../../app/api/public/clientes.php?action=';

document.addEventListener('DOMContentLoaded', function(){
    // Se llama a la función que asigna el token del reCAPTCHA al formulario.
    //reCAPTCHA();
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
})

/*// Función para obtener un token del reCAPTCHA y asignarlo al formulario.
function reCAPTCHA() {
    // Método para generar el token del reCAPTCHA.
    grecaptcha.ready(function () {
        // Se declara e inicializa una variable para guardar la llave pública del reCAPTCHA.
        let publicKey = '6LdBzLQUAAAAAJvH-aCUUJgliLOjLcmrHN06RFXT';
        // Se obtiene un token para la página web mediante la llave pública.
        grecaptcha.execute(publicKey, { action: 'homepage' }).then(function (token) {
            // Se asigna el valor del token al campo oculto del formulario
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
}*/


//Evento submit del botón del formulario
document.getElementById('register-form').addEventListener('submit', function(event){

    event.preventDefault();

    //Obteniendo datos a través de fecth
    fetch(API_CLIENT + 'register', {
        method: 'post',
        body: new FormData(document.getElementById('register-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    previewSavePicture('divFoto', '',0);
                    sweetAlert(1, response.message, 'index.php');
                    clearForm('register-form')
                    clearValidate();
                    
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

function botonExaminar(idBoton, idInputExaminar){
    document.getElementById(idBoton).addEventListener('click', function(event){
        //Se evita recargar la pagina
        event.preventDefault();
    
        //Se hace click al input invisible
        document.getElementById(idInputExaminar).click();
    });
}

function previewPicture(idInputExaminar, idDivFoto){
    document.getElementById(idInputExaminar).onchange=function(e){

        //variable creada para obtener la URL del archivo a cargar
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
    
        //Se ejecuta al obtener una URL
        reader.onload=function(){
            //Parte de la pagina web en donde se incrustara la imagen
            let preview=document.getElementById(idDivFoto);
    
            //Se crea el elemento IMG que contendra la preview
            image = document.createElement('img');
    
            //Se le asigna la ruta al elemento creado
            image.src = reader.result;
    
            //Se aplican las respectivas clases para que la preview aparezca estilizada
            image.className = 'rounded-circle fotografiaPerfil';
    
            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';
    
            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');


//*****Validaciones del lado del cliente******//

//Obtener los elementos de la vista
const formulario = document.getElementsByTagName('input');
const direccion = document.getElementById('txtDireccion')


//Creación de los eventos change para cada uno de los input
formulario[1].addEventListener('change', function(){
    checkInputLetras(1);
});

formulario[2].addEventListener('change', function(){
    checkCorreo(2);
});

formulario[3].addEventListener('change', function(){
    checkInput(3);
});

formulario[4].addEventListener('change', function(){
    checkInput(4);
});

formulario[5].addEventListener('change', function(){
    checkInputLetras(5);
});

formulario[6].addEventListener('change', function(){
    checkCorreo(6);
});

formulario[8].addEventListener('change', function(){
    checkInput(8);
});

formulario[9].addEventListener('change', function(){
    checkTelefono(9);
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

