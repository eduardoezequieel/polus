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

    //Campos de la tabla inventario
    private $idInventario = null;
    private $idTalla = null;

    private $stockReal = null;


    //Metodos get y set de la tabla pedido

    public function setIdPedido($value)
    {
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

    public function setIdEstadoPedido($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idEstadoPedido = $value;
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

    public function getIdPedido()
    {
        return $this -> idPedido;
    }

    public function getFechaPedido()
    {
        return $this -> fechaPedido;
    }

    public function getIdEstadoPedido()
    {
        return $this -> idEstadoPedido;
    }

    public function getIdCliente()
    {
        return $this -> idCliente;
    }

    //Metodos get y set de la tabla detallePedido

    public function setIdDetallePedido($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idDetallePedido = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setCantidad($value)
    {
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

    public function setStockReal($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            if($value > 0){
                $this -> stockReal = $value;
                return true;
            } else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function setPrecioProducto($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> precioProducto = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdFKPedido($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idFKPedido = $value;
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

    public function getIdDetallePedido()
    {
        return $this -> idDetallePedido;
    }

    public function getCantidad()
    {
        return $this -> cantidad;
    }

    public function getStockReal()
    {
        return $this -> stockReal;
    }


    public function getPrecioProducto()
    {
        return $this -> precioProducto;
    }

    public function getIdFKPedido()
    {
        return $this -> idFKPedido;
    }

    public function getIdProducto()
    {
        return $this -> idProducto;
    }

    //Métodos get y set de la tabla inventario
    public function setIdInventario($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idInventario = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function setIdTalla($value)
    {
        if ($this -> validateNaturalNumber($value)) {
            $this -> idTalla = $value;
            return true;
        }
        else{
            return false;
        }
    }

    public function getIdInventario()
    {
        return $this -> idInventario;
    }

    public function getIdTalla()
    {
        return $this -> idTalla;
    }

    //Método para leer todos la tabla de la tabla pedido
    public function readAll()
    {
        $sql = 'SELECT idpedido, CONCAT(cliente.apellido,\'  \',cliente.nombre) AS cliente, fechaPedido, estadopedido.estadoPedido 
        FROM pedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente 
        INNER JOIN estadoPedido ON pedido.idestadopedido = estadopedido.idestadopedido
        ORDER BY cliente ASC;';
        $params = null;
        return Database::getRows($sql,$params);
    }

    //Función para leer todos los pedidos que ha hecho el cliente
    public function readClientsRecord()
    {
        $sql = 'SELECT idpedido, fechapedido, estadopedido.estadopedido FROM pedido 
        INNER JOIN estadopedido ON pedido.idestadopedido = estadopedido.idestadopedido
        WHERE idcliente = ?';
        $params = array($_SESSION['idCliente']);
        return Database::getRows($sql, $params);
    }

    //Función para leer solo un registro 
    public function readOne()
    {
        $sql = 'SELECT idpedido, CONCAT(cliente.apellido,\'  \',cliente.nombre) 
        AS cliente, fechaPedido, estadopedido.estadoPedido, cliente.direccion, cliente.idcliente 
        FROM pedido 
        INNER JOIN cliente ON pedido.idcliente = cliente.idcliente 
        INNER JOIN estadoPedido on pedido.idestadopedido = estadopedido.idestadopedido 
        WHERE idpedido = ?';
        $params = array($this -> idPedido);
        return Database::getRow($sql, $params);
    }

    //Función para leer el detalle de los pedidos
    public function getProducts()
    {
        $sql = 'SELECT producto.nombre, cantidad FROM detallePedido 
        INNER JOIN producto ON producto.idproducto = detallePedido.idproducto 
        WHERE idpedido = ?;';
        $params = array($this -> idPedido);
        return Database::getRows($sql, $params);
    }

    //Función para crear el precio total del pedido
    public function getTotalPrice()
    {
        $sql= 'SELECT sum(precioproducto) as TotalPedido 
        FROM detallePedido 
        WHERE idpedido = ?';
        $params = array($this -> idPedido);
        return Database::getRow($sql, $params);
    }

    //Función para llenar combobox de estado pedido
    public function readAllEstadoPedido()
    {
        $sql = 'SELECT*FROM estadoPedido';
        $params = null;
        return Database::getRows($sql,$params);
    }

    //Función para buscar pedidos por el nombre y apellido del cliente
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

    //Función para buscar pedidos por su estado
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

    //Función para cancelar una orden
    public function cancelOrder()
    {
        $sql = 'UPDATE pedido SET idestadopedido = 3 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    //Función para entregar una orden
    public function deliverOrder()
    {
        $sql = 'UPDATE pedido SET idestadopedido = 4 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    //Función para activar una orden
    public function activateOrder()
    {
        $sql = 'UPDATE pedido SET idestadopedido = 1 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    //Función para finalizar una orden
    public function finishOrder()
    {
        $sql = 'UPDATE pedido SET idestadopedido = 2 WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    //Método para leer todo lo del cliente
    public function readClient()
    {
        $sql = 'SELECT*
        FROM cliente 
        WHERE idCliente = ?';
        $params = array($this->idCliente);
        return Database::getRow($sql, $params);
    }

    //Método para verificar si el cliente tiene algún pedido activo
    public function checkClientePedidoActivo()
    {
        $sql = 'SELECT idpedido
                FROM pedido
                WHERE idcliente = ? AND idestadopedido = 1';
        $params = array($_SESSION['idCliente']);
        if ($data = Database::getRow($sql,$params)) {
            $this->idPedido = $data['idpedido'];
            return true;
        } else {
            return false;
        }
    }

    //Método para leer el detalle de producto
    public function checkClothes() 
    {
        $sql = 'SELECT nombre, subcategoria, categoria FROM producto
                INNER JOIN subcategoria ON subcategoria.idsubcategoria = producto.idsubcategoria
                INNER JOIN categoria ON categoria.idcategoria = subcategoria.idcategoria
                WHERE idproducto = ? AND categoria = \'Ropa\'';
        $params = array($this->idProducto);
        return Database::getRow($sql,$params);
    }

    //Función para leer las tallas registradas en el inventario de un producto
    public function readTallaProducto() 
    {
        $sql = 'SELECT talla.idtalla, CONCAT(talla, \' - \', genero) FROM producto
                INNER JOIN inventario ON inventario.idproducto = producto.idproducto
                INNER JOIN talla ON talla.idtalla = inventario.idtalla
                WHERE producto.idproducto = ? GROUP BY talla.idtalla';
         $params = array($this->idProducto);
         return Database::getRows($sql,$params);
    }

     //Método para leer el producto que no sea ropa
     public function readClothesDetail() 
     {
         $sql = 'SELECT nombre, precio, marca, imagenprincipal FROM producto
                 INNER JOIN marca ON marca.idmarca = producto.idmarca
                 WHERE producto.idproducto = ?';
          $params = array($this->idProducto);
          return Database::getRow($sql,$params);
     }

    //Método para leer la cantidad en stock según la talla
    public function showClothesStock() 
    {
        $sql = 'SELECT cantidad FROM producto
                INNER JOIN inventario ON inventario.idproducto = producto.idproducto
                INNER JOIN talla ON talla.idtalla = inventario.idtalla
                WHERE producto.idproducto = ? AND inventario.idtalla = ?';
         $params = array($this->idProducto, $this->idTalla);
         return Database::getRow($sql,$params);
    }

    //Método para leer la cantidad en stock según la talla en el carrito
    public function showClothesStockCart() 
    {
        $sql = 'SELECT cantidad + ? AS cantidad FROM producto
                INNER JOIN inventario ON inventario.idproducto = producto.idproducto
                INNER JOIN talla ON talla.idtalla = inventario.idtalla
                WHERE producto.idproducto = ? AND inventario.idtalla = ?';
         $params = array($this->cantidad,$this->idProducto, $this->idTalla);
         return Database::getRow($sql,$params);
    }

    //Método para leer el producto que no sea ropa
    public function readNoClothesDetail() 
    {
        $sql = 'SELECT nombre, cantidad, precio, marca, imagenprincipal FROM producto
                INNER JOIN marca ON marca.idmarca = producto.idmarca
                INNER JOIN inventario ON inventario.idproducto = producto.idproducto
                WHERE producto.idproducto = ?';
         $params = array($this->idProducto);
         return Database::getRow($sql,$params);
    }

    //Método para leer el producto que no sea ropa en el carrito
    public function readNoClothesDetailCart() 
    {
        $sql = 'SELECT nombre, cantidad + ? AS cantidad, precio, marca, imagenprincipal FROM producto
                INNER JOIN marca ON marca.idmarca = producto.idmarca
                INNER JOIN inventario ON inventario.idproducto = producto.idproducto
                WHERE producto.idproducto = ?';
         $params = array($this->cantidad, $this->idProducto);
         return Database::getRow($sql,$params);
    }

    //Función para checkear cantidad de producto en stock
    public function checkStock(){
        $sql = 'SELECT cantidad + ? as stockreal 
                FROM inventario 
                WHERE idProducto = ? AND idtalla = ?';
        $params = array($this->cantidad, $this->idProducto);
        if ($this->stockReal = Database::getRows($sql, $params)) {
            return true;
        } else {
            return false;
        }
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
        $sql = 'SELECT idDetallePedido, nombre, detallePedido.precioProducto, detallePedido.cantidad,detallePedido.idproducto
                FROM pedido INNER JOIN detallePedido USING(idPedido) INNER JOIN producto USING(idProducto)
                WHERE idPedido = ? AND idestadopedido = 1';
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

    //Función para restar la cantidad adquirida en el pedido 
    public function minusStock() 
    {
        $sql = 'UPDATE inventario SET cantidad =((SELECT cantidad FROM producto
                INNER JOIN inventario ON inventario.idproducto = producto.idproducto
                INNER JOIN talla ON talla.idtalla = inventario.idtalla
                WHERE producto.idproducto = ? AND inventario.idtalla = ?) - ?)
                WHERE idproducto = ? AND idtalla = ?';
        $params = array($this->idProducto, $this->idTalla,$this->cantidad,$this->idProducto,$this->idTalla);
        return Database::executeRow($sql,$params);
    }

    //Función para restar la cantidad adquirida en el pedido 
    public function plusStock() 
    {
        $sql = 'UPDATE inventario SET cantidad =((SELECT cantidad FROM producto
                INNER JOIN inventario ON inventario.idproducto = producto.idproducto
                INNER JOIN talla ON talla.idtalla = inventario.idtalla
                WHERE producto.idproducto = ? AND inventario.idtalla = ?) + ?)
                WHERE idproducto = ? AND idtalla = ?';
        $params = array($this->idProducto, $this->idTalla,$this->stockReal,$this->idProducto,$this->idTalla);
        return Database::executeRow($sql,$params);
    }

    //Función para restar la cantidad adquirida en el pedido 
    public function updateDetalle() 
    {
        $sql = 'UPDATE detallepedido SET cantidad = ?
                WHERE iddetallepedido = ?';
        $params = array($this->cantidad,$this->idDetallePedido);
        return Database::executeRow($sql,$params);
    }

 }
?>