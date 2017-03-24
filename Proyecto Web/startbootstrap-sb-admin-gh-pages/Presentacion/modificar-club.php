<?php
/**
 * Created by PhpStorm.
 * User: tatan
 * Date: 26-01-2017
 * Time: 11:46
 */
include "menuGlobal.php";
?>

<html>

<body>
<div class="row">
    <h1 class="page-header">Modificar Club Deportivo</h1>
</div>
<div class="row">
    <IMG id="escudoClubDeportivo" height="150" width="150">
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label>Nombre </label>
            <input id="tbNombre" class="form-control" placeholder="Club Deportivo Primero de Mayo" maxlength="50">
        </div>
        <div class="form-group">
            <label>RUT (Ingresar sin guion)</label>
            <input id="tbRut" class="form-control" placeholder="12345678k" disabled>
        </div>
<!--        <div class="form-group">-->
<!--            <label>Numero Contacto</label>-->
<!--            <input id="tbContacto" class="form-control" placeholder="12345678">-->
<!--        </div>-->
        <div class="form-group">
            <label>Fecha Fundacion </label>
            <input id="tbFechaFundacion" class="form-control" type="date">
        </div>
        <div class="form-group">
            <label>Personalidad Juridica </label>
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
            <label>Datos Dirigentes </label>
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
            <label>Foto (Ingrese una imagen solo en caso de que desee cambiar la actual)</label>
            <form enctype="multipart/form-data">
                <input id="escudoClub" name="file" type="file" accept="image/*">
            </form>
        </div>
        <div class="form-group">
            <button id="btAceptar" type="button" class="btn btn-success" value="registrar">Aceptar</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/modificar-club.js"></script>

</body>

<!-- Mensaje Error -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalMensaje">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#FFBABA">
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
        </div>
    </div>
</div>

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
                        <label id="mensajeModalSolicitud" for="recipient-name" class="form-control-label">Ingrese RUT del Club Deportivo:</label>
                        <input id="tbBuscar" type="text" class="form-control" placeholder="12345678k" maxlength="9">
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
                <p id="mensajeConfirmacion">¿Está seguro que desea cambiar esta información?</p>
            </div>
            <div class="modal-footer">
                <button id="btConfirmar" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</html>
