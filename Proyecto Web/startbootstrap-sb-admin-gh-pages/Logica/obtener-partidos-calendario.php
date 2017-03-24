<?php
/**
 * Created by PhpStorm.
 * User: Andrés
 * Date: 29-01-2017
 * Time: 15:19
 */

include '../Datos/query.php';
// Se deben buscar en la base de datosGrupo los partidos y sus datosGrupo, para luego retornarlos como json, habilitando
// la vista en un calendario


try{
    $arr = array();
    $json = array();
    $conexion = new query();
//    $categoria = $_POST['categoria'];
//    $categoria = "1";
    $partidos = $conexion->getPartidos();
//    $partidos = $conexion->getPartidosPorCategoria($categoria);
    foreach($partidos as $partido){

        $nombreClub1 =   $partido[0];
        $nombreClub2 =   $partido[1];
        $codigoEquipo1 = $partido[2];
        $codigoEquipo2 = $partido[3];
        $golesEquipo1 =  $partido[4];
        $golesEquipo2 =  $partido[5];
        $fecha =         $partido[6];
        $horaInicio =    $partido[7];
        $horaFin =       $partido[8];
        $cancha =        $partido[9];
        $codigoPartido = $partido[10];
        $categoria =     $partido[11];

        $title = $nombreClub1." vs ".$nombreClub2;
        $start = $fecha . "T".$horaInicio;
        $end = $fecha . "T".$horaFin;
        $color = ['gold','#ED1317','#','#ffe914', 'black'];

        $arr[] = array('title' => $title ,'start' => $start, 'end' => $end, 'id' => $codigoPartido, 'color' => $color[$categoria]);//, 'end' => "$end");
        array_push($json,$arr);
    }
    $json = json_encode($arr);
    echo $json;



} catch ( Exception $e ) {
    echo $e;
}