<?php
include "menuGlobal.php";
?>

<html>
<!--<head>-->
<!--    <link href="css/resgistrar-club.css" rel="stylesheet">-->
<!--</head>-->

<body>
<div class="row">
    <h1 class="page-header">Registrar Club Deportivo</h1>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label>Nombre <i id="advertencia1" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbNombre" class="form-control" placeholder="Club Deportivo Primero de Mayo" maxlength="50">
        </div>
        <div class="form-group">
            <label>RUT (Ingresar sin guion) <i id="advertencia2" class="fa fa-exclamation-triangle"
                                               aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbRut" class="form-control" placeholder="12345678k" maxlength="9">
        </div>
        <div class="form-group">
            <label>Fecha Fundacion <i id="advertencia3" class="fa fa-exclamation-triangle"
                                      aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbFechaFundacion" class="form-control" type="date">
        </div>
        <div class="form-group">
            <label>Personalidad Juridica <i id="advertencia4" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i></label>
            <input id="tbPersonalidadJuridica" class="form-control" maxlength="100">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group" id="checkboxCategoria">
            <label>Seleccione la(s) categoria(s) en la(s) que participara</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>Datos Dirigentes <i id="advertencia5" class="fa fa-exclamation-triangle"
                                       aria-hidden="true" style="color: transparent"></i></label>
            <div class="row">
                <div class="col-xs-3">
                    <input id="tbDirigenteRut" name="dirigentesRut" class="form-control" placeholder="RUT" maxlength="9">
                </div>
                <div class="col-xs-3">
                    <input id="tbDirigenteNombre" name="dirigentesNombre" class="form-control" placeholder="Nombre Completo" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input id="tbDirigenteCorreo" name="dirigentesCorreo" class="form-control" placeholder="Correo Electronico" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input id="tbDirigenteContacto" name="dirigentesContacto" class="form-control" placeholder="Numero de Contacto" maxlength="50">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesRut" placeholder="RUT" maxlength="9">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesNombre" placeholder="Nombre Completo" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesCorreo" placeholder="Correo Electronico" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesContacto" placeholder="Numero de Contacto" maxlength="50">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesRut" placeholder="RUT" maxlength="9">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesNombre" placeholder="Nombre Completo" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesCorreo" placeholder="Correo Electronico" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesContacto" placeholder="Numero de Contacto" maxlength="50">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesRut" placeholder="RUT" maxlength="9">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesNombre" placeholder="Nombre Completo" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesCorreo" placeholder="Correo Electronico" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesContacto" placeholder="Numero de Contacto" maxlength="50">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesRut" placeholder="RUT" maxlength="9">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesNombre" placeholder="Nombre Completo" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesCorreo" placeholder="Correo Electronico" maxlength="50">
                </div>
                <div class="col-xs-3">
                    <input class="form-control" name="dirigentesContacto" placeholder="Numero de Contacto" maxlength="50">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Foto (imagen que represente al club)<i id="advertencia6" class="fa fa-exclamation-triangle" aria-hidden="true" style="color: transparent"></i></label>
            <form enctype="multipart/form-data">
                <input id="escudoClub" name="file" type="file" accept="image/*">
            </form>
        </div>
        <div class="form-group">
            <button id="btAceptar" type="button" class="btn btn-success" value="registrar">Aceptar</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/registrar-club.js"></script>

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