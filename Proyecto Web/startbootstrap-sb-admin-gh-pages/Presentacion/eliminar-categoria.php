<?php
include "menuGlobal.php";
?>

<html>
<body>

<div class="row">
    <h1 class="page-header">Eliminar Categoría</h1>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label>Categoria </label>
            <select id="dropdownCategoria" class="form-control" >
                <option disabled selected value> -- seleccione una opcion -- </option>
            </select>
        </div>
        <div class="form-group">
            <button id="btAceptar" type="button" class="btn btn-success" value="registrar">Aceptar</button>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/eliminar-categoria.js"></script>
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
                <p id="mensajeConfirmacion">¿Está seguro que desea eliminar esta categoría?</p>
            </div>
            <div class="modal-footer">
                <button id="btConfirmar" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</html>
