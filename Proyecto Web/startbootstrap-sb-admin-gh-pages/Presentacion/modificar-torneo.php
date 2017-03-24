<?php
include "menuGlobal.php";
?>
<html>
<head>
    <script src="js/torneo/modificar-torneo.js"></script>
    <link href="css/registrar-jugador.css" rel="stylesheet">
<!--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!--    <link href='css/jquery.modal.css' rel='stylesheet' media='print' />-->
<!--    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />-->
<!--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
</head>
<body>
<div class="container">
<h3 class="page-header" id="encabezado" align="left">Seleccione el torneo que desea modificar</h3>
<div class="form-group row col-lg-4">

    <label align="left">Torneo</label>
    <select id="dropdownTorneo" class="form-control" onchange="actualizarDatosTorneo(this.value)">
    </select>
    <br>
    <label align="left">Nombre</label>
    <input id="nombreTorneo" class="form-control">
    </input>
    <br>
    <button id="bModificar" type="button" class="btn btn-success">Modificar</button>
    <button id="bFinalizar" type="button" class="btn btn-warning">Dar por finalizado</button>

</div>
</div>

</body>

<!-- Mensaje Confirmacion -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmarModificar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 id="tituloConfirmacion" class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <p id="mensajeConfirmacion">¿Está seguro que desea modificar esta información?</p>
            </div>
            <div class="modal-footer">
                <button id="confirmar" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--Mensaje-->
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
