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
                      exit();
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
                      exit();
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
                      exit();
            }

            $contrasenia = mainModel::encryption($contrasenia);

            $datos_login = [
                "Usuario" => $usuario,
                "Contrasenia" => $contrasenia
            ];

            $datos_cuenta = loginModel::iniciar_sesion_modelo($datos_login);

            if ($datos_cuenta->rowCount() == 1) {
                $row = $datos_cuenta->fetch();

                session_start(['name' => 'LS']);

                $_SESSION['id_spm'] = $row['usuario_id'];
                $_SESSION['nombre_spm'] = $row['usuario_nombre'];
                $_SESSION['apellido_spm'] = $row['usuario_apellido'];
                $_SESSION['usuario_spm'] = $row['usuario_usuario'];
                $_SESSION['privilegio_spm'] = $row['usuario_privilegio'];
                $_SESSION['token_spm'] = md5(uniqid(mt_rand(), true));

                return header("Location: ".SERVERURL."home/");
            } else {
                echo '<script>
                        Swal.fire({   
                            title: "Ha ocurrido un error",
                            text: "El Usuario o la Contraseña ingresados son incorrectos",
                            type: "error",
                            confirmaButtonText: "Aceptar"
                        });
                      </script>';
            }
            
        } /* Fin del controlador */

        /* Controlador para iniciar sesión */
        public function forzar_cierre_sesion_controlador() 
        {
            session_unset();
            session_destroy();
            
            if (headers_sent()) {
                return "<script> window.location.href='".SERVERURL."login/'; </script>";
            } else {
                return header("Location: ".SERVERURL."login/");
            } /* Fin controlador */
            
        } /* Fin del controlador */
    }
