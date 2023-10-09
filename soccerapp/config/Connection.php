<?php

class Connection 
{
    private $driver = 'pgsql';
    private $host = 'localhost';
    private $port = '5432';
    private $dbname = 'soccerapp';
    private $user = 'postgres';
    private $password = '54321';
    private $connect;

    static public function getConnection() {
        try {
            $connection = new Connection();
            $connection->connect = new PDO("{$connection->driver}:host={$connection->host};port={$connection->port};dbname={$connection->dbname}",$connection->user,$connection->password);
            $connection->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conectado a la BD";
            return $connection->connect;
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }

}
// Connection::getConnection();
