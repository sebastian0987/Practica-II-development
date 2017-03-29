<?php

include "menuGlobal.php";

?>

<html>

<body>

<div class="row">
    <h1 id="encabezadoCategoria" class="page-header"></h1>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Club Deportivos</h3>
            </div>
            <div class="panel-body">
                <button id="btMostrarOcultarClubDeportivo" type="button" class="btn btn-success">Mostrar Lista de Club Deportivos
                </button>
                <div id="listaClubDeportivo" style="display: none">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Fecha Fundación</th>
                            <th>Personalidad Jurídica</th>
                        </tr>
                        </thead>
                        <tbody id="cuerpoTablaClub">

                        </tbody>
                    </table>
                </div>
                <div>
                    <button id="btCargandoClub" class="btn btn-primary btn-lg" style="display: none" disabled><i class="fa fa-spinner fa-spin"></i> Cargando</button>
                </div>
            </div>
        </div>
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
                    <!--Tabla para pantallas normales-->
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
                        <tbody id="cuerpoTablaJugador">

                        </tbody>
                    </table>
                </div>
                <div>
                    <button id="btCargandoJugador" class="btn btn-primary btn-lg" style="display: none" disabled><i class="fa fa-spinner fa-spin"></i> Cargando</button>
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
<script type="text/javascript" src="js/categoria.js"></script>

</body>

<!--Modal para solicitar-->
<div class="modal fade" id="modalSolicitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="encabezadoModalSolicitar" class="modal-header" style="background-color:#BDE5F8">
                <h5 id="tituloModalSolicitud" class="modal-title">Buscar Categoría</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label id="mensajeModalSolicitud" for="recipient-name" class="form-control-label">Seleccione un Club Deportivo:</label>
                        <div class="form-group">
                            <select id="dropdownCategoria" class="form-control">
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
