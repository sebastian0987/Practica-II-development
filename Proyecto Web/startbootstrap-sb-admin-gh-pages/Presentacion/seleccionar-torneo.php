<?php
/**
 * Created by PhpStorm.
 * User: Andrés
 * Date: 05-03-2017
 * Time: 5:58
 */
include "menuGlobal.php";
?>
<html>
<head>
    <link href="css/registrar-jugador.css" rel="stylesheet">
    <script src="js/torneo/seleccionar-torneo.js"></script>
</head>
<body>
<div class="container">
<h3 class="page-header" id="encabezado" align="left">Seleccione el tipo de torneo que desea ver</h3>
    <div class="row">
        <div class="form-group row col-lg-3">
            <label align="left">Torneo</label>
            <select id="dropdownTorneo" class="form-control" onchange="verTorneo(this.value);">
                <option value="liga"> Liga </option>
                <option value="eliminacion"> Eliminación Directa </option>
                <option value="grupos"> Torneo por Grupos </option>
            </select>
            <br>
            <button id="verTorneo" type="button" class="btn btn-success ">Ver Torneo</button>
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
</body>

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
</html>
