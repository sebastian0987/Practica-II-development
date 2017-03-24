<?php
/**
 * Created by PhpStorm.
 * User: Andrés
 * Date: 29-01-2017
 * Time: 15:19
 */

include '../Datos/query.php';

// INSERTS
// Se debe generar un conjunto de partidos segun la modalidad de torneo (liga, elim. dir. o por grupos) y luego
// guardarlos en la base de datosGrupo, indicando todos los datosGrupo necesarios (partidos, equipos, fechas, torneo, categorias,
// etc.)

try {
    //$array = json_decode($_POST['data']);

    $conexion = new query();

    $categoria = $_POST['categoria'];
//    $categoria = "1";
    $torneo = $_POST['torneo'];
//    $torneo = "torneo1";
    $fecha = $_POST['fecha'];
//    $fecha = "2017-02-28";


    //foreach($clubes as $row){
    //    $codigoClub = $row[0];
    //    $nombreClub = $row[1];
    //    $codigoEquipo = $conexion->getEquipo($categoria,$codigoClub);
    //
    //}


//$equipos = json_decode($_POST['equipos']);

    switch ($_POST ['tipoTorneo']) {
        case "liga":

            break;
        case "eliminacion":
            $clubes = $conexion->getClubSegunCategoria($categoria);
            $equipos = [];
            foreach($clubes as $club){
                $equipo = $conexion->getEquipo($categoria,$club[0]);
                array_push($equipos,$equipo[0][0]);
            }
            shuffle($equipos);
            $cantEquipos = count($equipos);
            $partidos = [];
            for ($i = 1;$i <= $cantEquipos; $i++){
                array_push($partidos,array_pop($equipos));
            }

            for ($i = 0; $i< count($partidos);$i+=2){
                echo "Partido: ".$partidos[$i]." vs ".$partidos[$i+1];
                if($categoria == "1"){
                    echo "actualizarBracket";
                }else{
                    if($categoria == "2"){
                        echo "actualizarBracket";
                    }
                }
                $conexion->setPartido($partidos[$i],$partidos[$i+1],$fecha,"",$torneo);
            }
            break;
        case "grupos":

            break;
    }
} catch ( Exception $e ) {
    echo $e;
}








