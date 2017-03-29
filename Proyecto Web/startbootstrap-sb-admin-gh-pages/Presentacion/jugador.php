<?php

include "menuGlobal.php";

?>

<html>

<body>

<div class="row">
    <h1 id="encabezadoJugador" class="page-header"></h1>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Datos del Jugadores</h3>
            </div>
            <div class="panel-body">
<!--                <button id="btMostrarOcultarJugadores" type="button" class="btn btn-success">Mostrar Lista de Jugadores-->
<!--                </button>-->
                <div>
                    <!--Tabla para pantallas normales-->
                    <table id="tablaGrande" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Clud Deportivo</th>
                            <th>Categoría</th>
                            <th>Fecha Nacimiento</th>
                            <th>Fecha Inscripción</th>
                            <th>Rol Jugador</th>
                            <th>Rol ANDABA</th>
                            <th>Sanción</th>
                        </tr>
                        </thead>
                        <tbody id="cuerpoTablaJugador">

                        </tbody>
                    </table>
                </div>
                <div>
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
<script type="text/javascript" src="js/jugador.js"></script>

</body>

<!--Modal para solicitar-->
<div class="modal fade" id="modalSolicitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="encabezadoModalSolicitar" class="modal-header" style="background-color:#BDE5F8">
                <h5 id="tituloModalSolicitud" class="modal-title">Buscar Jugador</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label id="mensajeModalSolicitud" for="recipient-name" class="form-control-label">Ingrese RUT del jugador:</label>
                        <input id="tbBuscarJugador" type="text" class="form-control" placeholder="12345678k" maxlength="9">
                        <label id="errorModalSolicitar" style="color:red;"></label>
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
