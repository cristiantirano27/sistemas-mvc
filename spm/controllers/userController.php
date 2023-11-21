<?php

    if ($peticionAjax) {
        require_once "../models/userModel.php";
    } else {
        require_once "./models/userModel.php";
    }

    class userController extends userModel
    {
        /* Controlador agregar usuario */
        public function agregar_usuario_controlador()
        {
            $no_identificacion = mainModel::limpiar_cadena($_POST['usuario_no_id_reg']);
            $nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
            $apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_reg']);
            $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_reg']);
            $direccion = mainModel::limpiar_cadena($_POST['usuario_direccion_reg']);

            $usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_reg']);
            $email = mainModel::limpiar_cadena($_POST['usuario_email_reg']);
            $contrasenia1 = mainModel::limpiar_cadena($_POST['usuario_contrasenia_1_reg']);
            $contrasenia2 = mainModel::limpiar_cadena($_POST['usuario_contrasenia_2_reg']);

            $privilegios = mainModel::limpiar_cadena($_POST['usuario_privilegio_reg']);
            
            /* Comprobar campos vacios */
            if ($no_identificacion == "" || $nombre == "" || $apellido == "" || $telefono == "" || $direccion == "" || $usuario == "" || $email == "" || $contrasenia1 == "" || $contrasenia2 == "") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No pueden existir campos vacíos en el formulario",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Verificando integridad de los datos */
            if (mainModel::verificar_datos("[0-9]{7,12}", $no_identificacion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El campo <b>No. Identificación</b> no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
        }
    }
    
