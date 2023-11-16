<?php

    $peticionAjax = true;
    require_once "../config/APP.php";

    if () {
        /* Instancia al controlador */
        require_once "../controllers/userController.php"
        $ins_usuario = new userController();
    } else {
        session_start(['name' => 'LS']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }
    
