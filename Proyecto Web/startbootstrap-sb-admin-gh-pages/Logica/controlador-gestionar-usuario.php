<?php
include '../Datos/query.php';

try {
    $conexion = new query();

    switch ($_POST ['tipo']) {

        case 'conectar' :
            $correo = $_POST["Correo"];
            $password = md5($_POST["Password"]);
            $respuesta = $conexion->getUsuario($correo, $password);
            if (count($respuesta) == 1) {
                session_start();
                $_SESSION['login'] = 'privado';
                $_SESSION['correo'] = $correo;
                echo "correcto";
            } else {
                echo "incorrecto";
            }
            break;

        case 'desconectar':
            session_start();
            $_SESSION['login'] = 'publico';
            echo "desconectado";
            break;
        case 'registrar' :
            $correo = $_POST["Correo"];
            $password = md5($_POST["Password"]);
            $respuesta = $conexion->getUsuarioSegunCorreo($correo);
            if (count($respuesta) < 1) {
                $respuesta = $conexion->setUsuario($correo, $password);
                echo "registrado";
            } else {
                echo "denegado";
            }
            break;
        case 'validar':
            $correo = $_POST["Correo"];
            $password = md5($_POST["Password"]);
            $respuesta = $conexion->getUsuario($correo, $password);
            if (count($respuesta) == 1) {
                echo "validado";
            }else{
                echo "invalido";
            }
            break;
        case 'obtener':
            session_start();
            $correo = $_SESSION['correo'];
            $respuesta = $conexion->getUsuarioSegunCorreo($correo);
            echo json_encode($respuesta);
            break;
        case 'modificar':
            $correo = $_POST["Correo"];
            $password = md5($_POST["Password"]);
            $conexion->updateUsuario($correo,$password);
            echo 'modificado';
            break;
        case 'eliminar':
            $correo = $_POST["Correo"];
            $conexion->deleteUsuario($correo);
            echo "eliminado";
            break;
    }

} catch (Exception $e) {
    echo $e;
}
?>