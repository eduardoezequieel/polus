<?php

    Class Productos extends Validator{

        //Atributos de la clase
        private $idProducto = null;
        private $nombre = null;
        private $descripcion = null;
        private $precio = null;
        private $imagenPrincipal = null;
        private $idSubcategoria = null;
        private $idMarca = null;
        private $ruta = '../../../resources/img/dashboard_img/producto_fotos/';
        private $idCategoria = null;

        //Métodos set
        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idProducto = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setNombre($value)
        {
            if ($this->validateAlphabetic($value,1,30)) {
                $this->nombre = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setDescripcion($value)
        {
            if ($this->validateString($value,1,120)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setPrecio($value)
        {
            if ($this->validateMoney($value)) {
                $this->precio = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setImagenPrincipal($file)
        {
            if ($this->validateImageFile($file, 4000, 4000)) {
                $this->imagenPrincipal = $this->getImageName();
                return true;
            } else {
                return false;
            }
        }

        public function setSubcategoria($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idSubcategoria = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setMarca($value)
        {
            if ($this->validateBoolean($value)) {
                $this->idMarca = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdCategoria($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idCategoria = $value;
                return true;
            } else {
                return false;
            }
        }

        //Métodos get
        public function getId()
        {
            return $this->idProducto;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function getDescripcion()
        {
            return $this->descripcion;
        }

        public function getPrecio()
        {
            return $this->precio;
        }

        public function getImagenPrincipal()
        {
            return $this->imagenPrincipal;
        }

        public function getSubcategoria()
        {
            return $this->idSubcategoria;
        }

        public function getMarca()
        {
            return $this->idMarca;
        }

        public function getRuta()
        {
            return $this->ruta;
        }

        public function getIdCategoria()
        {
            return $this->idCategoria;
        }

        //Método para leer todo
        public function readAll()
        {
            $sql = 'SELECT idProducto, imagenPrincipal, nombre, descripcion, precio, subcategoria, marca
                    FROM producto
                    INNER JOIN subcategoria ON subcategoria.idSubcategoria = producto.idSubcategoria
                    INNER JOIN marca ON marca.idMarca = producto.idMarca
                    ORDER BY nombre';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readAllPublic(){
            $sql = 'SELECT idProducto, imagenPrincipal, nombre, descripcion, precio, subcategoria, marca
            FROM producto
            INNER JOIN subcategoria ON subcategoria.idSubcategoria = producto.idSubcategoria
            INNER JOIN marca ON marca.idMarca = producto.idMarca
            INNER JOIN categoria ON subcategoria.idcategoria = categoria.idcategoria
            WHERE categoria.idcategoria = ?
            ORDER BY nombre';
            $params = array($this -> idCategoria);
            return Database::getRows($sql, $params);
        }

        //Métodos para llenar combobox
        public function readAllSubcategorias()
        {
            $sql = 'SELECT idSubcategoria, CONCAT(subcategoria, \' - \', genero) as subcategoria
                    FROM subcategoria';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readAllMarca()
        {
            $sql = 'SELECT * FROM marca';
            $params = null;
            return Database::getRows($sql, $params);
        }
        
        public function readMax()
        {
            $sql = 'SELECT MAX(idProducto) as idproducto From producto';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Leer solo un registro
        public function readOne()
        {
            $sql = 'SELECT idProducto, imagenPrincipal, nombre, descripcion, precio, idSubcategoria, idMarca
                    FROM producto
                    WHERE idProducto = ?';
            $params = array($this->idProducto);
            return Database::getRow($sql, $params);
        }

        //Método para buscar
        public function searchRows($value)
        {
            $sql = 'SELECT idProducto, imagenPrincipal, nombre, descripcion, precio, subcategoria, marca
                    FROM producto
                    INNER JOIN subcategoria ON subcategoria.idSubcategoria = producto.idSubcategoria
                    INNER JOIN marca ON marca.idMarca = producto.idMarca
                    WHERE nombre ILIKE ? OR descripcion ILIKE ?
                    ORDER BY nombre';
            $params = array("%$value%", "%$value%");
            return Database::getRows($sql, $params);
        }

        //Método para crear
        public function createRow()
        {
            $sql = 'INSERT INTO producto(nombre, descripcion, precio, imagenPrincipal, idSubcategoria, idMarca) 
                    VALUES(?,?,?,?,?,?)';
            $params = array($this->nombre, $this->descripcion, $this->precio, $this->imagenPrincipal, $this->idSubcategoria, 
                            $this->idMarca);
            return Database::executeRow($sql, $params);
        }

        //Método para crear
        public function createRowImagen()
        {
            $sql = 'INSERT INTO imagenProducto(imagen, idProducto) 
                    VALUES(?,?)';
            $params = array($this->imagenPrincipal, $this->idProducto);
            return Database::executeRow($sql, $params);
        }

        //Método para actualizar
        public function updateRow($current_image)
        {
            // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
            ($this->imagenPrincipal) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagenPrincipal = $current_image;

            $sql = 'UPDATE producto
                    SET imagenPrincipal = ?, nombre = ?, descripcion = ?, precio = ?, idSubcategoria = ?, idMarca = ?
                    WHERE idProducto = ?';
            $params = array($this->imagenPrincipal, $this->nombre, $this->descripcion, $this->precio, $this->idSubcategoria, 
                            $this->idMarca, $this->idProducto);
            return Database::executeRow($sql, $params);
        }

        //Método para eliminar
        public function deleteRow(){
            $sql = 'DELETE FROM producto WHERE idProducto = ?';
            $params = array($this->idProducto);
            return Database::executeRow($sql, $params);
        }
    }
?>