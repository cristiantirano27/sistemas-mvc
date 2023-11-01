<?php

class viewsModel {
    # Modelo para obtener las vistas del sistema
    protected static function obtener_vista_modelo($vistas)
    {
        $listaBlanca = [];    
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
