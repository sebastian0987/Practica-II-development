<?php

// Se deben buscar los partidos en la base de datosGrupo y retornar los datosGrupo necesarios para desplegar los partidos en
// el bracket gracket

include '../Datos/query.php';
try{
    $conexion = new query();
//    $categoria = $_POST['categoria'];
//    $categoria = 1;
    $codigoTorneo = $_POST['torneo'];
//    $partidos = $conexion->getPartidosPorTipoTorneo('eliminacion');
    $partidos = $conexion->getPartidosPorCodigoTorneo($codigoTorneo);
    echo json_encode($partidos);



} catch ( Exception $e ) {
    echo $e;
}