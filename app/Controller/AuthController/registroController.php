<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/G5_SC-609-_LN_Simulacion3/app/Model/usuarioModel.php";

    class registroController
    {
        public static function registrarUsuario()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];
                $contrasena = $_POST['contrasena'];
                $rol = 1;  

                $usuario = new usuarioModel();
                $resultado = $usuario->validarCorreo($correo);

                if ($resultado) {
                    echo json_encode(['success' => false, 'message' => 'Error: El correo ya se encuentra registrado en la aplicación']);
                } else {
                    $registrar = $usuario->registrarUsuario($nombre, $apellido, $telefono, $correo, $contrasena, $rol);
                    if ($registrar) {
                        echo json_encode(['success' => true, 'message' => 'Cuenta registrada correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al registrar la cuenta.']);
                    }
                }
            }
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'registrarUsuario') {
        registroController::registrarUsuario();
    }

?>
