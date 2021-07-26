<?php

//Clase para base de datos

Class Database{

    //Propiedades de la clase
    private static $connection = null;
    private static $statement = null;
    private static $error = null;

    //Método para hacer la conexión (Katherine)
    /*
    private static function connect(){
        // Credenciales.
        $server = 'localhost';
        $database = 'polus_db';
        $username = 'postgres';
        $password = 'katflowxD';
        //Crear conexión.
        self::$connection = new PDO('pgsql:host='.$server.';dbname='.$database.';port=5432', $username, $password);

    }*/
    
    //Metodo para hacer la conexión (Eduardo)
    private static function connect(){

        // Credenciales.
        $server = 'localhost';
        $database = 'polusdb';
        $username = 'eduardo';
        $password = '123456';
        //Crear conexión.
        self::$connection = new PDO('pgsql:host='.$server.';dbname='.$database.';port=5432', $username, $password);

    }

    /*
    //Metodo para hacer la conexión (Samuel)
    private static function connect(){

        // Credenciales.
        $server = 'localhost';
        $database = 'polus_base';
        $username = 'postgres';
        $password = '210503';
        //Crear conexión.
        self::$connection = new PDO('pgsql:host='.$server.';dbname='.$database.';port=5432', $username, $password);

    }*/

    //Método para leer todos los datos
    public static function getRows($query, $values){
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            self::$statement->execute($values);
            // Cerrando conexión.
            self::$connection = null;
            return self::$statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            // Se obtiene el código y el mensaje de la excepción para establecer un error personalizado.
            self::setException($error->getCode(), $error->getMessage());
            return false;
        }
    }

    //Método para obtener una fila
    public static function getRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            self::$statement->execute($values);
            // Se anula la conexión con el servidor de base de datos.
            self::$connection = null;
            return self::$statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            // Se obtiene el código y el mensaje de la excepción para establecer un error personalizado.
            self::setException($error->getCode(), $error->getMessage());
            return false;
        }
    }

    /*Metodo para ejecutar operaciones SQL*/
    public static function executeRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            $state = self::$statement->execute($values);
            // Se anula la conexión con el servidor de base de datos.
            self::$connection = null;
            return $state;
        } catch (PDOException $error) {
            // Se obtiene el código y el mensaje de la excepción para establecer un error personalizado.
            self::setException($error->getCode(), $error->getMessage());
            return false;
        }
    }



    //Método para excepciones
    public static function setException($code, $message){
        self::$error = $message;
        // Establecer un error personalizado.
        switch ($code) {
            case '7':
                self::$error = $message;
                break;
            case '42703':
                self::$error = 'Nombre de campo desconocido';
                break;
            case '23505':
                self::$error = 'Dato duplicado, no se puede guardar';
                break;
            case '42P01':
                self::$error = 'Nombre de tabla desconocido';
                break;
            case '23503':
                self::$error = 'Registro ocupado, no se puede eliminar';
                break;
            default:
                //self::$error = 'Ocurrió un problema en la base de datos';
                self::$error = $message;
        }
    }

    public static function getException()
    {
        return self::$error;
    }

    public static function getLastRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            if (self::$statement->execute($values)) {
                $id = self::$connection->lastInsertId();
            } else {
                $id = 0;
            }
            // Se anula la conexión con el servidor de base de datos.
            self::$connection = null;
            return $id;
        } catch (PDOException $error) {
            // Se obtiene el código y el mensaje de la excepción para establecer un error personalizado.
            self::setException($error->getCode(), $error->getMessage());
            return 0;
        }
    }
}

?>