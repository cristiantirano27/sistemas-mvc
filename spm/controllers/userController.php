<?php

    if ($peticionAjax) {
        require_once "../models/userModel.php";
    } else {
        require_once "./models/userModel.php";
    }

    class userController extends userModel
    {
        /* Controlador agregar usuario */
        public function agregar_usuario_controlador() {
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

        /* Controlador páginar usuarios */
        public function paginador_usuario_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda) {
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $privilegio = mainModel::limpiar_cadena($privilegio);
            $id = mainModel::limpiar_cadena($id);
            
            $url = mainModel::limpiar_cadena($url);
            $url = SERVERURL.$url."/";
            
            $busqueda = mainModel::limpiar_cadena($busqueda);            
            $tabla = "";

            $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
            $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
        
            if (isset($busqueda) && $busqueda != "") {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE ((usuario_id != '$id' AND usuario_id != '1') AND (usuario_num_id LIKE '%$busqueda%' OR usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_num_id LIKE '%$busqueda%' OR usuario_telefono LIKE '%$busqueda%' OR usuario_telefono LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio, $registros;";
            } else {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE usuario_id != '$id' AND usuario_id != '1' ORDER BY usuario_nombre ASC LIMIT $inicio, $registros";
            }
            
            $conexion = mainModel::conectar();

            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();

            $total = $conexion->query("SELECT FOUND_ROWS();");
            $total = (int) $total->fetchColumn();

            $Npaginas = ceil($total / $registros); 

            $tabla .= '<div class="table-responsive">
                        <table class="table table-dark table-sm">
                            <thead>
                                <tr class="text-center roboto-medium">
                                    <th>#</th>
                                    <th>No. IDENTIFICACIÓN</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>TELÉFONO</th>
                                    <th>USUARIO</th>
                                    <th>EMAIL</th>
                                    <th>ACTUALIZAR</th>
                                    <th>ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody>';

            if ($total >= 1 && $pagina <= $Npaginas) {
                $contador = $inicio + 1;
                $reg_inicio = $inicio + 1;

                foreach ($datos as $rows) {
                    $tabla .= '<tr class="text-center" >
                                <td>'.$contador.'</td>
                                <td>'.$rows['usuario_num_id'].'</td>
                                <td>'.$rows['usuario_nombre'].'</td>
                                <td>'.$rows['usuario_apellido'].'</td>
                                <td>'.$rows['usuario_telefono'].'</td>
                                <td>'.$rows['usuario_usuario'].'</td>
                                <td>'.$rows['usuario_email'].'</td>
                                <td>
                                    <a href="'.SERVERURL.'user-update/'.mainModel::encryption($rows['usuario_id']).'" class="btn btn-success">
                                        <i class="fas fa-sync-alt"></i>	
                                    </a>
                                </td>
                                <td>
                                    <form class="FormularioAjax" action="'.SERVERURL.'ajax/userAjax.php" method="POST" data-form="delete" autocomplete="off">
                                        <input type="hidden" name="usuario_id_del" value="'.mainModel::encryption($rows['usuario_id']).'">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                               </tr>';
                    $contador++;
                }
                $reg_final = $contador - 1;
            } else {
                if ($total >= 1) {
                    $tabla .= '<tr class="text-center">
                                <td colspan="9">  
                                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">
                                        Haga clic aquí para recargar la lista
                                    </a>
                                </td>
                               </tr>';
                } else {
                    $tabla .= '<tr class="text-center">
                                <td colspan="9">
                                    No hay registros en el sistema
                                </td>
                               </tr>';
                }
                
            }
            

            $tabla .= '     </tbody>
                        </table>
                       </div>';


            if ($total >= 1 && $pagina <= $Npaginas) {
                $tabla .= '<p class="text-right">Mostrando usuarios '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;

        } /* Fin del controlador */
        
        /* Controlador eliminar usuarios */
        public function eliminar_usuario_controlador() {
            /* Recibiendo id del usuario */
            $id = mainModel::decryption($_POST['usuario_id_del']);
            $id = mainModel::limpiar_cadena($id);

            /* Comprobando el usuario principal */
            if ($id == 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No se ha podido eliminar el usuario principal.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando el usuario en BD */
            $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$id';");

            if ($check_usuario->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El usuario que intenta eliminar no existe.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando los préstamos en BD */
            $check_prestamos = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM prestamo WHERE usuario_id='$id' LIMIT 1;");

            if ($check_prestamos->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No se ha podido eliminar el usuario debido a que tiene préstamos asociados. Se recomienda desactivar el usuario si este no va a ser utilizado nuevamente.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando los privilegios */
            session_start(['name' => 'LS']);
            
            if ($_SESSION['privilegio_spm'] != 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No cuenta con los permisos necesarios para realizar esta operación.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $eliminar_usuario = userModel::eliminar_usuario_modelo($id);
            
            if ($eliminar_usuario->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Usuario eliminado",
                    "Texto" => "El Usuario ha sido eliminado correctamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No se ha podido eliminar el usuario. Verifique los datos ingresados e intente nuevamente",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
        } /* Fin del controlador */
    
        /* Controlador datos usuario */
        public function datos_usuario_controlador($tipo, $id) {
            $tipo = mainModel::limpiar_cadena($tipo);

            $id = mainModel::decryption($id);
            $id = mainModel::limpiar_cadena($id);

            return userModel::datos_usuario_modelo($tipo, $id);
        } /* Fin del controlador */
        
        /* Controlador actualizar usuario */
        public function actualizar_usuario_controlador(){
            // Recibiendo el id
            $id = mainModel::decryption($_POST['usuario_id_up']);
            $id = mainModel::limpiar_cadena($id);

            // Comprobar el usuario en la BD
            $check_usuario = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usuario_id='$id';");
            if ($check_usuario->rowCount()<=0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "No se ha encontrado el usuario.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $campos = $check_usuario->fetch();
            }

            $no_identificacion = mainModel::limpiar_cadena($_POST['usuario_no_id_up']);
            $nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
            $apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_up']);
            $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_up']);
            $direccion = mainModel::limpiar_cadena($_POST['usuario_direccion_up']);

            $usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_up']);
            $email = mainModel::limpiar_cadena($_POST['usuario_email_up']);
            
            if (isset($_POST['usuario_estado_up'])) {
                $estado = mainModel::limpiar_cadena($_POST['usuario_estado_up']);
            } else {
                $estado = $campos['usuario_estado'];
            }

            if (isset($_POST['usuario_privilegio_up'])) {
                $privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_up']);
            } else {
                $privilegio = $campos['usuario_privilegio'];
            }

            $admin_usuario = mainModel::limpiar_cadena($_POST['usuario_admin']);
            
            $admin_contrasenia = mainModel::limpiar_cadena($_POST['contrasenia_admin']);
            
            $tipo_cuenta = mainModel::limpiar_cadena($_POST['tipo_cuenta']);
            
            /* Comprobar campos vacios */
            if ($no_identificacion == "" || $nombre == "" || $apellido == "" || $telefono == "" || $direccion == "" || $usuario == "" || $admin_usuario == "" || $admin_contrasenia == "") {
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

            if (mainModel::verificar_datos("[a-zA-ZÑñ ]{4,35}", $admin_usuario)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "Su Nombre de usuario no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZÑñ0-9@.-_#]{8,100}", $admin_usuario)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "Su Contraseña no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $admin_contrasenia = mainModel::encryption($admin_contrasenia);
            
            if ($privilegio<1 || $privilegio>3) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El Privilegio no es válido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if ($estado != "Activo" && $estado != "Inactivo") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error",
                    "Texto" => "El Estado de la cuenta no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            // Comprobando numero de documento
            if ($no_identificacion != $campos['usuario_num_id']) {
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
            }
            
            // Comprobando usuario
            if ($usuario != $campos['usuario_usuario']) {
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
            }
            
        } /* Fin del controlador */


    }
    

