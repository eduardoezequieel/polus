<?php
 Class Pedidos extends Validator{
     
    //Campos de la tabla pedido
     private $idPedido = null;
     private $fechaPedido = null;
     private $idEstadoPedido = null;
     private $idCliente = null;

    //Campos de la tabla detallePedido
    private $idDetallePedido = null;
    private $cantidad = null;
    private $precioProducto = null;
    private $idFKPedido = null;
    private $idProducto = null;

    //Metodos get y set de la tabla pedido

    public function setIdPedido($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idPedido = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setFechaPedido($value)
    {
        if ($this->validateDate($value)) {
            $this->fechaPedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEstadoPedido($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idEstadoPedido = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdCliente($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idCliente = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function getIdPedido(){
        return $this -> idPedido;
    }

    public function getFechaPedido(){
        return $this -> fechaPedido;
    }

    public function getIdEstadoPedido(){
        return $this -> idEstadoPedido;
    }

    public function getIdCliente(){
        return $this -> idCliente;
    }

    //Metodos get y set de la tabla detallePedido

    public function setIdDetallePedido($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idDetallePedido = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setCantidad($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> cantidad = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setPrecioProducto($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> precioProducto = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdFKPedido($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idFKPedido = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdProducto($value){
        if ($this -> validateNaturalNumber($value)) {
            $this -> idProducto = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function getIdDetallePedido(){
        return $this -> idDetallePedido;
    }

    public function getCantidad(){
        return $this -> cantidad;
    }

    public function getPrecioProducto(){
        return $this -> precioProducto;
    }

    public function getIdFKPedido(){
        return $this -> idFKPedido;
    }

    public function getIdProducto(){
        return $this -> idProducto;
    }

    public function readAll(){
        $sql = 'SELECT idpedido, CONCAT(cliente.apellido,\'  \',cliente.nombre) AS cliente, fechaPedido, estadopedido.estadoPedido 
        FROM pedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente 
        INNER JOIN estadoPedido ON pedido.idestadopedido = estadopedido.idestadopedido
        ORDER BY cliente ASC;';
        $params = null;
        return Database::getRows($sql,$params);
    }

    public function readOne(){
        $sql = 'SELECT idpedido, CONCAT(cliente.apellido,\'  \',cliente.nombre) 
        AS cliente, fechaPedido, estadopedido.estadoPedido, cliente.direccion, cliente.idcliente 
        FROM pedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente 
        INNER JOIN estadoPedido on pedido.idestadopedido = estadopedido.idestadopedido 
        WHERE idpedido = ?';
        $params = array($this -> idPedido);
        return Database::getRow($sql, $params);
    }

    public function getProducts(){
        $sql = 'SELECT producto.nombre, cantidad FROM detallePedido 
        INNER JOIN producto ON producto.idproducto = detallePedido.idproducto 
        WHERE idpedido = ?;';
        $params = array($this -> idPedido);
        return Database::getRows($sql, $params);
    }

    public function getTotalPrice(){
        $sql= 'SELECT sum(precioproducto) as TotalPedido 
        FROM detallePedido 
        WHERE idpedido = ?';
        $params = array($this -> idPedido);
        return Database::getRow($sql, $params);
    }

    public function readAllEstadoPedido(){
        $sql = 'SELECT*FROM estadoPedido';
        $params = null;
        return Database::getRows($sql,$params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT idpedido, CONCAT(cliente.apellido,\'  \',cliente.nombre) AS cliente, fechaPedido, estadopedido.estadoPedido 
        FROM pedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente 
        INNER JOIN estadoPedido ON pedido.idestadopedido = estadopedido.idestadopedido
        WHERE cliente.apellido ILIKE ? OR cliente.nombre ILIKE ? 
        ORDER BY cliente ASC;
        ';
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }

    public function searchRowsEstadoPedido()
    {
        $sql = 'SELECT idpedido, CONCAT(cliente.apellido,\'  \',cliente.nombre) AS cliente, fechaPedido, estadopedido.estadoPedido 
        FROM pedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente 
        INNER JOIN estadoPedido ON pedido.idestadopedido = estadopedido.idestadopedido
        WHERE pedido.idestadopedido = ?
        ORDER BY cliente ASC;';
        $params = array($this -> idEstadoPedido);
        return Database::getRows($sql, $params);
    }

    public function cancelOrder(){
        $sql = 'UPDATE pedido SET idestadopedido = 3 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    public function deliverOrder(){
        $sql = 'UPDATE pedido SET idestadopedido = 4 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    public function activateOrder(){
        $sql = 'UPDATE pedido SET idestadopedido = 1 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    public function finishOrder(){
        $sql = 'UPDATE pedido SET idestadopedido = 2 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    public function readClient(){
        $sql = 'SELECT*
        FROM cliente 
        WHERE idCliente = ?';
        $params = array($this->idCliente);
        return Database::getRow($sql, $params);
    }

 }
?>