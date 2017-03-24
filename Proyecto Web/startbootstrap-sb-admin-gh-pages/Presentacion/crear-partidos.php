<?php
/**
 * Created by PhpStorm.
 * User: Andrés
 * Date: 26-02-2017
 * Time: 19:16
 */

include "menuGlobal.php";
?>
<html>
<head>


    <!--   controlador-->
    <script src='js/calendar/crear-partidos.js'></script>
    <link href="css/registrar-jugador.css" rel="stylesheet">

<!--    timepicker -->
<!--    <link rel="stylesheet" href="css/datepicker.css"/>-->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/combodate.js"></script>
</head>

<body>

<div class="row">
    <h1 class="page-header">Crear un partido</h1>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Categoria<i id="advertencia1" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                <!--                <button id="btModalAgregarSerie" type="button" class="btn btn-xs btn-info">Agregar nueva serie</button>-->
            </label>
            <select id="dropdownCategoria" class="form-control" onchange="obtenerListaClubes(this.value);obtenerListaTorneos(this.value);">
                <option disabled selected value> -- Seleccione una opción -- </option>
            </select>
        </div>
        <div class="form-group">
            <label>Club Deportivo 1<i id="advertencia2" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
            <select id="dropdownClub1" class="form-control">
                <option disabled selected value> -- Seleccione una opción -- </option>
            </select>
        </div>
        <div class="form-group">
            <label>Club Deportivo 2<i id="advertencia3" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
            <select id="dropdownClub2" class="form-control">
                <option disabled selected value> -- Seleccione una opción -- </option>
            </select>
        </div>
        <div class="form-group">
            <label>Fecha <i id="advertencia4" class="fa fa-exclamation-triangle"
                                        aria-hidden="true"></i></label>
            <input id="tbFechaInscripcion" type="date" class="form-control">
        </div>
        <br>
        <div class="form-group row">
            <label class="col-lg-4 ">Inicio <i id="advertencia5" class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i></label>
            <input class="col-lg-8" type="text" id="horaIni" data-format="HH:mm" data-template="HH : mm" name="datetime">
        </div>
        <div class="form-group row">
            <label class="col-lg-4">Fin <i id="advertencia6" class="fa fa-exclamation-triangle"
                                           aria-hidden="true"></i></label>
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
</div>
<div class="form-group">
    <button id="aceptar" type="button" class="btn btn-success" value="registrar">Aceptar</button>
</div>



</body>





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
</html>

