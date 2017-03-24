<?php

include '../Datos/query.php';

try {
    $conexion = new query();

    switch ($_POST ['tipo']) {
        case 'crear' :
            $categoria = $_POST['categoria'];
            $clubDeportivo1 = $_POST["club1"];
            $respuesta = $conexion->getEquipo($categoria,$clubDeportivo1);
            $equipo1 = $respuesta[0][0];

            $clubDeportivo2 = $_POST["club2"];
            $respuesta = $conexion->getEquipo($categoria,$clubDeportivo2);
            $equipo2 = $respuesta[0][0];

            $fecha = $_POST ["fecha"];
            $horaIni = $_POST ["horaIni"];
            $horaFin = $_POST ["horaFin"];
            $cancha = $_POST["cancha"];
            $torneo = $_POST["torneo"];
            $conexion->setPartido($equipo1,$equipo2,$fecha,$horaIni,$horaFin,$cancha,$torneo);
            echo "ingresado";
            break;
        case 'obtenerImagenClub':
            $respuesta = $conexion->getImagenClubDeportivo($_POST["rutClub"]);
            echo json_encode($respuesta);
            break;
        case 'obtenerPartido' :
            $codigoPartido = $_POST["codigoPartido"];
            $partido = $conexion->getPartido($codigoPartido);
            echo json_encode($partido);
//            $categoria = $_POST["Categoria"];
//            $clubDeportivo = $_POST["Club"];
//            $respuesta = $conexion->getEquipo($categoria,$clubDeportivo);
//            echo $respuesta[0][0];
            break;
        case 'obtenerListaTorneos' :
//            $codigoTorneo = $_POST["codigoTorneo"];
            $respuesta = $conexion->getListaTorneos();
            echo json_encode($respuesta);
            break;
        case 'obtenerDatosPartido' :
            $codigo = $_POST["codigo"];
            $respuesta = $conexion->getClubSegunCategoria($codigo);
            echo json_encode($respuesta);
            break;
        case 'obtenerPartidosGanadosPorClub' :
            $categoria = $_POST['categoria'];
            $club = $_POST['rutClub'];
            $tipoTorneo= $_POST['tipoTorneo'];
            $equipo = $conexion->getEquipo($categoria,$club);
            $respuesta = $conexion->getPartidosGanados($equipo[0][0],$tipoTorneo);
            echo json_encode($respuesta);
            break;
        case 'obtenerPartidosPerdidosPorClub' :
            $categoria = $_POST['categoria'];
            $club = $_POST['rutClub'];
            $tipoTorneo= $_POST['tipoTorneo'];
            $equipo = $conexion->getEquipo($categoria,$club);
            $respuesta = $conexion->getPartidosPerdidos($equipo[0][0],$tipoTorneo);
            echo json_encode($respuesta);
            break;
        case 'obtenerPartidosEmpatadosPorClub' :
            $categoria = $_POST['categoria'];
            $club = $_POST['rutClub'];
            $tipoTorneo= $_POST['tipoTorneo'];
            $equipo = $conexion->getEquipo($categoria,$club);
            $respuesta = $conexion->getPartidosEmpatados($equipo[0][0],$tipoTorneo);
            echo json_encode($respuesta);
            break;
        case 'obtenerClubes' :
            $categoria = $_POST["categoria"];
            $respuesta = $conexion->getClubSegunCategoria($categoria);
            echo json_encode($respuesta);
            break;
        case 'obtenerClubPorGrupo':
            $grupo = $_POST["Grupo"];
            $respuesta = $conexion->getClubPorGrupo($grupo);
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
            }else{
                echo json_encode($respuesta);
            }
            break;
        case 'modificar':

            $categoria = $_POST["categoria"];
            $codigoPartido = $_POST["partido"];

            $goles1 = $_POST["goles1"];
            $clubDeportivo1 = $_POST["club1"];
            $respuesta = $conexion->getEquipo($categoria,$clubDeportivo1);
            $equipo1 = $respuesta[0][0];

            $goles2 = $_POST["goles2"];
            $clubDeportivo2 = $_POST["club2"];
            $respuesta = $conexion->getEquipo($categoria,$clubDeportivo2);
            $equipo2 = $respuesta[0][0];


            $fecha = $_POST ["fecha"];
            $horaIni = $_POST ["horaIni"];
            $horaFin = $_POST ["horaFin"];
            $cancha = $_POST["cancha"];
            $torneo = $_POST["torneo"];


            $conexion->updatePartido($codigoPartido,$equipo1,$equipo2,$fecha,$horaIni,$horaFin,$cancha,$torneo, $goles1, $goles2);
            echo "modificado";
            break;
        case 'eliminar':
            $codigoPartido = $_POST ["codigoPartido"];
            $conexion->deletePartido($codigoPartido);
            echo "eliminado";
            break;
    }
} catch ( Exception $e ) {
    echo $e;
}
?>