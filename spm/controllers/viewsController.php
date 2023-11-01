<?php

require_once "./models/viewsModel.php";

class viewsController extends viewsModel
{
    # Controlador para obtener las plantillas
    public function obtener_plantillas_controlador()
    {
        return require_once "./views/plantilla.php";
    }

    # Controlador para obtener las plantillas
    public function obtener_vistas_coontrolador()
    {
        if (isset($_GET['views'])) {
            $ruta = explode("/", $_GET['views']);
            $respuesta = viewsModel::obtener_vista_modelo($ruta[0]);
        } else {
            $respuesta = "login";
        }
        return $respuesta;
    }
}

