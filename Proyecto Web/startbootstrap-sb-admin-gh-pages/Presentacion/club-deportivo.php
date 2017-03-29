<?php

include "menuGlobal.php";

?>

<html>

<!--<head>-->
<!--    <link href="css/club-deportivo.css" rel="stylesheet">-->
<!--</head>-->

<body>

<div class="row">
    <h1 id="encabezadoClubDeportivo" class="page-header"></h1>
</div>

<div class="row">
    <div class=col-lg-6">
        <IMG id="escudoClubDeportivo" style="float: left" height="350" width="350">
        <h3>Datos:</h3>
        <div id="datosClub"></div>
        <h3>Dirigentes:</h3>
        <div id="datosDirigentes"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Jugadores</h3>
            </div>
            <div class="panel-body">
                <button id="btMostrarOcultarJugadores" type="button" class="btn btn-success">Mostrar Lista de Jugadores
                </button>
                <div id="listaJugadores" style="display: none">
<!--                    <div class="input-group">-->
<!--                        <span class="input-group-addon">Filtro</span> <input id="filter"-->
<!--                                                                             type="text" class="form-control"-->
<!--                                                                             placeholder="Escriba aqui...">-->
<!--                    </div>-->
<!--                    <br>-->
                    <!--Tabla para pnatallas normales-->
                    <table id="tablaGrande" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Fecha Nacimiento</th>
                            <th>Fecha Inscripción</th>
                            <th>Rol Jugador</th>
                        </tr>
                        </thead>
                        <tbody id="cuerpoTabla">

                        </tbody>
                    </table>
                   <!--Tabla para pantallas pequeñas-->
<!--                    <table id="tablaPequeña" class="table table-bordered table-hover">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Rut</th>-->
<!--                            <th>Nombre</th>-->
<!--                            <th>Apellido</th>-->
<!--                            <th>Serie</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td>16.855.687-8</td>-->
<!--                            <td>Andres</td>-->
<!--                            <td>Aguilera</td>-->
<!--                            <td>Primera Division</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>14.522.354.2</td>-->
<!--                            <td>Alonso</td>-->
<!--                            <td>Cuevas</td>-->
<!--                            <td>Senior</td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
                </div>
                <div>
                <button id="btCargando" class="btn btn-primary btn-lg" style="display: none" disabled><i class="fa fa-spinner fa-spin"></i> Cargando</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="page-header">
    </div>
    <div class="well" style="text-align: center">
        <p>Union Comunal Deportiva Vecinal Liga Sector Norte * R.U.T.: 72.470.300-3 * Numero Contacto: 97105118 *
            Correo: liganorteantofagasta@gmail.com * Fecha Fundacion: 07/01/1977 * Personalidad Jurídica Nº358</p>
    </div>
</div>
<script type="text/javascript" src="js/club-deportivo.js"></script>

</body>

<!--Modal para solicitar-->
<div class="modal fade" id="modalSolicitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="encabezadoModalSolicitar" class="modal-header" style="background-color:#BDE5F8">
                <h5 id="tituloModalSolicitud" class="modal-title">Buscar Club Deportivo</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label id="mensajeModalSolicitud" for="recipient-name" class="form-control-label">Seleccione un Club Deportivo:</label>
                        <div class="form-group">
                            <select id="dropdownClub" class="form-control">
                            </select>
                            <label id="errorModalSolicitar" style="color:red;"></label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btAceptarModalSolicitud" type="button" class="btn btn-success">Buscar</button>
                <button type="button" class="btn btn-secondary" onclick="location.href = 'index.php'">Volver Página Principal</button>
            </div>
        </div>
    </div>
</div>
</html>
