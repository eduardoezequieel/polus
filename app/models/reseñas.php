<?php
//Clase para manejar tabla 
Class Resenas extends Validator{
    private $idResena = null;
    private $comentario = null;
    private $idPuntuacion = null;
    private $idDetallePedido = null;
    private $respuesta = null;


    //Metodos set de la tabla marcas

    public function setIdResena($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idResena = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setComentario($value){
        if ($this -> validateAlphabetic($value, 1, 80)) {
            $this -> comentario = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdPuntuacion($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idPuntuacion = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdDetallePedido($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idDetallePedido = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setRespuesta($value){
        if ($this -> validateAlphabetic($value, 1, 200)) {
            $this -> respuesta = $value;
            return true;
        }
        else{
            return false;
        }
    }

    //Metodos get de la tabla marcas

    public function getIdResena(){
        return $this -> idResena;
    }

    public function getComentario(){
        return $this -> comentario;
    }

    public function getIdPuntuacion(){
        return $this -> puntuacion;
    }

    public function getIdDetallePedido(){
        return $this -> idDetallePedido;
    }
    
    public function getRespuesta(){
        return $this -> respuesta;
    }

    //Metodos para las operaciones SCRUD

    public function readAll(){
        $sql='SELECT idResena, CONCAT (cliente.apellido,\'  \', cliente.nombre) AS cliente, pedido.fechapedido, 
        puntuacion.puntuacion 
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente
        WHERE idproducto = ?
        ';
        $params=null;
        return Database::getRows($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT CONCAT (cliente.apellido,\'  \', cliente.nombre) AS cliente, pedido.fechapedido, 
        puntuacion.puntuacion 
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN detallepedido on resena.iddetallepedido = detallepedido.iddetallepedido 
        INNER JOIN pedido ON detallepedido.idpedido = pedido.idpedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente
        WHERE cliente.apellido ILIKE ? OR cliente.nombre ILIKE ? OR puntuacion.puntuacion ILIKE ?
        ';
        $params = array("%$value%","%$value%","%$value%");
        return Database::getRows($sql, $params);
    }

    public function readOne(){
        $sql = 'SELECT idResena, CONCAT (cliente.apellido,\'  \', cliente.nombre) AS cliente, pedido.fechapedido, 
        puntuacion.puntuacion, detallepedido.idpedido, comentario, respuesta
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN detallepedido on resena.iddetallepedido = detallepedido.iddetallepedido 
        INNER JOIN pedido ON detallepedido.idpedido = pedido.idpedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente 
        WHERE idresena = ?';
        $params = array($this->idResena);
        return Database::getRow($sql, $params);
    }

    public function createOrUpdateAnswer(){
        $sql = 'UPDATE resena SET respuesta = ? WHERE idResena = ?';
        $params = array($this->respuesta, $this ->idResena);
        return Database::executeRow($sql, $params);
    }

    public function deleteComment(){
        $sql = 'DELETE FROM resena WHERE idresena = ?';
        $params = array($this->idResena);
        return Database::executeRow($sql, $params);
    }
}
?>