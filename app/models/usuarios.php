<?php

//Clase para manejar tabla usuario
Class Usuarios{

    //Declarando atributos
    private $idAdmon = null;
    private $nombre = null;
    private $apellido = null;
    private $genero = null;
    private $correo = null;
    private $foto = null;
    private $fechaNacimiento = null;
    private $telefono = null;
    private $direccion = null;
    private $usuario = null;
    private $contrasenia = null;
    private $idEstadoUsuario = null;
    private $idTipoUsuario = null;

    //Métodos para obtener valores
    public function readAll(){
        $sql = 'SELECT nombre, usuario FROM admon';
        $params = null;
        return Database::getRows($sql, $params);
    }
}   

?>