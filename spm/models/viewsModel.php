<?php

class viewsModel {
    # Modelo para obtener las vistas del sistema
    protected static function obtener_vista_modelo($vistas)
    {
        $listaBlanca = ["home", "client-list", "client-new", "client-search", "client-update", "company", "item-list", "item-new", "item-search", "item-update", "reservation-list", "reservation-new", "reservation-pending", "reservation-reservation", "reservation-search", "reservation-update", "user-list", "user-new", "user-search", "user-update"];
        if (in_array($vistas, $listaBlanca)) {
            if (is_file("./views/contents/".$vistas."-view.php")) {
                $contenido = "./views/contents/".$vistas."-view.php"; 
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
