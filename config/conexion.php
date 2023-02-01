<?php

class Conexion{
    protected $dbh;

    protected function conexion(){
        try {
            $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=crud", "root", "");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_name(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }
}

?>