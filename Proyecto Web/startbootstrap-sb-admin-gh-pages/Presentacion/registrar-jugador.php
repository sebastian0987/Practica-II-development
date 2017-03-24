<?php
include "menuGlobal.php";
?>

<html>
<!--<head>-->
<!--    <link href="css/registrar-jugador.css" rel="stylesheet">-->
<!--</head>-->

<body>

<div class="row">
    <h1 class="page-header">Registrar Jugador</h1>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label>Nombre Completo <i id="advertencia1" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbNombre" class="form-control" placeholder="Andrés Aguilera Méndez" maxlength="50">
        </div>
<!--        <div class="form-group">-->
<!--            <label>Apellidos <i id="advertencia2" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>-->
<!--            <input id="tbApellidos" class="form-control" placeholder="Aguilera Méndez" maxlength="30">-->
<!--        </div>-->
        <div class="form-group">
            <label>RUT (Ingresar sin guion)<i id="advertencia2" class="fa fa-exclamation-triangle"
                                              aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbRut" class="form-control" placeholder="12345678k" maxlength="9">
        </div>
        <div class="form-group">
            <label>Categoria<i id="advertencia3" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i>
            </label>
            <select id="dropdownCategoria" class="form-control" onchange="obtenerListaClubes(this.value);">
                <option disabled selected value> -- seleccione una opción -- </option>
            </select>
        </div>
        <div class="form-group">
            <label>Club Deportivo <i id="advertencia4" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i></label>
            <select id="dropdownClub" class="form-control">
                <option disabled selected value> -- seleccione una opción -- </option>
            </select>
        </div>
        <div class="form-group">
            <label>Fecha Inscripción <i id="advertencia5" class="fa fa-exclamation-triangle"
                                        aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbFechaInscripcion" type="date" class="form-control">
        </div>
        <div class="form-group">
            <label>Fecha Nacimiento <i id="advertencia6" class="fa fa-exclamation-triangle"
                                       aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbFechaNacimiento" type="date" class="form-control">
        </div>
        <div class="form-group">
            <label>Rol Jugador<i id="advertencia7" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbRolJugador" class="form-control" maxlength="30">
        </div>
        <div class="form-group">
            <label>Rol ANDABA<i id="advertencia8" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbRolAndaba" class="form-control" maxlength="30">
        </div>
<!--        <div class="form-group">-->
<!--            <label>Ingrese foto del jugador</label>-->
<!--            <input id="fotoJugador" type="file">-->
<!--        </div>-->
        <div class="form-group">
            <button id="btAceptar" type="button" class="btn btn-success" value="registrar">Aceptar</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="page-header">
    </div>
    <div class="well">
        <p>Union Comunal Deportiva Vecinal Liga Sector Norte * R.U.T.: 72.470.300-3 * Numero Contacto: 97105118 *
            Correo: liganorteantofagasta@gmail.com * Fecha Fundacion: 07/01/1977 * Personalidad Jurídica Nº358</p>
    </div>
</div>
<script type="text/javascript" src="js/registrar-jugador.js"></script>
</body>


<!-- Mensaje Error -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalMensaje">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="encabezadoModalMensaje" class="modal-header">
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
            <div class="modal-header" style="background-color:#FEEFB3">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="tituloConfirmacion" class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <p id="mensajeConfirmacion">¿Está seguro que desea ingresar esta información?</p>
            </div>
            <div class="modal-footer">
                <button id="btConfirmar" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</html>
