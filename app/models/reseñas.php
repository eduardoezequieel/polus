<?php
//Clase para manejar tabla 
Class Resenas extends Validator
{
    private $idResena = null;
    private $comentario = null;
    private $idPuntuacion = null;
    private $idEstadoResena = null;
    private $idProducto = null;
    private $respuesta = null;
    private $idCliente = null;
    private $fecha = null;


    /*
        Metodos set de la tabla reseña
    */

    public function setIdResena($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this -> idResena = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEstadoResena($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idEstadoResena = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setComentario($value)
    {
        if ($this -> validateAlphabetic($value, 1, 80)) {
            $this -> comentario = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdPuntuacion($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idPuntuacion = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdProducto($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idProducto = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setRespuesta($value)
    {
        if ($this -> validateAlphabetic($value, 1, 200)) {
            $this -> respuesta = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdCliente($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idCliente = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setFecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    /*
        Metodos get de la tabla reseña
    */

    public function getIdResena()
    {
        return $this -> idResena;
    }

    public function getIdEstadoResena()
    {
        return $this -> idEstadoResena;
    }

    public function getComentario()
    {
        return $this -> comentario;
    }

    public function getIdPuntuacion()
    {
        return $this -> puntuacion;
    }

    public function getIdProducto()
    {
        return $this -> idProducto;
    }

    public function getIdCliente()
    {
        return $this -> idCliente;
    }
    
    public function getRespuesta()
    {
        return $this -> respuesta;
    }

    public function getFecha()
    {
        return $this -> fecha;
    }

    //Función para leer todos los datos de la tabla reseña
    public function readAll()
    {
        $sql='SELECT idResena, CONCAT (cliente.apellido,\'  \', cliente.nombre) AS cliente, fecha, hora, 
        puntuacion.puntuacion, estadoresena.estadoresena
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN cliente ON resena.idcliente = cliente.idcliente
        INNER JOIN estadoResena ON resena.idestadoresena = estadoresena.idestadoresena
        WHERE idProducto = ?
        ';
        $params=array($this -> idProducto);
        return Database::getRows($sql, $params);
    }

    //Funcion para obtener el promedio de los productos con mejor puntuación
    public function bestScore()
    {
        $sql = 'SELECT avg(idpuntuacion) as Promedio, count(idpuntuacion) as Puntuaciones, producto.nombre FROM resena 
                INNER JOIN producto USING (idproducto)
                GROUP BY producto.idproducto
                ORDER BY promedio DESC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Función para buscar registros en la tabla reseña
    public function searchRows($value)
    {
        $sql='SELECT idResena, CONCAT (cliente.apellido,\'  \', cliente.nombre) AS cliente, fecha, hora, 
        puntuacion.puntuacion, estadoresena.estadoresena
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN cliente ON resena.idcliente = cliente.idcliente
        INNER JOIN estadoResena ON resena.idestadoresena = estadoresena.idestadoresena
        WHERE cliente.apellido ILIKE ? OR cliente.nombre ILIKE ? OR puntuacion.puntuacion ILIKE ? AND idproducto = ?
        ';
        $params = array("%$value%","%$value%","%$value%",$this->idProducto);
        return Database::getRows($sql, $params);
    }

    //Función para buscar registros en la tabla reseña por la fecha
    public function searchRowsDate()
    {
        $sql='SELECT idResena, CONCAT (cliente.apellido,\'  \', cliente.nombre) AS cliente, fecha, hora, 
        puntuacion.puntuacion, estadoresena.estadoresena
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN cliente ON resena.idcliente = cliente.idcliente
        INNER JOIN estadoResena ON resena.idestadoresena = estadoresena.idestadoresena
        WHERE idproducto = ? AND fecha = ?
        ';
        $params = array($this->idProducto, $this->fecha);
        return Database::getRows($sql, $params);
    }

    //Función para buscar registros en la tabla reseña por la estado
    public function searchRowsState()
    {
        $sql='SELECT idResena, CONCAT (cliente.apellido,\'  \', cliente.nombre) AS cliente, fecha, hora, 
        puntuacion.puntuacion, estadoresena.estadoresena
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN cliente ON resena.idcliente = cliente.idcliente
        INNER JOIN estadoResena ON resena.idestadoresena = estadoresena.idestadoresena
        WHERE idproducto = ? AND resena.idestadoresena = ?
        ';
        $params = array($this->idProducto, $this->idEstadoResena);
        return Database::getRows($sql, $params);
    }

    //Función para leer un registro de la tabla reseña
    public function readOne()
    {
        $sql = 'SELECT idResena, hora, fecha, puntuacion.puntuacion, producto.nombre, CONCAT(cliente.apellido,\'  \', cliente.nombre) as Cliente, producto.precio, comentario, respuesta, idestadoresena
        FROM resena 
        INNER JOIN puntuacion ON resena.idpuntuacion = puntuacion.idpuntuacion 
        INNER JOIN producto ON resena.idproducto = producto.idproducto 
        INNER JOIN cliente ON resena.idcliente = cliente.idcliente 
        WHERE idResena = ?';
        $params = array($this->idResena);
        return Database::getRow($sql, $params);
    }

    //Función para crear o actualizar la respuesta del comentario en la tabla reseña
    public function createOrUpdateAnswer()
    {
        $sql = 'UPDATE resena SET respuesta = ? WHERE idResena = ?';
        $params = array($this->respuesta, $this ->idResena);
        return Database::executeRow($sql, $params);
    }

    //Función para eliminar un registro en la tabla reseña
    public function deleteComment()
    {
        $sql = 'DELETE FROM resena WHERE idresena = ?';
        $params = array($this->idResena);
        return Database::executeRow($sql, $params);
    }

    //Función para mostrar un comentario de la tabla reseña
    public function showComment()
    {
        $sql = 'UPDATE resena SET idEstadoResena = 1 WHERE idResena = ?';
        $params = array($this -> idResena);
        return Database::executeRow($sql, $params);
    }

    //Función para esconder un comentario de la tabla reseña
    public function hideComment()
    {
        $sql = 'UPDATE resena SET idEstadoResena = 2 WHERE idResena = ?';
        $params = array($this -> idResena);
        return Database::executeRow($sql, $params);
    }

    //Función para leer todos los estados de la reseña
    public function readAllStates()
    {
        $sql = 'SELECT*FROM estadoResena';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Función para leer todos los registros de la tabla puntuacion
    public function readpuntuacion()
    {
        $sql = 'SELECT*FROM puntuacion';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Función para crear un registro en la tabla reseña
    public function createRow()
    {
        $sql = 'INSERT INTO resena(comentario,idpuntuacion,idproducto,idcliente,fecha,hora, idestadoresena) VALUES (?,?,?,?,current_date,current_time, 1)';
        $params = array($this -> comentario,$this -> idPuntuacion,$this -> idProducto, $_SESSION['idCliente']);
        return Database::executeRow($sql, $params);
    
    }

    //Función para leer los comentarios hechos en un producto
    public function readComments()
    {
        $sql = 'SELECT CONCAT(cliente.nombre,\'  \', cliente.apellido) AS cliente, comentario 
        FROM resena 
        INNER JOIN cliente ON resena.idcliente = cliente.idcliente 
        WHERE idproducto = ? AND
        idestadoresena = 1';
        $params = array($this->idProducto);
        return Database::getRows($sql, $params);
    }

    //Función para generar titulo de reporte de comentarios por cliente
    public function readClient()
    {
        $sql = 'SELECT idcliente, CONCAT(apellido, \', \', nombre) as cliente 
                FROM cliente
                WHERE idcliente = ?';
        $params = array($this->idCliente);
        return Database::getRow($sql, $params);
    }

    //Función para generar reporte de comentarios por cliente
    public function readCommentsClient()
    {
        $sql = 'SELECT comentario, producto.nombre AS producto
                FROM resena
                INNER JOIN puntuacion USING(idpuntuacion)
                INNER JOIN cliente USING(idcliente)
                INNER JOIN producto USING(idproducto)
                WHERE idcliente = ? AND idpuntuacion = ?';
        $params = array($this->idCliente, $this->idPuntuacion);
        return Database::getRows($sql, $params);
    }
}
?>