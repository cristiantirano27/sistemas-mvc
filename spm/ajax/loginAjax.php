<?php

    $peticionAjax = true;
    require_once "../config/APP.php";

    if (isset($_POST['token']) && isset($_POST['usuario'])) {
        /* Instancia al controlador */
        require_once "../controllers/loginController.php";
        $ins_login = new loginController();

        echo $ins_login->cerrar_sesion_controlador();
    } else {
        session_start(['name' => 'LS']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }
    
