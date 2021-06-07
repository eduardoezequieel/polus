<?php
Class categoria extends Validator{
    private $idCategoria = null;
    private $categoria = null;
    private $imagen = null;
    private $ruta = '../../../resources/img/dashboard_img/admon_fotos/';

    public function setIdCategoria($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idCategoria = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setCategoria($value){
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

    public function getIdCategoria(){
        return $this -> idCategoria;
    }

    public function getCategoria(){
        return $this -> categoria;
    }

    public function getImagen(){
        return $this -> imagen;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function readAll(){
        $sql = 'SELECT*FROM categoria ORDER BY categoria ASC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne(){
        $sql = 'SELECT*FROM categoria WHERE idCategoria = ?';
        $params = array($this -> idCategoria);
        return Database::getRow($sql, $params);
    }

    public function createRow(){
        $sql = 'INSERT INTO categoria(categoria, imagen) VALUES (?,?)';
        $params = array($this -> categoria, $this -> imagen);
        return Database::executeRow($sql, $params);
    }

    public function updateRow($current_image){
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;
        $sql = 'UPDATE categoria SET categoria = ?, imagen = ? WHERE idCategoria = ?';
        $params = array($this->categoria, $this->imagen, $this->idCategoria);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow(){
        $sql = 'DELETE FROM categoria WHERE idCategoria = ?';
        $params = array($this->idCategoria);
        return Database::executeRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT*FROM categoria 
        WHERE categoria ILIKE ? 
        ORDER BY categoria ASC 
        ';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }



}
?>