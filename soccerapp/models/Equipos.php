<?php

require_once "../config/Connection.php";

class Equipos 
{
    static private $tablename= 'Equipos';

    static public function getAll() {
        $table = self::$tablename;
        $sql = "SELECT * FROM $tabla ORDER BY nombre";
        $stmt = Connection::getConnection()->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getById($id) {
        $table = self::$tablename;
        $sql = "SELECT * FROM $tabla WHERE id = :id";
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function insert($data) {
        $table = self::$tablename;
        $columnas = "";
        $valores = "";
        foreach ($data as $key => $value) {
            $columnas .= $key . ",";
            $valores .= ":" . $key . ",";
        }
        // Eliminando la ultima coma
        $columnas = substr($columnas, 0, -1);
        $valores = substr($valores, 0, -1);
        
        $sql = "INSERT INTO $table ($columnas) VALUES ($valores)";

        $conn = Connection::getConnection();
        $stmt = $conn->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindParam(":". $key, $data[$key], PDO::PARAM_STR);
        }
        if ($stmt->exexcute()) {
            $response = array(
                "id" => $conn->lastInsertId(),
                "resultado" => "Registro creado"
            );

            return $response;
        }
        return $conn->errorInfo();
    }

    static public function update($id, $data) {
        $table = self::$tablename;
        
        // Comprobando que el id existe
        $response = Equipos::getById($id);
        if (empty($response)) {
            return null;
        }

        $columnas = "";
        $valores = "";
        foreach ($data as $key => $value) {
            $columnas .= $key . "= :" . $key . ",";
        }
        // Eliminando la ultima coma
        $columnas = substr($columnas, 0, -1);
        
        $sql = "UPDATE $table SET $columnas WHERE id = :id";

        $conn = Connection::getConnection();
        $stmt = $conn->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindParam(":". $key, $data[$key], PDO::PARAM_STR);
        }
        $stmt->bindParam("id:". $id, PDO::PARAM_STR);
        if ($stmt->exexcute()) {
            $response = array(
                "resultado" => "Registro actualizado"
            );

            return $response;
        }
        return $conn->errorInfo();
    }

    static public function delete($id) {
        $table = self::$tablename;

        // Comprobando que el id existe
        $response = Equipos::getById($id);
        if (empty($response)) {
            return null;
        }

        $sql = "DELETE FROM $table WHERE id = :id";

        $conn = Connection::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id:". $id, PDO::PARAM_STR);
        if ($stmt->exexcute()) {
            $response = array(
                "resultado" => "Registro borrado"
            );

            return $response;
        }
        return $conn->errorInfo();
    }
}

