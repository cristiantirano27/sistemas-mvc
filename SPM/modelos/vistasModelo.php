<?php

    class vistasModelo
    {
        /* ------ Modelo obtener vistas ------ */
        protected static function obtener_vistas_modelo($vistas)
        {
            $lista = [];
            if (in_array($vistas, $lista)) {
                if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
                    $contenido = "./vistas/contenidos/".$vistas."-view.php";
                } else {
                    $contenido = "404";
                }
            } elseif ($vistas == "login" || $vistas == "index") {
                $contenido = "login";
            } else {
                $contenido = "404";
            }
            return $contenido;
        }
    }