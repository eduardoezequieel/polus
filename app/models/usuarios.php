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
    private     $idEstadoUsuario = null;
    private $idTipoUsuario = null;
    private $ruta = '../../../resources/img/dashboard_img/admon_fotos/';

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
        if ($this->validateAlphabetic($value,1,10)) {
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
        if ($this->validateImageFile($file, 2000, 2000)) {
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
        if ($this->validateString($value,1,200)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario($value)
    {
        if ($this->validateAlphanumeric($value,1,25)) {
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
        return $this -> idAdmon;
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

    public function getRuta()
    {
        return $this->ruta;
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

    //Métodos para administrar cuenta del usuario 
    public function checkUser($alias)
    {
        $sql = 'SELECT idAdmon,foto FROM admon WHERE usuario = ?';
        $params = array($alias);
        if ($data = Database::getRow($sql, $params)) {
            $this->idAdmon = $data['idadmon'];
            $this->usuario = $alias;
            $this->foto= $data['foto'];
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contraseña FROM admon WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['contraseña'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'UPDATE admon SET contraseña = ? WHERE idAdmon = ?';
        $params = array($hash, $_SESSION['idAdmon']);
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = 'SELECT idAdmon, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario, idTipoUsuario
        FROM admon
        WHERE idAdmon = ?';
        $params = array($_SESSION['idAdmon']);
        return Database::getRow($sql, $params);
    }

    public function updateProfileInfo($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE admon
                SET foto = ?, nombre = ?, apellido = ?, genero = ?, fechaNacimiento = ?, telefono = ?, direccion = ?
                WHERE idAdmon = ?';
        $params = array($this->foto, $this->nombre, $this->apellido, $this->genero, $this->fechaNacimiento, $this->telefono,$this->direccion, $_SESSION['idAdmon']);
        return Database::executeRow($sql, $params);
    }

    public function updateProfileAccount()
    {
        $sql = 'UPDATE admon
                SET usuario = ?, correo = ?
                WHERE idAdmon = ?';
        $params = array($this->usuario, $this->correo, $_SESSION['idAdmon']);
        return Database::executeRow($sql, $params);
    }

    //Función para buscar
    public function searchRows($value)
    {
        $sql = 'SELECT idAdmon, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, estadoUsuario, tipoUsuario
        FROM admon
        INNER JOIN estadoUsuario ON estadoUsuario.idEstadoUsuario = admon.idEstadoUsuario
        INNER JOIN tipoUsuario ON tipoUsuario.idTipoUsuario = admon.idTipoUsuario
        WHERE apellido ILIKE ? OR nombre ILIKE ? OR usuario ILIKE ?
        ORDER BY apellido';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO admon(nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, 
                direccion, usuario, contraseña, idEstadoUsuario, idTipoUsuario)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
        $params = array($this->nombre, $this->apellido, $this->genero, $this->correo, $this->foto, 
                        $this->fechaNacimiento, $this->telefono, $this->direccion, $this->usuario, 
                        $hash, $this->idEstadoUsuario, $this->idTipoUsuario);
        return Database::executeRow($sql, $params);
    }

    //Métodos para obtener valores
    public function readAll(){
        $sql = 'SELECT idAdmon, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, estadoUsuario, tipoUsuario
        FROM admon
        INNER JOIN estadoUsuario ON estadoUsuario.idEstadoUsuario = admon.idEstadoUsuario
        INNER JOIN tipoUsuario ON tipoUsuario.idTipoUsuario = admon.idTipoUsuario
        ORDER BY apellido';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT idAdmon, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario, idTipoUsuario
        FROM admon
        WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::getRow($sql, $params);
    }

    //Métodos para obtener tipos de usuario
    public function readAllTipos(){
        $sql = 'SELECT * FROM tipoUsuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE admon
                SET foto = ?, nombre = ?, apellido = ?, genero = ?, correo = ?, fechaNacimiento = ?, telefono = ?, direccion = ?, usuario = ?, idTipoUsuario = ?
                WHERE idAdmon = ?';
        $params = array($this->foto, $this->nombre, $this->apellido, $this->genero, $this->correo, $this->fechaNacimiento, $this->telefono,$this->direccion, $this->usuario, $this->idTipoUsuario, $this->idAdmon);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow(){
        $sql = 'DELETE FROM admon WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::executeRow($sql, $params);
    }

    public function suspenderRow(){
        $sql = 'UPDATE admon SET idEstadoUsuario = 2 WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::executeRow($sql, $params);
    }

    public function activarRow(){
        $sql = 'UPDATE admon SET idEstadoUsuario = 1 WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::executeRow($sql, $params);
    }
}   

?>