<?php

    //Clase de los clientes
    Class Clientes extends Validator{

        //Atributos de la clase
        private $idCliente = null;
        private $idPedido = null;
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
        private $ruta = '../../../resources/img/dashboard_img/cliente_fotos/';

        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idCliente = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdPedido($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idCliente = $value;
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

        //Metodos get

        public function getId(){
            return $this -> idCliente;
        }

        public function getIdPedido(){
            return $this -> idPedido;
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

        //Métodos para administrar cuenta del usuario 
        public function checkUser($alias)
        {
            $sql = 'SELECT idCliente FROM cliente WHERE usuario = ?';
            $params = array($alias);
            if ($data = Database::getRow($sql, $params)) {
                $this->idCliente = $data['idcliente'];
                $this->usuario = $alias;
                return true;
            } else {
                return false;
            }
        }

        public function checkPassword($password)
        {
            $sql = 'SELECT contraseña FROM cliente WHERE idCliente = ?';
            $params = array($this->idCliente);
            $data = Database::getRow($sql, $params);
            if (password_verify($password, $data['contraseña'])) {
                return true;
            } else {
                return false;
            }
        }

        public function changePassword()
        {
            $hash = password_hash($this->clave, PASSWORD_DEFAULT);
            $sql = 'UPDATE usuarios SET clave_usuario = ? WHERE id_usuario = ?';
            $params = array($hash, $_SESSION['id_usuario']);
            return Database::executeRow($sql, $params);
        }

        public function readProfile()
        {
            $sql = 'SELECT id_usuario, nombres_usuario, apellidos_usuario, correo_usuario, alias_usuario
                    FROM usuarios
                    WHERE id_usuario = ?';
            $params = array($_SESSION['id_usuario']);
            return Database::getRow($sql, $params);
        }

        public function editProfile()
        {
            $sql = 'UPDATE usuarios
                    SET nombres_usuario = ?, apellidos_usuario = ?, correo_usuario = ?, alias_usuario = ?
                    WHERE id_usuario = ?';
            $params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $_SESSION['id_usuario']);
            return Database::executeRow($sql, $params);
        }

        //Función para buscar
        public function searchRows($value)
        {
            $sql = 'SELECT idCliente, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, estadoUsuario
            FROM cliente
            INNER JOIN estadoUsuario ON estadoUsuario.idEstadoUsuario = cliente.idEstadoUsuario
            WHERE apellido ILIKE ? OR nombre ILIKE ? OR usuario ILIKE ?
            ORDER BY apellido';
            $params = array("%$value%", "%$value%", "%$value%");
            return Database::getRows($sql, $params);
        }

        public function createRow()
        {
            // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
            $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO cliente(nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, 
                    direccion, usuario, contraseña, idEstadoUsuario)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?)';
            $params = array($this->nombre, $this->apellido, $this->genero, $this->correo, $this->foto, 
                            $this->fechaNacimiento, $this->telefono, $this->direccion, $this->usuario, 
                            $hash, $this->idEstadoUsuario);
            return Database::executeRow($sql, $params);
        }

        //Métodos para obtener valores
        public function readAll(){
            $sql = 'SELECT idCliente, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, estadoUsuario
            FROM cliente
            INNER JOIN estadoUsuario ON estadoUsuario.idEstadoUsuario = cliente.idEstadoUsuario
            ORDER BY apellido';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Métodos para obtener valores
        public function getPedido(){
            $sql = 'SELECT idPedido, fechaPedido, CONCAT(nombre,\' \', apellido) as Cliente, estadoPedido FROM pedido
            INNER JOIN cliente ON cliente.idCliente = pedido.idCliente
            INNER JOIN estadoPedido ON estadoPedido.idEstadoPedido = pedido.idEstadoPedido
            WHERE cliente.idCliente = ?';
            $params = array($this->idCliente);
            return Database::getRows($sql, $params);
        }


        public function readOne()
        {
            $sql = 'SELECT idCliente, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario
            FROM cliente 
            WHERE idCliente = ?';
            $params = array($this->idCliente);
            return Database::getRow($sql, $params);
        }

        public function updateRow($current_image)
        {
            // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
            ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

            $sql = 'UPDATE cliente
                    SET foto = ?, nombre = ?, apellido = ?, genero = ?, correo = ?, fechaNacimiento = ?, telefono = ?, direccion = ?, usuario = ?
                    WHERE idCliente = ?';
            $params = array($this->foto, $this->nombre, $this->apellido, $this->genero, $this->correo, $this->fechaNacimiento, $this->telefono,$this->direccion, $this->usuario, $this->idCliente);
            return Database::executeRow($sql, $params);
        }

        public function deleteRow(){
            $sql = 'DELETE FROM cliente WHERE idCliente = ?';
            $params = array($this->idCliente);
            return Database::executeRow($sql, $params);
        }

    }
?>