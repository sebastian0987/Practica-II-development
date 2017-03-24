<?php

include '../Datos/query.php';

try {
    $conexion = new query();

    switch ($_POST ['tipo']) {

        case 'registrar' :
            $rut = $_POST ["Rut"];
            $nombre = $_POST ["Nombre"];
//            $apellidos = $_POST ["Apellidos"];
            $equipo = $_POST ["Equipo"];
            $fechaNac = $_POST ["FechaNacimiento"];
            $fechaIns = $_POST ["FechaInscripcion"];
            $rolJugador = $_POST["RolJugador"];
            $rolAndaba = $_POST["RolAndaba"];
            $fotoJugador = $_POST["FotoJugador"];
            $respuesta = $conexion->getJugador($rut);
            if (count ( $respuesta ) > 0) {
                echo "repetido";
                return;
            } else {
                $respuesta = $conexion->getPersona($rut);
                if (count ( $respuesta ) < 1) {
                    $conexion->setPersona($rut,$nombre);
                }
                $conexion->setJugador($rut,$fechaNac,$fechaIns,$rolJugador,$rolAndaba,$fotoJugador,$equipo);
                echo "ingresado";
            }
            break;
        case 'obtenerEquipo' :
            $categoria = $_POST["Categoria"];
            $clubDeportivo = $_POST["Club"];
            $respuesta = $conexion->getEquipo($categoria,$clubDeportivo);
            echo $respuesta[0][0];
            break;
        case 'obtenerClubes' :
            $codigo = $_POST["codigo"];
            $respuesta = $conexion->getClubSegunCategoria($codigo);
            echo json_encode($respuesta);
            break;
        case 'obtenerCategorias' :
            $respuesta = $conexion->getListaCategorias();
            echo json_encode($respuesta);
            break;
        case 'obtenerJugador':
            $rut = $_POST ["Rut"];
            $respuesta = $conexion->getJugador($rut);
            if (count ( $respuesta ) == 0) {
                echo "vacio";
                return;
            }else{
                if ($respuesta[0][6] != ""){
                    $equipo = $conexion->getEquipoSegunJugador($respuesta[0][6]);
                    $respuesta[0][6] = $equipo[0][0];
                    $respuesta[0][7] = $equipo[0][1];
                    $respuesta[0][8] = $equipo[0][2];
                    $respuesta[0][9] = $equipo[0][3];
                }
                echo json_encode($respuesta);
            }
            break;
        case 'modificar':
            $rut = $_POST ["Rut"];
            $nombre = $_POST ["Nombre"];
            $equipo = $_POST ["Equipo"];
            $fechaNac = $_POST ["FechaNacimiento"];
            $fechaIns = $_POST ["FechaInscripcion"];
            $fechaSancion = $_POST ["FechaSancion"];
            $conexion->updateJugador($rut,$equipo,$fechaNac,$fechaIns,$fechaSancion);
            $conexion->updatePersona($rut,$nombre);
            echo "modificado";
            break;
        case 'obtenerSancion':
            $rut = $_POST ["Rut"];
            $respuesta = $conexion->getSancionJugador($rut);
            echo $respuesta[0][0];
            break;
        case 'eliminar':
            $rut = $_POST ["Rut"];
            $conexion->deleteJugador($rut);
            $respuesta = $conexion->getDirigente($rut);
            if (count ( $respuesta ) < 1) {
                $conexion->deletePersona($rut);
            }
            echo "eliminado";
            break;
    }
} catch ( Exception $e ) {
    echo $e;
}
?>