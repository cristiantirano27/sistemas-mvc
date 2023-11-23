<?php

    require_once "mainModel.php";

    class loginModel extends mainModel
    {
        /* Modelo para iniciar sesión */
        protected  static function iniciar_sesion_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario_usuario=:Usuario AND usuario_contrasenia=:Contrasenia AND usuario_estado='Activo';");
            $sql->bindParam(":Usuario", $datos['Usuario']);
            $sql->bindParam(":Contrasenia", $datos['Contrasenia']);
            $sql->execute();
            
            return $sql;
        }
    }
