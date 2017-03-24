<?php

include "../Datos/query.php";
/**
 * Created by PhpStorm.
 * User: Andrés
 * Date: 26-02-2017
 * Time: 18:51
 */
$conexion = new query();

$categoria = 1;
$nombre = 'grupos12';
$tipoTorneo = 'grupos';

$numGrupos = 2;
$clubes = [1,2,3,4,5,6,7,8];

//$conexion->setTorneo($nombre, $tipoTorneo);
$ultimoTorneo = $conexion->getUltimoTorneoIngresado("grupos");
shuffle($clubes);

if(count($clubes)==8){
//    $conexion->setGrupo($ultimoTorneo[0][0]);
    $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
    for($i = 0; $i<4; $i++){
        $equipo = $conexion->getEquipo($categoria,$clubes[$i]);
        echo "equipo: ".$equipo[0][0],
            "grupo: ".$ultimoGrupo[0][0],
            "torneo: ".$ultimoTorneo[0][0];
        $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
    }

//    $conexion->setGrupo($ultimoTorneo[0][0]);
    $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
    for($i = 4; $i<8; $i++){

        $equipo = $conexion->getEquipo($categoria,$clubes[$i]);
        echo "equipo: ".$equipo[0][0],
            "grupo: ".$ultimoGrupo[0][0],
            "torneo: ".$ultimoTorneo[0][0];
        $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
    }
}
echo "ingresado";