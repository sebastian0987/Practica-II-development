<?php

include '../Datos/Conexion.php';

class query
{
    public $bdConexion;

    public function __construct()
    {
        $this->bdConexion = new Conexion();
    }

//------------------Usuario---------------------
    public function getUsuario($correo, $password)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT u.correo FROM usuario u WHERE u.correo = '" . $correo . "' AND u.password = '" . $password . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setUsuario($correo, $password)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO usuario (correo, password) VALUES ('" . $correo . "','" . $password . "')";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateUsuario($correo, $password)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE usuario u SET u.password='" . $password . "' WHERE u.correo='" . $correo . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteUsuario($correo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM usuario WHERE correo='" . $correo . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUsuarioSegunCorreo($correo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT u.correo FROM usuario u WHERE u.correo = '" . $correo . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
//---------------------Jugador------------------
//    public function getJugadorOriginal($rut)
//    {
//        try {
//            $this->bdConexion->conectar();
//            $strComando = "SELECT p.rutPersona,p.nombrePersona,j.fechaNacimiento,j.fechaInscripcion,j.rolJugador,j.rolANDABA,c.codigoCategoria,c.nombreCategoria,cd.rutClubDeportivo,cd.nombreClubDeportivo FROM Persona p, Jugador j, Equipo e, ClubDeportivo cd, Categoria c WHERE j.rutJugador = '" . $rut . "' AND j.rutJugador = p.rutPersona AND j.codigoEquipo = e.codigoEquipo AND e.codigoCategoria=c.codigoCategoria AND e.rutClubDeportivo=cd.rutClubDeportivo";
//            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
//            $this->bdConexion->desconectar();
//            return $resp;
//        } catch (Exception $e) {
//            throw $e;
//        }
//    }
    public function getJugador($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT p.rutPersona,p.nombrePersona,j.fechaNacimiento,j.fechaInscripcion,j.rolJugador,j.rolANDABA,j.codigoEquipo FROM persona p, jugador j WHERE j.rutJugador = '" . $rut . "' AND j.rutJugador = p.rutPersona ";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setJugador($rut, $fehcaNac, $fechaIns, $rolJugador, $rolANDABA, $foto, $equipo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO jugador (rutJugador, fechaNacimiento,fechaInscripcion,rolJugador,rolANDABA,codigoEquipo) VALUES ('" . $rut . "','" . $fehcaNac . "','" . $fechaIns . "','" . $rolJugador . "','" . $rolANDABA . "','" . $equipo . "')";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateJugador($rut, $equipo, $fechaNac, $fechaInsc, $fechaSancion)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE jugador j SET j.codigoEquipo='" . $equipo . "', j.fechaNacimiento='" . $fechaNac . "',j.fechaInscripcion='" . $fechaInsc . "',j.sancion='" . $fechaSancion . "' WHERE j.rutJugador='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteJugador($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM jugador WHERE rutJugador='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getJugadorSegunClubDeportivo($rutClub)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT p.rutPersona,p.nombrePersona,j.fechaNacimiento,j.fechaInscripcion,j.rolJugador,j.rolANDABA,c.codigoCategoria,c.nombreCategoria,cd.rutClubDeportivo,cd.nombreClubDeportivo FROM persona p, jugador j, equipo e, clubdeportivo cd, categoria c WHERE cd.rutClubDeportivo='" . $rutClub . "' AND e.rutClubDeportivo=cd.rutClubDeportivo AND e.codigoCategoria=c.codigoCategoria AND j.codigoEquipo = e.codigoEquipo AND j.rutJugador = p.rutPersona";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getJugadorSegunCategoria($codigo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT p.rutPersona,p.nombrePersona,j.fechaNacimiento,j.fechaInscripcion,j.rolJugador,c.nombreCategoria,cd.nombreClubDeportivo FROM persona p, jugador j, equipo e, clubdeportivo cd, categoria c WHERE c.codigoCategoria='" . $codigo . "' AND e.codigoCategoria=c.codigoCategoria AND e.rutClubDeportivo=cd.rutClubDeportivo  AND j.codigoEquipo = e.codigoEquipo AND j.rutJugador = p.rutPersona";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

//---------------------Equipo-----------------------------
    public function getEquipo($categoria, $clubDeportivo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT e.codigoEquipo FROM equipo e WHERE e.rutClubDeportivo = '" . $clubDeportivo . "' AND e.codigoCategoria = '" . $categoria . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setEquipo($codigo, $categoria, $clubDeportivo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO equipo (codigoEquipo,codigoCategoria,rutClubDeportivo) VALUES ('" . $codigo . "','" . $categoria . "','" . $clubDeportivo . "')";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteEquipo($codigo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM equipo WHERE codigoEquipo='" . $codigo . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteEquipoSegunClubDeportivo($rutClub)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM equipo WHERE rutClubDeportivo='" . $rutClub . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteEquipoSegunCategoria($codigo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM equipo WHERE codigoCategoria='" . $codigo . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

//-----------------------Persona-------------------------
    public function getPersona($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT p.rutPersona,p.nombrePersona FROM persona p WHERE p.rutPersona = '" . $rut . "' ";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setPersona($rutPersona, $nomPersona)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO persona (rutPersona, nombrePersona) VALUES ('" . $rutPersona . "','" . $nomPersona . "')";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updatePersona($rut, $nombre)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE persona p SET p.nombrePersona='" . $nombre . "' WHERE p.rutPersona='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deletePersona($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM persona WHERE rutPersona='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }


//----------------Club Deportivo-------------------
    public function getClubDeportivo($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd.nombreClubDeportivo,cd.rutClubDeportivo,cd.fechaFundacion,cd.personalidadJuridica,cd.escudoClubDeportivo FROM clubdeportivo cd WHERE cd.rutClubDeportivo ='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setClubDeportivo($rut, $nombre, $fecha, $personalidad, $foto)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO clubdeportivo (rutClubDeportivo,nombreClubDeportivo,fechaFundacion,personalidadJuridica,escudoClubDeportivo) VALUES ('" . $rut . "','" . $nombre . "','" . $fecha . "','" . $personalidad . "','" . $foto . "')";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateClubDeportivo($nombre, $rut, $fecha, $personalidad, $foto)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE clubdeportivo cd SET cd.nombreClubDeportivo='" . $nombre . "', cd.fechaFundacion='" . $fecha . "',cd.personalidadJuridica='" . $personalidad . "', cd.escudoClubDeportivo='" . $foto . "' WHERE cd.rutClubDeportivo='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateClubDeportivoSinFoto($nombre, $rut, $fecha, $personalidad)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE clubdeportivo cd SET cd.nombreClubDeportivo='" . $nombre . "', cd.fechaFundacion='" . $fecha . "',cd.personalidadJuridica='" . $personalidad . "' WHERE cd.rutClubDeportivo='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteClubDeportivo($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM clubdeportivo WHERE rutClubDeportivo = '" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getClubSegunCategoria($codigoCategoria)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd.rutClubDeportivo,cd.nombreClubDeportivo,cd.fechaFundacion,cd.personalidadJuridica FROM categoria c, equipo e, clubdeportivo cd WHERE c.codigoCategoria = '" . $codigoCategoria . "' AND c.codigoCategoria = e.codigoCategoria AND e.rutClubDeportivo = cd.rutClubDeportivo";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getListaClubes()
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd.rutClubDeportivo,cd.nombreClubDeportivo FROM clubdeportivo cd";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateFoto($rut, $foto)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE clubdeportivo cd SET cd.escudoClubDeportivo='" . $foto . "' WHERE cd.rutClubDeportivo='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getEscudoClubDeportivo($foto)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd.rutClubDeportivo FROM clubdeportivo cd WHERE cd.escudoClubDeportivo ='" . $foto . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getImagenClubDeportivo($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd.escudoClubDeportivo FROM clubdeportivo cd WHERE cd.rutClubDeportivo ='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

//---------------------Dirigente-----------------------------------
    public function getDirigente($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT d.rutDirigente FROM dirigente d WHERE d.rutDirigente ='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setDirigente($rut, $correo, $contacto, $rutClub)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO dirigente VALUES ('" . $rut . "','" . $contacto . "','" . $correo . "','" . $rutClub . "')";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateDirigente($rut, $correo, $contacto)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE dirigente d SET d.correoDirigente='" . $correo . "',d.contactoDirigente='" . $contacto . "' WHERE d.rutDirigente='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteDirigente($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM dirigente WHERE rutDirigente='" . $rut . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDirigenteSegunClub($rutClub)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT d.rutDirigente,p.nombrePersona,d.correoDirigente,d.contactoDirigente FROM dirigente d, clubdeportivo cd, persona p WHERE cd.rutClubDeportivo = '" . $rutClub . "' AND cd.rutClubDeportivo = d.rutClubDeportivo AND d.rutDirigente = p.rutPersona";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

//-----------------Categoria------------------------------
//    public function getClubDeportivo($rut)
//    {
//        try {
//            $this->bdConexion->conectar();
//            $strComando = "SELECT cd.nombreClubDeportivo,cd.rutClubDeportivo,cd.fechaFundacion,cd.personalidadJuridica FROM ClubDeportivo cd WHERE cd.rutClubDeportivo ='" . $rut . "'";
//            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
//            $this->bdConexion->desconectar();
//            return $resp;
//        } catch (Exception $e) {
//            throw $e;
//        }
//    }
    public function setCategoria($nombre)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO categoria (codigoCategoria,nombreCategoria) VALUES ('" . $nombre . "','" . $nombre . "')";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateCategoria($codigo, $nombre)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE categoria c SET c.nombreCategoria='" . $nombre . "'  WHERE c.codigoCategoria='" . $codigo . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteCategoria($codigo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM categoria WHERE codigoCategoria = '" . $codigo . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getListaCategorias()
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT c.codigoCategoria, c.nombreCategoria FROM categoria c";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getCategoriaSegunClub($rutClub)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT c.codigoCategoria,c.nombreCategoria FROM categoria c, equipo e, clubdeportivo cd WHERE cd.rutClubDeportivo = '" . $rutClub . "' AND e.rutClubDeportivo = cd.rutClubDeportivo AND c.codigoCategoria = e.codigoCategoria";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

//------------------Extras-------------------------------
    public function getEquipoSegunJugador($codigoEquipo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT c.codigoCategoria,c.nombreCategoria,cd.rutClubDeportivo,cd.nombreClubDeportivo FROM categoria c, equipo e, clubdeportivo cd WHERE e.codigoEquipo = '" . $codigoEquipo . "' AND e.rutClubDeportivo = cd.rutClubDeportivo AND c.codigoCategoria = e.codigoCategoria";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSancionJugador($rut)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT j.sancion FROM jugador j WHERE j.rutJugador = '" . $rut . "'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

//------------------------Otro----------------------------------------
    // Lista de equipos de una categoria que ya esta jugando un torneo actualmente (todos los equipos de una categoria)
    public function getEquiposJugandoActualmentePorCategoria($codigoCategoria)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT * FROM equipo e, torneo t, categoria c WHERE c.codigoCategoria = ". $codigoCategoria ." AND e.codigoCategoria = c.codigoCategoria AND e.torneoActual = t.codigoTorneo";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    // Lista de categorias que no estan jugando un torneo actualmente
    public function getCategoriasNoJugandoUnTorneo()
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT c1.codigoCategoria ,c1.nombreCategoria FROM categoria c1 WHERE c1.codigoCategoria not in (SELECT c.codigoCategoria FROM categoria c, equipo e, torneo t WHERE e.codigoCategoria = c.codigoCategoria AND e.torneoActual = t.codigoTorneo AND t.finalizadoS_N = 'n')";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getCategoriasSiJugandoUnTorneo()
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT c1.codigoCategoria ,c1.nombreCategoria FROM categoria c1 WHERE c1.codigoCategoria in (SELECT c.codigoCategoria FROM categoria c, equipo e, torneo t WHERE e.codigoCategoria = c.codigoCategoria AND e.torneoActual = t.codigoTorneo AND t.finalizadoS_N = 'n')";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getCategoriasSiJugandoUnTorneoPorTipo($tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT c1.codigoCategoria ,c1.nombreCategoria FROM categoria c1 WHERE c1.codigoCategoria in (SELECT c.codigoCategoria FROM categoria c, equipo e, torneo t WHERE e.codigoCategoria = c.codigoCategoria AND e.torneoActual = t.codigoTorneo AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '". $tipoTorneo ."' )";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    //-----------------------Partido-------------------------
    // Retorna un partido, buscandolo por su codigo
    public function getPartido($codigoPartido)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd1.nombreclubdeportivo, cd2.nombreClubDeportivo, e1.codigoEquipo, e2.codigoEquipo, p.golesEquipo1, p.golesEquipo2, p.fecha
, p.horaInicio, p.horaFin, p.cancha, p.codigoPartido, c.codigoCategoria, cd1.rutClubDeportivo, cd2.rutClubDeportivo, t.codigoTorneo, t.nombreTorneo 
FROM partido p, equipo e1, equipo e2, categoria c, clubdeportivo cd1, clubdeportivo cd2, torneo t 
WHERE p.codigoEquipo1 = e1.codigoEquipo AND p.codigoEquipo2 = e2.codigoEquipo AND e1.rutClubDeportivo = cd1.rutClubDeportivo
 AND e2.rutClubDeportivo = cd2.rutClubDeportivo AND e1.codigoCategoria = e2.codigoCategoria 
 AND e1.codigoCategoria = c.codigoCategoria AND t.codigoTorneo = p.codigoTorneo AND p.codigoPartido = '". $codigoPartido ."' ";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    // Retorna una lista de todos los partidos
    public function getPartidos()
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd1.nombreclubdeportivo, cd2.nombreClubDeportivo, e1.codigoEquipo, e2.codigoEquipo, p.golesEquipo1, p.golesEquipo2, p.fecha, p.horaInicio, p.horaFin, p.cancha, p.codigoPartido, e1.codigoCategoria FROM partido p, equipo e1, equipo e2, clubdeportivo cd1, clubdeportivo cd2 WHERE p.codigoEquipo1 = e1.codigoEquipo AND p.codigoEquipo2 = e2.codigoEquipo AND e1.rutClubDeportivo = cd1.rutClubDeportivo AND e2.rutClubDeportivo = cd2.rutClubDeportivo ";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getPartidosGanados($codigoEquipo, $tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1>p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '".$codigoEquipo."' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '".$tipoTorneo."')+
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1<p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '".$codigoEquipo."' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '".$tipoTorneo."') as partidosGanados";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getPartidosEmpatados($codigoEquipo, $tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1=p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '".$codigoEquipo."' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '".$tipoTorneo."')+
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1=p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '".$codigoEquipo."' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '".$tipoTorneo."') as partidosEmpatados";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getPartidosPerdidos($codigoEquipo, $tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1<p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '".$codigoEquipo."' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '".$tipoTorneo."')+
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1>p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '".$codigoEquipo."' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '".$tipoTorneo."') as partidosPerdidos";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getPartidosPorCodigoTorneo($codigoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd1.nombreClubDeportivo nombreClub1, cd2.nombreClubDeportivo nombreClub2, e1.codigoEquipo codEquipo1, e2.codigoEquipo codEquipo2, p.golesEquipo1, p.golesEquipo2, p.codigoPartido
FROM  partido p LEFT JOIN torneo t ON p.codigoTorneo = t.codigoTorneo LEFT JOIN equipo e1 ON e1.codigoEquipo = p.codigoEquipo1 LEFT JOIN clubdeportivo cd1 ON cd1.rutClubDeportivo = e1.rutClubDeportivo LEFT JOIN equipo e2 ON e2.codigoEquipo = p.codigoEquipo2 LEFT JOIN clubdeportivo cd2 ON cd2.rutClubDeportivo = e2.rutClubDeportivo
WHERE t.codigoTorneo = '".$codigoTorneo."' AND t.finalizadoS_N = 'n'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getPartidosPorTipoTorneo($tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd1.nombreClubDeportivo nombreClub1, cd2.nombreClubDeportivo nombreClub2, e1.codigoEquipo codEquipo1, e2.codigoEquipo codEquipo2, p.golesEquipo1, p.golesEquipo2, p.codigoPartido
FROM  partido p LEFT JOIN torneo t ON p.codigoTorneo = t.codigoTorneo LEFT JOIN equipo e1 ON e1.codigoEquipo = p.codigoEquipo1 LEFT JOIN clubdeportivo cd1 ON cd1.rutClubDeportivo = e1.rutClubDeportivo LEFT JOIN equipo e2 ON e2.codigoEquipo = p.codigoEquipo2 LEFT JOIN clubdeportivo cd2 ON cd2.rutClubDeportivo = e2.rutClubDeportivo
WHERE t.tipoTorneo = '".$tipoTorneo."' AND t.finalizadoS_N = 'n'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    // Retorna una lista de partidos por categoria
    public function getPartidosPorCategoria($codigoCategoria)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd1.nombreclubdeportivo, cd2.nombreClubDeportivo, e1.codigoEquipo, e2.codigoEquipo, p.golesEquipo1, p.golesEquipo2, p.fecha, p.horaInicio, p.horaFin, p.cancha, p.codigoPartido FROM partido p, equipo e1, equipo e2, categoria c, clubdeportivo cd1, clubdeportivo cd2 WHERE p.codigoEquipo1 = e1.codigoEquipo AND p.codigoEquipo2 = e2.codigoEquipo AND e1.rutClubDeportivo = cd1.rutClubDeportivo AND e2.rutClubDeportivo = cd2.rutClubDeportivo AND e1.codigoCategoria = e2.codigoCategoria AND e1.codigoCategoria = c.codigoCategoria AND c.codigoCategoria = '".$codigoCategoria."' ";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    // Insertar un partido
    public function setPartido($codEquipo1, $codEquipo2, $fecha, $horaIni, $horaFin, $cancha, $codTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO partido (codigoEquipo1, codigoEquipo2,golesEquipo1,golesEquipo2, fecha, horaInicio, horaFin, cancha, codigoTorneo) VALUES ('".$codEquipo1."', '".$codEquipo2."',NULL,NULL,'".$fecha."','".$horaIni."','".$horaFin."','".$cancha."','".$codTorneo."' ) ";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function updatePartido($codigoPartido, $club1, $club2, $fecha, $horaIni, $horaFin, $cancha, $torneo, $golesEquipo1, $golesEquipo2)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE partido SET codigoEquipo1 = '". $club1 ."', codigoEquipo2 = '". $club2 ."', fecha ='". $fecha ."', horaInicio = '". $horaIni ."', horaFin = '". $horaFin ."', cancha = '". $cancha ."', codigoTorneo = '". $torneo ."' , golesEquipo1 = '". $golesEquipo1."', golesEquipo2 = '". $golesEquipo2."'  WHERE codigoPartido='". $codigoPartido ."';";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function updatePartidoNoFinalizado($codigoPartido, $club1, $club2, $fecha, $horaIni, $horaFin, $cancha, $torneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE partido SET codigoEquipo1 = '". $club1 ."', codigoEquipo2 = '". $club2 ."', fecha ='". $fecha ."', horaInicio = '". $horaIni ."', horaFin = '". $horaFin ."', cancha = '". $cancha ."', codigoTorneo = '". $torneo ."'  WHERE codigoPartido='". $codigoPartido ."';";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function deletePartido($codigoPartido)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "DELETE FROM partido WHERE codigoPartido = '" . $codigoPartido . "'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    //-----------------------Torneo-------------------------
    public function getListaTorneos()
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT t.codigoTorneo, t.nombreTorneo, t.tipoTorneo FROM torneo t WHERE t.finalizadoS_N = 'n'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getListaTorneosPorTipoTorneo($tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT t.codigoTorneo, t.nombreTorneo, t.tipoTorneo FROM torneo t WHERE t.finalizadoS_N = 'n' AND t.tipoTorneo = '".$tipoTorneo."'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getListaTorneosPorCategoria($codigoCategoria)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT distinct t.codigoTorneo, t.nombreTorneo, t.tipoTorneo FROM torneo t, categoria c, equipo e WHERE e.codigoCategoria = c.codigoCategoria AND  t.finalizadoS_N = 'n'  AND e.torneoActual = t.codigoTorneo AND c.codigoCategoria =  '". $codigoCategoria ."'  ";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getListaTorneosEliminacionPorCategoria($codigoCategoria)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT t.codigoTorneo, t.nombreTorneo, t.tipoTorneo FROM torneo t, categoria c, partido p, equipo e WHERE t.codigoTorneo = p.codigoTorneo AND e.codigoCategoria = c.codigoCategoria AND p.codigoEquipo1 = e.codigoEquipo AND t.finalizadoS_N = 'n' AND t.tipoTorneo = 'eliminacion' AND c.codigoCategoria = '". $codigoCategoria ."'  ";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function setTorneo($nombre, $tipo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO torneo (nombreTorneo, tipoTorneo, finalizadoS_N) VALUES ( '". $nombre ."' , '". $tipo ."', 'n') ";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function setGrupo($codigoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "INSERT INTO grupo (codigoTorneo) VALUES ( '". $codigoTorneo."') ";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function updateTorneo($codigoTorneo, $nombre, $finalizadoS_N)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE torneo SET nombreTorneo = '". $nombre."', finalizadoS_N ='". $finalizadoS_N."'WHERE codigoTorneo ='". $codigoTorneo ."'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    // Updatea el grupo (y el torneo) en el que juega un equipo actualmente
    public function updateGrupoDeUnEquipo($codigoEquipo, $codigoGrupo, $codigoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "UPDATE equipo SET codigoGrupo = '". $codigoGrupo."', torneoActual = '". $codigoTorneo. "' WHERE codigoEquipo ='". $codigoEquipo."'";
            $resp = $this->bdConexion->ejecutarSinRetorno($strComando);
            $this->bdConexion->desconectar();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getUltimoTorneoIngresado($tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT codigoTorneo FROM torneo t WHERE t.tipoTorneo = '" . $tipoTorneo . "' ORDER BY t.codigoTorneo DESC LIMIT 1";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    // Usado para creación de ligas
    public function getGruposPorTorneo($codigoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT g.codigoGrupo FROM grupo g, torneo t WHERE t.codigoTorneo = g.codigoTorneo AND g.codigoTorneo = '". $codigoTorneo ."' ORDER BY g.codigoGrupo DESC";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getGruposPorCategoria($categoria)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT distinct e.codigoGrupo, c.codigoCategoria
FROM equipo e, categoria c 
WHERE e.codigoCategoria = c.codigoCategoria AND c.codigoCategoria = '".$categoria."'";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getClubPorGrupo($grupo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd.rutClubDeportivo,cd.nombreClubDeportivo  FROM equipo e, clubdeportivo cd WHERE e.codigoGrupo = '" . $grupo . "' AND e.rutClubDeportivo = cd.rutClubDeportivo";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getTablaPorEquipo($codigoEquipo, $tipoTorneo)
    {
        try {
            $this->bdConexion->conectar();
            $strComando = "SELECT cd.nombreClubDeportivo as Club,
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1>p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '" . $tipoTorneo . "')+
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1<p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '" . $tipoTorneo . "') as PG,
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1=p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '" . $tipoTorneo . "')+
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1=p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '" . $tipoTorneo . "') as PE,
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1<p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '" . $tipoTorneo . "')+
(SELECT count(*)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE p.golesEquipo1>p.golesEquipo2 AND cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = 'n' AND t.tipoTorneo = '" . $tipoTorneo . "') as PP,
IFNULL((SELECT SUM(p.golesEquipo1)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = \"n\" AND t.tipoTorneo = '" . $tipoTorneo . "'),0)+
IFNULL((SELECT SUM(p.golesEquipo2)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = \"n\" AND t.tipoTorneo = '" . $tipoTorneo . "'),0) as GF,
IFNULL((SELECT SUM(p.golesEquipo2)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo1 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = \"n\" AND t.tipoTorneo = '" . $tipoTorneo . "'),0)+
IFNULL(
(SELECT SUM(p.golesEquipo1)
FROM partido p, clubdeportivo cd, equipo e, torneo t
WHERE cd.rutClubDeportivo = e.rutClubDeportivo  AND t.codigoTorneo = e.torneoActual 
AND p.codigoEquipo2 = e.codigoEquipo AND p.codigoTorneo = t.codigoTorneo AND e.codigoEquipo = '" . $codigoEquipo . "' AND t.finalizadoS_N = \"n\" AND t.tipoTorneo = '" . $tipoTorneo . "'),0) as GC
FROM clubdeportivo cd, equipo e
WHERE e.codigoEquipo = '" . $codigoEquipo . "' AND e.rutClubDeportivo = cd.rutClubDeportivo";
            $resp = $this->bdConexion->ejecutarConRetorno($strComando);
            $this->bdConexion->desconectar();
            return $resp;
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>