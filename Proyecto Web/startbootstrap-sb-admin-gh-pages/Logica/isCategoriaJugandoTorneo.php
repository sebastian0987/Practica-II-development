<?php
/**
 * Created by PhpStorm.
 * User: Andrés
 * Date: 19-02-2017
 * Time: 12:31
 */
include '../Datos/query.php';

try {
    $conexion = new query();
    //$temp = array();
    $respuesta = array();   // Correspondencia codigoCategoria -> true/false (esta o no jugando un torneo actualmente)
    $categorias = $conexion->getListaCategorias();

    //$cantCategorias = count($categorias);

    foreach ($categorias as $cat){
        $bool = false;
        $cantCategoriasJugando = count($conexion->getEquiposJugandoActualmentePorCategoria($cat[0]));
        if($cantCategoriasJugando > 0){
            $bool = true;
        }else{
            $bool = false;
        }
        array_push($respuesta, array('nombreCategoria' => $cat[1],'juegaActualmente' => $bool));

        //$temp[] = $fila;
        //array_push($respuesta,$temp);
        //echo json_encode($temp);
    }
    echo json_encode($respuesta);



} catch ( Exception $e ) {
    echo $e;
}
?>