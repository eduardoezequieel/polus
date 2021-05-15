<?php
//Clase para manejar tabla 
Class Marcas extends Validator{
    private $idMarca = null;
    private $nombreMarca = null;
    private $idEstadoMarca = null;

    //Metodos set de la tabla marcas

    public function setIdMarca($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idMarca = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setNombreMarca($value){
        if ($this -> validateAlphabetic($value, 1, 25)) {
            $this -> nombreMarca = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdEstadoMarca($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idEstadoMarca = $value;
            return true;
        }
        else{
            return false;
        }
    }

    //Metodos get de la tabla marcas

    public function getIdMarca(){
        return $this -> idMarca;
    }

    public function getNombreMarca(){
        return $this -> nombreMarca;
    }

    public function getIdEstadoMarca(){
        return $this -> idEstadoMarca;
    }

    //Metodos para las operaciones SCRUD

    public function readAll(){
        $sql = 'SELECT idmarca, marca, e.estadomarca FROM marca m 
        INNER JOIN estadoMarca e on m.idestadomarca = e.idestadomarca 
        ORDER BY marca ASC;';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readEstadoMarca(){
        $sql = 'SELECT*FROM estadoMarca';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne(){
        $sql = 'SELECT*FROM marca WHERE idMarca = ?';
        $params = array($this -> idMarca);
        return Database::getRow($sql, $params);
    }

    public function createRow(){
        $sql = 'INSERT INTO marca(marca,idestadomarca) VALUES (?,1)';
        $params = array($this -> nombreMarca);
        return Database::executeRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT idmarca, marca, e.estadomarca FROM marca m 
        INNER JOIN estadoMarca e on m.idestadomarca = e.idestadomarca
        WHERE marca ILIKE ?
        ORDER BY marca ASC
        ';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function updateRow(){
        $sql = 'UPDATE marca SET marca = ?, idestadomarca = ? WHERE idMarca = ?';
        $params = array($this -> nombreMarca, $this -> idEstadoMarca, $this -> idMarca);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow(){
        $sql='DELETE FROM marca WHERE idMarca = ?';
        $params=array($this->idMarca);
        return Database::executeRow($sql, $params);
    }
}
?>