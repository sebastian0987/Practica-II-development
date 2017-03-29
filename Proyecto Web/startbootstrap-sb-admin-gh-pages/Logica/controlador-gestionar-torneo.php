<?php
include '../Datos/query.php';
try {
    $conexion = new query();
    switch ($_POST ['tipo']) {
        case 'crear' :
            $categoria = $_POST['categoria'];
            $nombre = $_POST['nombre'];
            $tipoTorneo = $_POST['tipoTorneo'];
            if($tipoTorneo == 'liga'){
                $conexion->setTorneo($nombre, $tipoTorneo);
                $ultimoTorneo = $conexion->getUltimoTorneoIngresado("liga");
                $conexion->setGrupo($ultimoTorneo[0][0]);
                $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                $clubes = $conexion->getClubSegunCategoria($categoria);
                for($i = 0; $i<count($clubes);$i++){
                    $club = $clubes[$i][0];
                    $equipo = $conexion->getEquipo($categoria,$club);
                    $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
                }
            }
            if($tipoTorneo == 'eliminacion'){
                $clubes = $_POST['clubes'];
                $conexion->setTorneo($nombre, $tipoTorneo);
                $ultimoTorneo = $conexion->getUltimoTorneoIngresado("eliminacion");
                $conexion->setGrupo($ultimoTorneo[0][0]);
                $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                for($i = 0; $i<count($clubes);$i++){
                    $club = $clubes[$i][0];
                    $equipo = $conexion->getEquipo($categoria,$club);
                    $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
                }
            }
            if($tipoTorneo == 'grupos'){
                $numGrupos = $_POST['numGrupos'];
                $clubes = $_POST['clubes'];
                $conexion->setTorneo($nombre, $tipoTorneo);
                $ultimoTorneo = $conexion->getUltimoTorneoIngresado("grupos");
                shuffle($clubes);
                if(count($clubes)==8){
                    $conexion->setGrupo($ultimoTorneo[0][0]);
                    $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                    for($i = 0; $i<4; $i++){
                        $equipo = $conexion->getEquipo($categoria,$clubes[$i]);
                        $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
                    }
                    $conexion->setGrupo($ultimoTorneo[0][0]);
                    $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                    for($i = 4; $i<8; $i++){
                        $equipo = $conexion->getEquipo($categoria,$clubes[$i]);
                        $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
                    }
                }
                if(count($clubes)==16) {
                    if ($numGrupos == 2) {
                        $conexion->setGrupo($ultimoTorneo[0][0]);
                        $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                        for($i = 0; $i<8; $i++){
                            $equipo = $conexion->getEquipo($categoria,$clubes[$i]);
                            $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
                        }
                        $conexion->setGrupo($ultimoTorneo[0][0]);
                        $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                        for($i = 8; $i<16; $i++){
                            $equipo = $conexion->getEquipo($categoria,$clubes[$i]);
                            $conexion->updateGrupoDeUnEquipo($equipo[0][0],$ultimoGrupo[0][0],$ultimoTorneo[0][0]);
                        }
                    }
                    if ($numGrupos == 4) {
                        $conexion->setGrupo($ultimoTorneo[0][0]);
                        $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                        for ($i = 0; $i < 4; $i++) {
                            $equipo = $conexion->getEquipo($categoria, $clubes[$i]);
                            $conexion->updateGrupoDeUnEquipo($equipo[0][0], $ultimoGrupo[0][0], $ultimoTorneo[0][0]);
                        }
                        $conexion->setGrupo($ultimoTorneo[0][0]);
                        $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                        for ($i = 4; $i < 8; $i++) {
                            $equipo = $conexion->getEquipo($categoria, $clubes[$i]);
                            $conexion->updateGrupoDeUnEquipo($equipo[0][0], $ultimoGrupo[0][0], $ultimoTorneo[0][0]);
                        }
                        $conexion->setGrupo($ultimoTorneo[0][0]);
                        $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                        for ($i = 8; $i < 12; $i++) {
                            $equipo = $conexion->getEquipo($categoria, $clubes[$i]);
                            $conexion->updateGrupoDeUnEquipo($equipo[0][0], $ultimoGrupo[0][0], $ultimoTorneo[0][0]);
                        }
                        $conexion->setGrupo($ultimoTorneo[0][0]);
                        $ultimoGrupo = $conexion->getGruposPorTorneo($ultimoTorneo[0][0]);
                        for ($i = 12; $i < 16; $i++) {
                            $equipo = $conexion->getEquipo($categoria, $clubes[$i]);
                            $conexion->updateGrupoDeUnEquipo($equipo[0][0], $ultimoGrupo[0][0], $ultimoTorneo[0][0]);
                        }
                    }
                }
            }
            echo "ingresado";
            break;
        case 'obtenerCategoriasQueNoEstenJugandoUnTorneo':
            $respuesta = $conexion->getCategoriasNoJugandoUnTorneo();
            echo json_encode($respuesta);
            break;
        case 'obtenerCategoriasQueSiEstenJugandoUnTorneo':
            $respuesta = $conexion->getCategoriasSiJugandoUnTorneo();
            echo json_encode($respuesta);
            break;
        case 'obtenerCategoriasQueSiEstenJugandoUnTorneoPorTipo':
            $tipoTorneo = $_POST["tipoTorneo"];
            $respuesta = $conexion->getCategoriasSiJugandoUnTorneoPorTipo($tipoTorneo);
            echo json_encode($respuesta);
            break;
        case 'obtenerGruposPorCategoria':
            $categoria = $_POST["categoria"];
            $respuesta = $conexion->getGruposPorCategoria($categoria);
            echo json_encode($respuesta);
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
        case 'obtenerTorneos' :
            $tipoTorneo = $_POST['tipoTorneo'];
            $respuesta = $conexion->getListaTorneosPorTipoTorneo($tipoTorneo);
            echo json_encode($respuesta);
            break;
        case 'obtenerTorneosPorCategoria' :
            $categoria = $_POST['categoria'];
            $respuesta = $conexion->getListaTorneosPorCategoria($categoria);
            echo json_encode($respuesta);
            break;
        case 'obtenerListaTorneos' :
//            $tipoTorneo = $_POST['tipoTorneo'];
            $respuesta = $conexion->getListaTorneos();
            echo json_encode($respuesta);
            break;
        case 'obtenerDatosPartido' :
            $codigo = $_POST["codigo"];
            $respuesta = $conexion->getClubSegunCategoria($codigo);
            echo json_encode($respuesta);
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
            }else{
                echo json_encode($respuesta);
            }
            break;
        case 'modificar':
            $codigoTorneo = $_POST["codigoTorneo"];
            $nombreTorneo = $_POST["nombreTorneo"];
            $finalizadoS_N = $_POST["finalizadoS_N"];
            $respuesta = $conexion->updateTorneo($codigoTorneo, $nombreTorneo, $finalizadoS_N);
            echo "modificado";
        case 'eliminar':
            break;
    }
} catch ( Exception $e ) {
    echo $e;
}
?>