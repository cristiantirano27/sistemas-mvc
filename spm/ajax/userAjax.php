<?php

    $peticionAjax = true;
    require_once "../config/APP.php";

    if (isset($_POST['usuario_no_id_reg'])) {
        /* Instancia al controlador */
        require_once "../controllers/userController.php";
        $ins_usuario = new userController();

        /* Agregando un usuario */
        if (isset($_POST['usuario_no_id_reg']) && isset($_POST['usuario_nombre_reg']) && isset($_POST['usuario_apellido_reg']) && isset($_POST['usuario_telefono_reg']) && isset($_POST['usuario_direccion_reg'])) {
            echo $ins_usuario->agregar_usuario_controlador();
        }
    } else {
        session_start(['name' => 'LS']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }
    
