<?php
//Clase para manejar tabla 
Class Marcas extends Validator{
    private $idMarca = null;
    private $nombreMarca = null;

    //Metodos set de la tabla marcas

    public function setIdMarca($value){
        if (this -> validateNaturalNumber($value)) {
            $this -> idMarca = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setNombreMarca($value){
        if (this -> validateAlphabetic($value, 1, 25)) {
            $this -> nombreMarca = $value;
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

    //Metodos para las operaciones SCRUD

    public function readAll(){
        $sql = 'SELECT*FROM marca';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
?>