<?php

//Clase para manejar tabla usuario
Class Usuarios extends Validator{

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

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idAdmon = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value,1,25)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value,1,25)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setGenero($value)
    {
        if ($this->validateAlphabetic($value,1,1)) {
            $this->genero = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFoto($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->foto = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    public function setNacimiento($value)
    {
        if ($this->validateDate($value)) {
            $this->fechaNacimiento = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccion($value)
    {
        if ($this->validateAlphabetic($value,1,200)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario($value)
    {
        if ($this->validateAlphabetic($value,1,25)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setContrasenia($value)
    {
        if ($this->validatePassword($value)) {
            $this->contrasenia = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEstadoUsuario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idEstadoUsuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdTipoUsuario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idTipoUsuario = $value;
            return true;
        } else {
            return false;
        }
    }

    //Metodos get

    public function getId(){
        return $this -> id;
    }

    public function getNombres(){
        return $this -> nombre;
    }

    public function getApellidos(){
        return $this -> apellido;
    }

    public function getGenero(){
        return $this -> genero;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getFoto(){
        return $this -> foto;
    }

    public function getNacimiento(){
        return $this -> fechaNacimiento;
    }

    public function getTelefono(){
        return $this -> telefono;
    }

    public function getDireccion(){
        return $this -> direccion;
    }
    public function getUsuario(){
        return $this -> usuario;
    }

    public function getContrasenia(){
        return $this -> contrasenia;
    }

    public function getIdEstadoUsuario(){
        return $this -> idEstadoUsuario;
    }

    public function getIdTipoUsuario(){
        return $this -> idTipoUsuario;
    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO admon(nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, 
                direccion, usuario, contrasena, idEstadoUsuario, idTipoUsuario)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
        $params = array($this->nombre, $this->apellido, $this->genero, $this->correo, $this->foto, 
                        $this->fechaNacimiento, $this->telefono, $this->direccion, $this->usuario, 
                        $hash, $this->idEstadoUsuario, $this->idTipoUsuario);
        return Database::executeRow($sql, $params);
    }

    //Métodos para obtener valores
    public function readAll(){
        $sql = 'SELECT * FROM admon WHERE idAdmon=12';
        $params = null;
        return Database::getRows($sql, $params);
    }
}   

?>