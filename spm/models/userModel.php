<?php

    require_once "mainModel.php";

    class userModel extends mainModel
    {
        /* Modelo agregar usuario */
        protected  static function agregar_usuario_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("INSERT INTO usuario (usuario_num_id, usuario_nombre, usuario_apellido, usuario_telefono, usuario_direccion, usuario_email, usuario_usuario, usuario_contrasenia, usuario_estado, usuario_privilegio) VALUES(:NumId, :Nombre, :Apellido, :Telefono, :Direccion, :Email, :Usuario, :Contrasenia, :Estado, :Privilegio);");
            $sql->bindParam(":NumId", $datos['NumId']);
            $sql->bindParam(":Nombre", $datos['Nombre']);
            $sql->bindParam(":Apellido", $datos['Apellido']);
            $sql->bindParam(":Telefono", $datos['Telefono']);
            $sql->bindParam(":Direccion", $datos['Direccion']);
            $sql->bindParam(":Email", $datos['Email']);
            $sql->bindParam(":Usuario", $datos['Usuario']);
            $sql->bindParam(":Contrasenia", $datos['Contrasenia']);
            $sql->bindParam(":Estado", $datos['Estado']);
            $sql->bindParam(":Privilegio", $datos['Privilegio']);
            $sql->execute();

            return $sql;
        }

        /* Modelo eliminar usuario */
        protected  static function eliminar_usuario_modelo($id)
        {
            $sql = mainModel::conectar()->prepare("DELETE FROM usuario WHERE usuario_id=:ID;");
            $sql->bindParam(":ID", $id);
            $sql->execute();
            
            return $sql;
        }

        /* Modelo datos usuario */
        protected  static function datos_usuario_modelo($tipo, $id)
        {
            if ($tipo == "Unico") {
                $sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario_id=:ID;");
                $sql->bindParam(":ID", $id);
            } elseif ($tipo == "Conteo") {
                $sql = mainModel::conectar()->prepare("SELECT usuario_id FROM usuario WHERE usuario_id != '1';");
            }
            $sql->execute();

            return $sql;
        }
    }
    
