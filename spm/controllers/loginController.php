<?php

    if ($peticionAjax) {
        require_once "../models/loginModel.php";
    } else {
        require_once "./models/loginModel.php";
    }

    class loginController extends loginModel
    {
        /* Controlador para iniciar sesión */
        public function iniciar_sesion_controlador()
        {
            $usuario = mainModel::limpiar_cadena($_POST['usuario_log']);
            $contrasenia = mainModel::limpiar_cadena($_POST['contrasenia_log']);

            /* Comprobando campos vacíos */
            if ($usuario == "" || $contrasenia == "") {
                echo '<script>
                        Swal.fire({   
                            title: "Ha ocurrido un error",
                            text: "No pueden existir campos vacíos en el formulario",
                            type: "error",
                            confirmaButtonText: "Aceptar"
                        });
                      </script>';
            }

            /* Verificando integridad de los datos */
            if (mainModel::verificar_datos("[a-zA-ZÑñ ]{4,35}", $usuario)) {
                echo '<script>
                        Swal.fire({   
                            title: "Ha ocurrido un error",
                            text: "El Usuario no coincide con el formato solicitado",
                            type: "error",
                            confirmaButtonText: "Aceptar"
                        });
                      </script>';
            }

            if (mainModel::verificar_datos("[a-zA-ZÑñ0-9@.-_#]{8,100}", $contrasenia)) {
                echo '<script>
                        Swal.fire({   
                            title: "Ha ocurrido un error",
                            text: "La Contraseña no coincide con el formato solicitado",
                            type: "error",
                            confirmaButtonText: "Aceptar"
                        });
                      </script>';
            }

            $contrasenia = mainModel::encryption($contrasenia);

            $datos = [
                "Usuario" => $usuario,
                "Contrasenia" => $contrasenia
            ];
        }
    }
