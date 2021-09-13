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
        private $idHistorialSesion = null;
        private $token = null;
        private $dobleautenticacion = null;


        /*
            Métodos set
        */
        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idCliente = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setDobleAutenticacion($value)
        {
            if ($this->validateAlphabetic($value,1,3)) {
                $this->dobleautenticacion = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdHistorialSesion($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idHistorialSesion = $value;
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
            if ($this->validateImageFile($file, 4000, 4000)) {
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

        public function setToken($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->token = $value;
                return true;
            } else {
                return false;
            }
        }

        /*
            Metodos get
        */

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

        public function getIdHistorialSesion(){
            return $this -> idHistorialSesion;
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

        public function getToken(){
            return $this -> token;
        }

        //Se valida si el inicio de sesion es existente o no
        public function validateSesionHistory()
        {
            $sql = 'SELECT*FROM historialSesionCliente WHERE phpinfo = ? AND idCliente = ?';
            $params = array(php_uname(), $_SESSION['idCliente']);
            if (Database::getRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }

        //Metodo para guardar las preferencias del factor de doble autenticacion
        public function updateAuth()
        {
            $sql = 'UPDATE cliente SET dobleautenticacion = ? 
                    WHERE idCliente = ?';
            $params = array($this->dobleautenticacion, $_SESSION['idCliente']);
            return Database::executeRow($sql, $params);
        }

        //Se crea el inicio de sesion
        public function createSesionHistory()
        {
            $sql = 'INSERT INTO historialSesionCliente(idcliente, phpinfo, fechasesion) 
                    VALUES (?,?,current_date)';
            $params = array($_SESSION['idCliente'], php_uname());
            return Database::executeRow($sql, $params);
        }

        //Se obtiene el historial de sesiones de un usuario en especifico
        public function getSesionHistory()
        {
            $sql = 'SELECT*FROM historialSesionCliente WHERE idcliente = ?';
            $params = array($_SESSION['idCliente']);
            return Database::getRows($sql, $params);
        }

        // Para eliminar un historial de sesion
        public function deleteSesionHistory()
        {
            $sql = 'DELETE FROM historialSesionCliente WHERE idcliente = ? AND idhistorialsesion_c = ?';
            $params = array($_SESSION['idCliente'], $this->idHistorialSesion);
            return Database::executeRow($sql, $params);
        }

        //Ver clientes registrados por cada mes
        public function clientesMes()
        {
            $sql = 'SELECT COUNT(idcliente) as clientesRegistrados, EXTRACT(MONTH FROM fecharegistro) as Mes 
                    FROM cliente 
                    GROUP BY mes ORDER BY mes DESC LIMIT 5';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Métodos para administrar cuenta del usuario 
        public function checkUser($correo)
        {
            $sql = 'SELECT idCliente, idEstadoUsuario, usuario, foto FROM cliente WHERE correo = ? ';
            $params = array($correo);
            if ($data = Database::getRow($sql, $params)) {
                $this->idCliente = $data['idcliente'];
                $this->correo = $correo;
                $this->idEstadoUsuario = $data['idestadousuario'];
                $this->usuario = $data['usuario'];
                $this->foto= $data['foto'];
                return true;
            } else {
                return false;
            }
        }

        //Método para verificar el estado del usuario
        public function checkEstado()
        {
            if ($this->idEstadoUsuario == 1) {
                return true;
            } else {
                return false;
            }
        }

        //Función para verificar contraseña
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

        //Función para cambiar contraseña
        public function changePassword()
        {
            $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
            $sql = 'UPDATE cliente SET contraseña = ? WHERE idCliente = ?';
            $params = array($hash, $_SESSION['idCliente']);
            return Database::executeRow($sql, $params);
        }

        //Capturar doble autenticacion del usuario
        public function checkAuthMode()
        {
            $sql = 'SELECT dobleautenticacion FROM cliente WHERE idCliente = ?';
            $params = array($_SESSION['idCliente']);
            return Database::getRow($sql, $params);
        }

        //Función para leer la información del cliente logueado
        public function readProfile()
        {
            $sql = 'SELECT idCliente, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, dobleautenticacion
                    FROM cliente
                    WHERE idCliente = ?';
            $params = array($_SESSION['idCliente']);
            return Database::getRow($sql, $params);
        }

        //Función para editar el perfil del cliente logueado
        public function editProfile($current_image)
        {
            // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
            ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;
            $sql = 'UPDATE cliente SET foto = ?, nombre = ?, apellido = ?, genero = ?, direccion = ?, fechanacimiento = ?, 
                    telefono = ? 
                    WHERE idcliente = ?';
            $params = array($this->foto, $this->nombre, $this->apellido, $this->genero, $this->direccion, 
                            $this->fechaNacimiento, $this->telefono, $_SESSION['idCliente']);
            return Database::executeRow($sql, $params);
        }

        //Función para actualizar el nombre usuario del cliente
        public function updateUser()
        {
            $sql = 'UPDATE cliente SET usuario = ? WHERE idCliente = ?';
            $params = array($this->usuario, $_SESSION['idCliente']);
            return Database::executeRow($sql, $params);
        }

        //Función para actualizar el correo electrónico del cliente logueado
        public function updateEmail()
        {
            $sql = 'UPDATE cliente SET correo = ? WHERE idCliente = ?';
            $params = array($this->correo, $_SESSION['idCliente']);
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

        //Función para agregar un nuevo registro
        public function createRow()
        {
            // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
            $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO cliente(nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, 
                    direccion, usuario, contraseña, idEstadoUsuario, dobleautenticacion, claverequest, fecharegistro)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,current_date)';
            $params = array($this->nombre, $this->apellido, $this->genero, $this->correo, $this->foto, 
                            $this->fechaNacimiento, $this->telefono, $this->direccion, $this->usuario, 
                            $hash, $this->idEstadoUsuario, 'no', 0);
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

        //Función para leer un registro
        public function readOne()
        {
            $sql = 'SELECT idCliente, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario
            FROM cliente 
            WHERE idCliente = ?';
            $params = array($this->idCliente);
            return Database::getRow($sql, $params);
        }

        //Función para actualizar un registro
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

        //Función para eliminar un registro
        public function deleteRow(){
            $sql = 'DELETE FROM cliente WHERE idCliente = ?';
            $params = array($this->idCliente);
            return Database::executeRow($sql, $params);
        }

        //Función para suspender un registro
        public function suspenderRow(){
            $sql = 'UPDATE cliente SET idEstadoUsuario = 2 WHERE idCliente = ?';
            $params = array($this->idCliente);
            return Database::executeRow($sql, $params);
        }
    
        //Función para activar un registro
        public function activarRow(){
            $sql = 'UPDATE cliente SET idEstadoUsuario = 1 WHERE idCliente = ?';
            $params = array($this->idCliente);
            return Database::executeRow($sql, $params);
        }

        //Función para llenar tabla de bitacoraUsuario
        public function registerAction($action, $desc)
        {
            $sql = 'INSERT INTO bitacoraCliente VALUES (DEFAULT, ?, current_date , current_time, ?, ?)';
            $params = array($_SESSION['idCliente'], $action, $desc);
            return Database::executeRow($sql, $params);
        }

        //Función para evaluar si han pasado 90 días desde la última actualización de clave
        public function checkLastPasswordUpdate() {
            $sql = 'SELECT * 
                    FROM bitacoraCliente 
                    WHERE idcliente = ? AND fecha < (SELECT current_date - 90) 
                    AND descripcion = \'Cambio de clave\' LIMIT 1';
            $params = array($_SESSION['idCliente']);
            return Database::getRow($sql,$params);
        }

         //Función para verificar la cantidad de intentos
        public function checkIntentos() {
            $sql = 'SELECT intentos FROM cliente WHERE idcliente = ?';
            $params = array($this->idCliente);
            return Database::getRow($sql,$params);
        }

        //Función para actualizar los intentos de un registro
        public function updateIntentos($intentos)
        {
            $sql = 'UPDATE cliente
                    SET intentos = ?
                    WHERE idcliente = ?';
            $params = array($intentos,$this->idCliente);
            return Database::executeRow($sql, $params);
        }

        //Función para bloquear un registro
        public function bloquearRow()
        {
            $sql = 'UPDATE cliente SET idEstadoUsuario = 3 WHERE idcliente = ?';
            $params = array($this->idCliente);
            return Database::executeRow($sql, $params);
        }

        //Función para llenar tabla de bitacoraCliente fuera de la sesión
        public function registerActionOut($action, $desc)
        {
            $sql = 'INSERT INTO bitacoraCliente VALUES (DEFAULT, ?, current_date , current_time, ?, ?)';
            $params = array($this->idCliente, $action, $desc);
            return Database::executeRow($sql, $params);
        }

        //Función para obtener los registros de clientes que han pasado 24 horas de block
        public function checkBlockUsers() 
        {
            $sql = 'SELECT idcliente FROM bitacoraCliente
                    WHERE descripcion = \'Bloqueo por clave incorrecta\' 
                    AND fecha <= current_date - 1 AND current_time >= hora';
            $params = null;
            return Database::getRows($sql,$params);
        }

        //Función para actualizar bitacora
        public function updateBitacora()
        {
            $sql = 'UPDATE bitacoraCliente SET descripcion = \'Desbloqueo por clave incorrecta\',
                    accion = \'Desbloqueo\' WHERE idCliente = ? AND descripcion = \'Bloqueo por clave incorrecta\'';
            $params = array($this->idCliente);
            return Database::executeRow($sql, $params);
        }

        //Función para insertar token a la base
        public function updateToken(){
            //Encriptando token
            $hash = password_hash($this->token, PASSWORD_DEFAULT);
            //Subiendo token a la base
            $sql = 'UPDATE cliente
                    SET tokenclave = ?, claverequest = 1
                    WHERE correo = ?';
            $params = array($hash, $this->correo);
            return Database::executeRow($sql, $params);
        }

        //Función para verificar token 
        public function checkToken($tokenIngresado) 
        {
            $sql = 'SELECT tokenclave FROM cliente WHERE correo = ? AND claverequest = 1';
            $params = array($_SESSION['correoCliente']);
            $data = Database::getRow($sql,$params);
            if (password_verify($tokenIngresado, $data['tokenclave'])) {
                return true;
            } else {
                return false;
            }
        }

        //Función para cambiar contraseña por recuperación
        public function changePasswordOut()
        {
            $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
            $sql = 'UPDATE cliente SET contraseña = ? WHERE correo = ?';
            $params = array($hash, $_SESSION['correoCliente']);
            return Database::executeRow($sql, $params);
        }

        //Función para insertar clave request
        public function updateClaveRequest(){
            $sql = 'UPDATE cliente
                    SET claverequest = 0
                    WHERE correo = ?';
            $params = array($_SESSION['correoCliente']);
            return Database::executeRow($sql, $params);
        }

        //Función para llenar tabla de bitacoraCliente fuera de la sesión
        public function registerActionOut2($action, $desc)
        {
            $sql = 'INSERT INTO bitacoraCliente VALUES (DEFAULT, ?, current_date , current_time, ?, ?)';
            $params = array($_SESSION['codigocliente'], $action, $desc);
            return Database::executeRow($sql, $params);
        }

        //Función para obtener el ultimo id
        public function getLastId()
        {
            $sql = 'SELECT MAX(idCliente) as cliente FROM cliente';
            $params =null;
            return Database::executeRow($sql, $params);
        }
    }
