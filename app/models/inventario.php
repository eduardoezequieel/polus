<?php

    Class Inventario extends Validator{

        //Atributos de la clase
        private $idInventario = null;
        private $cantidad = null;
        private $idProducto = null;
        private $idTalla = null;

        //Método set 
        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idInventario = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setCantidad($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->cantidad = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdProducto($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idProducto = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdTalla($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idTalla = $value;
                return true;
            } else {
                return false;
            }
        }

        //Métodos get
        public function getId()
        {
            return $this->idInventario;
        }

        public function getCantidad()
        {
            return $this->cantidad;

        }

        public function getIdProducto()
        {
            return $this->idProducto;
        }

        public function getIdTalla()
        {
            return $this->idTalla;
        }

        //Método para leer todo
        public function readAll()
        {
            $sql = 'SELECT idInventario, cantidad, nombre, talla 
                    FROM inventario 
                    INNER JOIN producto ON producto.idProducto = inventario.idProducto
                    INNER JOIN talla ON talla.idTalla = inventario.idTalla
                    ORDER BY cantidad';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Método para combobox
        public function readAllProducto()
        {
            $sql = 'SELECT idProducto, nombre FROM producto';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readAllTalla()
        {
            $sql = 'SELECT idTalla, CONCAT(talla,\' - \', genero) as talla FROM talla';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Leer solo un registro
        public function readOne()
        {
            $sql = 'SELECT idInventario, cantidad, idProducto, idTalla
                    FROM inventario
                    WHERE idInventario = ?';
            $params = array($this->idInventario);
            return Database::getRow($sql, $params);
        }

        //Método para buscar
        public function searchRows($value)
        {
            $sql = 'SELECT idInventario, cantidad, nombre, talla 
                    FROM inventario 
                    INNER JOIN producto ON producto.idProducto = inventario.idProducto
                    INNER JOIN talla ON talla.idTalla = inventario.idTalla
                    WHERE nombre ILIKE ?
                    ORDER BY cantidad';
            $params = array("%$value%");
            return Database::getRows($sql, $params);
        }

        //Método para crear
        public function createRow()
        {
            $sql = 'INSERT INTO inventario(cantidad, idProducto, idTalla) 
                    VALUES(?, ?, ?)';
            $params = array($this->cantidad, $this->idProducto, $this->idTalla);
            return Database::executeRow($sql, $params);
        }

        //Método para actualizar
        public function updateRow()
        {
            $sql = 'UPDATE inventario
                    SET cantidad = ?, idProducto = ?, idTalla = ?
                    WHERE idInventario = ?';
            $params = array($this->cantidad, $this->idProducto, $this->idTalla, $this->idInventario);
            return Database::executeRow($sql, $params);
        }

         //Método para eliminar
         public function deleteRow(){
            $sql = 'DELETE FROM inventario WHERE idInventario = ?';
            $params = array($this->idInventario);
            return Database::executeRow($sql, $params);
        }
    }
?>