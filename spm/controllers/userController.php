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

            $privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_reg']);
            
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
                    "Texto" => "El campo No. Identificación no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,20}", $nombre)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El campo Nombres no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,20}", $apellido)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El campo Apellidos no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[0-9()+ ]{13,15}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El campo Teléfono no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{15,40}", $direccion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El campo Dirección no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZÑñ ]{4,35}", $usuario)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El campo Usuario no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZÑñ0-9@.-_#]{8,100}", $contrasenia1) || mainModel::verificar_datos("[a-zA-ZÑñ0-9@.-_#]{8,100}", $contrasenia2)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "Los campo Contraseña y Repetir contraseña no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando número de identificación */
            $check_no_id = mainModel::ejecutar_consulta_simple("SELECT usuario_num_id FROM usuario WHERE usuario_num_id = '$no_identificacion';");

            if ($check_no_id->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El Número de Identificación ingresado ya existe",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando usuario */
            $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_usuario FROM usuario WHERE usuario_usuario = '$usuario';");

            if ($check_usuario->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El Usuario ingresado ya existe",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando email */
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email';");

                if ($check_email->rowCount()>0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error",
                        "Texto" => "El Email ingresado ya existe",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El Email ingresado no es válido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando contraseñas */
            if ($contrasenia1 != $contrasenia2) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "Las Contraseñas ingresadas no coinciden",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $contrasenia = mainModel::encryption($contrasenia1);
            }
            
            /* Comprobando privilegios */
            if ($privilegio<1 || $privilegio>3) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El Privilegio seleccionado no es válido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
            $datos_usuario_reg = [
                "NumId" => $no_identificacion,
                "Nombre" => $nombre,
                "Apellido" => $apellido,
                "Telefono" => $telefono,
                "Direccion" => $direccion,
                "Email" => $email,
                "Usuario" => $usuario,
                "Contrasenia" => $contrasenia,
                "Estado" => "Activo",
                "Privilegio" => $privilegio,
            ];

            $agregar_usuario = userModel::agregar_usuario_modelo($datos_usuario_reg);

            if ($agregar_usuario->rowCount()==1) {
                $alerta = [
                    "Alerta" => "limpiar",
                    "Titulo" => "Usuario registrado",
                    "Texto" => "El Usuario ha sido registrado correctamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No se ha podido registrar el usuario. Verifique los datos ingresados e intente nuevamente",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
            
        } /* Fin del controlador */


    }
    

