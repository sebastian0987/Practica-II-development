<?php
/**
 * Created by PhpStorm.
 * User: Andrés
 * Date: 23-02-2017
 * Time: 9:36
 */
include '../Datos/query.php';


try{
    $arr = array();
    $json = array();
    $conexion = new query();
    $allDay = false;
//    $categoria = $_POST['categoria'];
    $categoria = "1";
    $partidos = $conexion->getPartidosPorCategoria($categoria);
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


        $title = $nombreClub1." vs ".$nombreClub2;
        $start = $fecha . "T".$horaInicio;
        $end = $fecha . "T".$horaFin;
        $allDay = false;

        $arr[] = array('title' => $title ,'start' => $start, 'end' => $end, 'id' => $codigoPartido);//, 'end' => "$end");
        array_push($json,$arr);
    }
    $json = json_encode($arr);
    echo $json;



} catch ( Exception $e ) {
    echo $e;
}