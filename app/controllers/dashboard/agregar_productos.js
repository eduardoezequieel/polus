//constante para la ruta de la API y ENDPOINTS
const API_PRODUCTO = '../../app/api/dashboard/productos.php?action=';
const ENDPOINT_MARCA = '../../app/api/dashboard/productos.php?action=readAllMarca';
const ENDPOINT_SUB = '../../app/api/dashboard/productos.php?action=readAllSub';

//Evento cargada la pagina
document.addEventListener('DOMContentLoaded', function(){
    clearForm('agregarProducto-form');
    fillSelect(ENDPOINT_MARCA,'cbMarca',null);
    fillSelect(ENDPOINT_SUB,'cbSubcategoria',null);
})

document.getElementById('agregarProducto-form').addEventListener('submit',function(event){

    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Se establece el campo de archivo como obligatorio.
    document.getElementById('archivo_producto').required = true;
    //Obtener datos
    fetch(API_PRODUCTO + 'create',{
        method: 'post',
        body: new FormData(document.getElementById('agregarProducto-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    sweetAlert(1, response.message, clearForm('agregarProducto-form'));
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        }else{
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    })
})

document.getElementById('limpiar').addEventListener('click', function(event){

    //función para que no recargue la pagina
    event.preventDefault();
    
    //Limpiando formulario
    clearForm('agregarProducto-form');
})
