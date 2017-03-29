<?php

include '../Datos/query.php';

try {
    $conexion = new query();

    switch ($_POST ['tipo']) {

        case 'registrar' :
            $nombre = $_POST["Nombre"];
            $rut = $_POST["Rut"];
            $fecha = $_POST["Fecha"];
            $personalidad = $_POST["Personalidad"];
            $categoria = $_POST ["Categoria"];
            $rutDirigente = $_POST["RutDirigente"];
            $nombreDirigente = $_POST["NombreDirigente"];
            $correoDirigente = $_POST["CorreoDirigente"];
            $contactoDirigente = $_POST["ContactoDirigente"];
            $foto = $_POST["Foto"];
            $respuesta = $conexion->getClubDeportivo($rut);
            if (count($respuesta) > 0) {
                echo "repetido";
                return;
            }
            for ($i = 0; $i < count($rutDirigente); $i++) {
                $respuesta = $conexion->getDirigente($rutDirigente[$i]);
                if (count($respuesta) > 0) {
                    echo "dirigenteRepetido";
                    return;
                }
            }
            $respuesta = $conexion->getEscudoClubDeportivo($foto);
            if (count($respuesta) > 0) {
                echo "imagenRepetida";
                return;
            }
            $conexion->setClubDeportivo($rut, $nombre, $fecha, $personalidad, $foto);
            for ($i = 0; $i < count($categoria); $i++) {
                $conexion->setEquipo($categoria[$i] . $rut, $categoria[$i], $rut);
            }
            for ($i = 0; $i < count($rutDirigente); $i++) {
                $respuesta = $conexion->getPersona($rutDirigente[$i]);
                if (count($respuesta) < 1) {
                    $conexion->setPersona($rutDirigente[$i], $nombreDirigente[$i]);
                }
                $conexion->setDirigente($rutDirigente[$i], $correoDirigente[$i], $contactoDirigente[$i], $rut);
            }
            echo "ingresado";
            break;
        case 'obtenerCategorias' :
            $respuesta = $conexion->getListaCategorias();
            echo json_encode($respuesta);
            break;
        case 'obtenerClubDeportivo':
            $rut = $_POST["Rut"];
            $respuesta = $conexion->getClubDeportivo($rut);
            if (count($respuesta) < 1) {
                echo "vacio";
            } else {
                echo json_encode($respuesta);
            }
            break;
        case 'obtenerCategoriaSegunClub':
            $rut = $_POST["Rut"];
            $respuesta = $conexion->getCategoriaSegunClub($rut);
            echo json_encode($respuesta);
            break;
        case 'obtenerDirigentesSegunClub':
            $rut = $_POST["Rut"];
            $respuesta = $conexion->getDirigenteSegunClub($rut);
            echo json_encode($respuesta);
            break;
        case 'modificar':
            $nombre = $_POST["Nombre"];
            $rut = $_POST["Rut"];
            $fecha = $_POST["Fecha"];
            $personalidad = $_POST["Personalidad"];
            $foto = $_POST["Foto"];
            if ($foto == "") {
                $conexion->updateClubDeportivoSinFoto($nombre, $rut, $fecha, $personalidad);
            } else {
                $conexion->updateClubDeportivo($nombre, $rut, $fecha, $personalidad, $foto);
            }
            echo "modificado";
            break;
        case 'insertarEquipo':
            $categoria = $_POST["Categoria"];
            $rut = $_POST["Rut"];
            $conexion->setEquipo($categoria . $rut, $categoria, $rut);
            echo "terminado";
            break;
        case 'eliminarEquipo':
            $categoria = $_POST["Categoria"];
            $rut = $_POST["Rut"];
            $respuesta = $conexion->getEquipo($categoria, $rut);
            $conexion->deleteEquipo($respuesta[0][0]);
            echo "terminado";
            break;
        case 'insertarDirigente':
            $rut = $_POST["Rut"];
            $rutDirigente = $_POST["RutDirigente"];
            $nombreDirigente = $_POST["NombreDirigente"];
            $correoDirigente = $_POST["CorreoDirigente"];
            $contactoDirigente = $_POST["ContactoDirigente"];
            for ($i = 0; $i < count($rutDirigente); $i++) {
                $respuesta = $conexion->getDirigente($rutDirigente[$i]);
                if (count($respuesta) > 0) {
                    echo "dirigenteRepetido";
                    return;
                }
            }
            for ($i = 0; $i < count($rutDirigente); $i++) {
                $respuesta = $conexion->getPersona($rutDirigente[$i]);
                if (count($respuesta) < 1) {
                    $conexion->setPersona($rutDirigente[$i], $nombreDirigente[$i]);
                }
                $conexion->setDirigente($rutDirigente[$i], $correoDirigente[$i], $contactoDirigente[$i], $rut);
            }
            echo "terminado";
            break;
        case 'eliminarDirigente':
            $rutDirigente = $_POST["RutDirigente"];
            for ($i = 0; $i < count($rutDirigente); $i++) {
                $conexion->deleteDirigente($rutDirigente[$i]);
                $respuesta = $conexion->getJugador($rutDirigente[$i]);
                if (count($respuesta) < 1) {
                    $conexion->deletePersona($rutDirigente[$i]);
                }
            }
            echo "terminado";
            break;
        case 'modificarDirigente':
            $rutDirigente = $_POST["RutDirigente"];
            $nombreDirigente = $_POST["NombreDirigente"];
            $correoDirigente = $_POST["CorreoDirigente"];
            $contactoDirigente = $_POST["ContactoDirigente"];
            for ($i = 0; $i < count($rutDirigente); $i++) {
                $conexion->updateDirigente($rutDirigente[$i],$correoDirigente[$i],$contactoDirigente[$i]);
                $conexion->updatePersona($rutDirigente[$i],$nombreDirigente[$i]);
            }
            break;
        case 'eliminarImagen':
            $imagen = $_POST["NombreImagen"];
            unlink("../Presentacion/image/escudos/" .$imagen);
            break;
        case 'eliminar':
            $rut = $_POST["Rut"];
            $rutDirigente = $_POST["RutDirigente"];
            $categoria = $_POST["Categoria"];
            $imagen = $_POST["Imagen"];
            $conexion->deleteClubDeportivo($rut);
            for ($i = 0; $i < count($rutDirigente); $i++) {
                $conexion->deleteDirigente($rutDirigente[$i]);
                $respuesta = $conexion->getJugador($rutDirigente[$i]);
                if (count($respuesta) < 1) {
                    $conexion->deletePersona($rutDirigente[$i]);
                }
            }
            $conexion->deleteEquipoSegunClubDeportivo($rut);
            unlink("../Presentacion/image/escudos/" .$imagen);
            echo "eliminado";
            break;
        case 'ver':
            break;
        case 'obtenerListaClub' :
            $respuesta = $conexion->getListaClubes();
            echo json_encode($respuesta);
            break;
        case 'obtenerJugadorSegunClub':
            $rut = $_POST["Rut"];
            $respuesta = $conexion->getJugadorSegunClubDeportivo($rut);
            echo json_encode($respuesta);
            break;
        case 'obtenerJugadorSegunCategoria':
            $codigo = $_POST["Codigo"];
            $respuesta = $conexion->getJugadorSegunCategoria($codigo);
            echo json_encode($respuesta);
            break;
        case 'obtenerClubDeportivoSegunCategoria':
            $codigo = $_POST["Codigo"];
            $respuesta = $conexion->getClubSegunCategoria($codigo);
            echo json_encode($respuesta);
            break;
        case 'verificarImagen':
            $foto = $_POST["NombreImagen"];
            $respuesta = $conexion->getEscudoClubDeportivo($foto);
            if (count($respuesta) > 0) {
                echo "imagenRepetida";
            } else {
                echo "imagenLimpia";
            }
            break;
    }
} catch (Exception $e) {
    echo $e;
}
?>