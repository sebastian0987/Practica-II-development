<?php
include "menuGlobal.php";
?>
<html>
<head>

    <meta charset='utf-8' />
<!--    css-->
    <link href="css/registrar-jugador.css" rel="stylesheet">
    <link href='css/calendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link href='css/jquery.modal.css' rel='stylesheet' media='print' />
    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

<!--    calendar + locale + controlador-->
    <script src='js/calendar/moment.min.js'></script>
    <script src='js/calendar/fullcalendar.min.js'></script>
    <script src='js/calendar/locale-all.js'></script>
    <script src='js/calendar/modificar-partidos.js'></script>

<!--    datetimepicker-->
    <link rel="stylesheet" href="css/datepicker.css"/>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/combodate.js"></script>

    <div class="row">
        <h1 id="tituloTorneo" class="page-header" align="center"></h1>
    </div>
    <style>

        body {
            margin: 40px 10px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

    </style>
</head>
<body>

<div id='calendar'></div>

</body>

<!--Modal que indica el detalle de un partido-->

<div class="modal fade" tabindex="-1" role="dialog" id="detallePartido">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h3 id="tituloPartido" class="modal-title" align="center" >Arsenal vs Real Madrid</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Club<i id="advertencia1" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                            <select id="dropdownClub1" class="form-control" onchange="desplegarImagenClub1(this.value);">
                                <option disabled selected value> -- Seleccione una opción -- </option>
                            </select>
                            <br>
                            <img id="fotoEquipo1" src="image/arsenal.png" height="180" width="180">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label align="center">Categoria<i id="advertencia2" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                            <select id="dropdownCategoria" class="form-control" onchange="obtenerListaClubes(this.value); desplegarImagenClub1(-1); desplegarImagenClub2(-1); obtenerListaTorneos(this.value);">
                                <option disabled selected value> -- Seleccione una opción -- </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label align="center">Fecha<i id="advertencia3" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                            <input id="fecha" type="date" class="form-control">
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-lg-4" >Inicio<i id="advertencia4" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                            <input class="col-lg-8" type="text" id="horaIni" data-format="HH:mm" data-template="HH : mm" name="datetime">
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4">Fin<i id="advertencia5" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                            <input class="col-lg-8" type="text" id="horaFin" data-format="HH:mm" data-template="HH : mm" name="datetime2">
                        </div>
                        <div class="form-group">
                            <label>Cancha</label>
                            <input id="cancha" class="form-control" placeholder="Puede dejarse en blanco..." maxlength="50">
                        </div>
                        <div class="form-group">
                            <label align="center">Torneo<i id="advertencia9" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                            <select id="dropdownTorneo" class="form-control">
                                <option disabled selected value> -- Seleccione una opción -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Club<i id="advertencia6" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                            <select id="dropdownClub2" class="form-control" onchange="desplegarImagenClub2(this.value)">
                                <option disabled selected value> -- Seleccione una opción -- </option>
                            </select>
                            <br>
                            <img id="fotoEquipo2" src="image/RM.jpg" height="180" width="180">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-4" align="center" >
                        <label align="center">Goles <i id="advertencia7" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                        <input type="number" id="golesEquipo1" min="0" max="99" placeholder="0" data-bind="value:replyNumber" />
                    </div>
                    <div class="col-lg-4">
                        <h2  class="modal-title" align="center" >-</h2>
                    </div>
                    <div class="col-lg-4" align="center">
                        <label align="center">Goles <i id="advertencia8" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                        <input type="number" id="golesEquipo2" min="0" max="99" placeholder="0" data-bind="value:replyNumber" />
                    </div>
                </div>
                <div class="row">
                    <br>
                    <div class="col-lg-1">
                    </div>
                    <div class="form-group col-lg-2"">
                    <button id="eliminar" type="button" class="btn btn-danger" value="registrar">Eliminar</button>
                      </div>
                    <div class="col-lg-5">
                    </div>
                    <div class="form-group col-lg-2"">
                        <button id="guardar" type="button" class="btn btn-success" value="registrar">Guardar</button>
                    </div>
                    <div class="form-group col-lg-2"">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mensaje Error -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalMensaje">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="h4Error" class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p id="pError"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Mensaje Confirmacion -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalConfirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="tituloConfirmacion" class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <p id="mensajeConfirmacion">¿Está seguro que desea ingresar esta información?</p>
            </div>
            <div class="modal-footer">
                <button id="confirmar" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Mensaje Confirmacion Eliminar-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalConfirmacionEliminar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="tituloConfirmacionEliminar" class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <p id="mensajeConfirmacionEliminar">¿Está seguro que desea eliminar este partido?</p>
            </div>
            <div class="modal-footer">
                <button id="confirmarEliminar" type="button" class="btn btn-success" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</html>
