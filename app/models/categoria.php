<?php
Class categoria extends Validator
{
    //Atributos de la clase categoria
    private $idCategoria = null;
    private $idSubcategoria = null;
    private $categoria = null;
    private $imagen = null;
    private $ruta = '../../../resources/img/dashboard_img/admon_fotos/';

    /*
        Métodos set para los atributos de la clase
    */
    public function setIdCategoria($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idCategoria = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdSubcategoria($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idSubcategoria = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setCategoria($value)
    {
        if ($this -> validateAlphabetic($value, 1, 25)) {
            $this -> categoria = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 4000, 4000)) {
            $this->imagen = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    /*
        Métodos get para los atributos de la clase
    */

    public function getIdCategoria()
    {
        return $this -> idCategoria;
    }

    public function getIdSubcategoria()
    {
        return $this -> idSubcategoria;
    }

    public function getCategoria()
    {
        return $this -> categoria;
    }

    public function getImagen()
    {
        return $this -> imagen;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    //Función para leer todos los registros de la tabla categoria
    public function readAll()
    {
        $sql = 'SELECT*FROM categoria ORDER BY categoria ASC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Función para leer todos los registros de la tabla subcategoria
    public function readAllSub()
    {
        $sql = 'SELECT*FROM subcategoria
                WHERE idcategoria = ? 
                ORDER BY subcategoria ASC';
        $params = array($this -> idCategoria);
        return Database::getRows($sql, $params);
    }

    //Función para leer un registro de la tabla categoria
    public function readOne()
    {
        $sql = 'SELECT*FROM categoria WHERE idCategoria = ?';
        $params = array($this -> idCategoria);
        return Database::getRow($sql, $params);
    }

    //Función para agregar un registro a la tabla categoria
    public function createRow()
    {
        $sql = 'INSERT INTO categoria(categoria, imagen) VALUES (?,?)';
        $params = array($this -> categoria, $this -> imagen);
        return Database::executeRow($sql, $params);
    }

    //Función para actualizar un registro a la tabla categoria
    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;
        $sql = 'UPDATE categoria SET categoria = ?, imagen = ? WHERE idCategoria = ?';
        $params = array($this->categoria, $this->imagen, $this->idCategoria);
        return Database::executeRow($sql, $params);
    }

    //Función para eliminar un registro a la tabla categoria
    public function deleteRow()
    {
        $sql = 'DELETE FROM categoria WHERE idCategoria = ?';
        $params = array($this->idCategoria);
        return Database::executeRow($sql, $params);
    }

    //Función para buscar registros a la tabla categoria
    public function searchRows($value)
    {
        $sql = 'SELECT*FROM categoria 
        WHERE categoria ILIKE ? 
        ORDER BY categoria ASC 
        ';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    //Función para generar reporte productos por categoria
    public function readProductosCategoria()
    {
        $sql = 'SELECT nombre, subcategoria, categoria, precio
                FROM producto 
                INNER JOIN subcategoria USING(idsubcategoria)
                INNER JOIN categoria USING(idcategoria)
                WHERE idcategoria = ? AND idsubcategoria = ?
                ORDER BY nombre';
        $params = array($this->idCategoria, $this->idSubcategoria);
        return Database::getRows($sql, $params);
    }


}
?>