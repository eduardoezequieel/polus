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
            if($value > 0){
                $this -> cantidad = $value;
                return true;
            } else{
                return false;
            }
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

    public function readClientsRecord(){
        $sql = 'SELECT idpedido, fechapedido, estadopedido.estadopedido FROM pedido 
        INNER JOIN estadopedido ON pedido.idestadopedido = estadopedido.idestadopedido
        WHERE idcliente = ?';
        $params = array($this->idCliente);
        return Database::getRows($sql, $params);
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

    public function checkInventario(){
        $sql = 'SELECT cantidad - ? as resta FROM inventario WHERE idProducto = ?';
        $params = array($this->cantidad, $this->idProducto);
        return Database::getRows($sql, $params);
    }

     // Método para agregar un producto al carrito de compras.
     public function createDetail()
     {
         // Se realiza una subconsulta para obtener el precio del producto.
         $sql = 'INSERT INTO detallePedido(cantidad, precioProducto, idPedido, idProducto)
                 VALUES(?, (SELECT precio FROM producto WHERE idProducto = ?), ?, ?)';
         $params = array($this->cantidad, $this->idProducto, $this->idPedido, $this->idProducto);
         return Database::executeRow($sql, $params);
     }
    
     // Método para obtener los productos que se encuentran en el carrito de compras.
    public function readOrderDetail()
    {
        $sql = 'SELECT idDetallePedido, nombre, detallePedido.precioProducto, detallePedido.cantidad
                FROM pedido INNER JOIN detallePedido USING(idPedido) INNER JOIN producto USING(idProducto)
                WHERE idPedido = ?';
        $params = array($this->idPedido);
        return Database::getRows($sql, $params);
    }

    // Método para eliminar un producto que se encuentra en el carrito de compras.
    public function deleteDetail()
    {
        $sql = 'DELETE FROM detallePedido
                WHERE idDetallePedido = ? AND idPedido = ?';
        $params = array($this->idDetallePedido, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    public function startOrder()
    {
        $this->estado = 1;

        $sql = 'SELECT idPedido
                FROM pedido
                WHERE idEstadoPedido = ? AND idCliente = ?';
        $params = array($this->estado, $_SESSION['idCliente']);
        if ($data = Database::getRow($sql, $params)) {
            $this->idPedido = $data['idpedido'];
            return true;
        } else {
            $sql = 'INSERT INTO pedido(fechaPedido, idEstadoPedido, idCliente)
                    VALUES(current_date,?, ?)';
            $params = array($this->estado, $_SESSION['idCliente']);
            // Se obtiene el ultimo valor insertado en la llave primaria de la tabla pedidos.
            if ($this->idPedido = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }

        // Método para finalizar un pedido por parte del cliente.
        public function finishOrderCart()
        {
            // Se establece la zona horaria local para obtener la fecha del servidor.
            date_default_timezone_set('America/El_Salvador');
            $date = date('Y-m-d');
            $this->estado = 4;
            $sql = 'UPDATE pedido
                    SET idEstadoPedido = ?, fechaPedido = ?
                    WHERE idPedido = ?';
            $params = array($this->estado, $date, $_SESSION['idPedido']);
            return Database::executeRow($sql, $params);
        }

 }
?>