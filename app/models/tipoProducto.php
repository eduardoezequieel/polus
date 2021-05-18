<?php
//Clase para manejar categoria
Class tipoProducto extends Validator{
    private $idSub = null;
    private $subcategoria = null;
    private $genero = null;
    private $idCategoria = null;

    //Metodos set de la tabla subcategoria

    public function setidSub($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idSub = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setsubcategoria($value){
        if ($this -> validateAlphabetic($value, 1, 25)) {
            $this -> subcategoria = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setgenero($value){
        if ($this->validateAlphabetic($value,1,10)) {
            $this->genero = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setidCategoria($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idCategoria = $value;
            return true;
        }
        else{
            return false;
        }
    }

    //Metodos get de la tabla subcategoria

    public function getidSub(){
        return $this -> idSub;
    }

    public function getsubcategoria(){
        return $this -> subcategoria;
    }

    public function getgenero(){
        return $this -> genero;
    }

    public function getidCategoria(){
        return $this -> idCategoria;
    }

    //Metodos para las operaciones SCRUD

    public function readAll(){
        $sql = 'SELECT idsubcategoria, subcategoria, genero, categoria.categoria FROM subcategoria
        INNER JOIN categoria  on subcategoria.idcategoria = categoria.idcategoria 
        ORDER BY idsubcategoria ASC;';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readcategoria(){
        $sql = 'SELECT*FROM categoria';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne(){
        $sql = 'SELECT*FROM subcategoria WHERE idsubcategoria = ?';
        $params = array($this -> idSub);
        return Database::getRow($sql, $params);
    }   

    public function createRow(){
        $sql = 'INSERT INTO subcategoria(subcategoria,genero,idcategoria) VALUES (?,?,?)';
        $params = array($this -> subcategoria,$this -> genero,$this -> idCategoria);
        return Database::executeRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT idsubcategoria, subcategoria, genero, categoria.categoria FROM subcategoria
        INNER JOIN categoria  on subcategoria.idcategoria = categoria.idcategoria 
        WHERE subcategoria ILIKE ? Or genero ILIKE ?
        ORDER BY idsubcategoria ASC
        ';
        $params = array("%$value%","%$value$%");
        return Database::getRows($sql, $params);
    }

    public function updateRow(){
        $sql = 'UPDATE subcategoria SET subcategoria = ?,genero = ?, idcategoria = ? WHERE idsubcategoria = ?';
        $params = array($this -> subcategoria,$this -> genero, $this -> idCategoria, $this -> idSub);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow(){
        $sql='DELETE FROM subcategoria WHERE idsubcategoria = ?';
        $params=array($this->idSub);
        return Database::executeRow($sql, $params);
    }
}
?>