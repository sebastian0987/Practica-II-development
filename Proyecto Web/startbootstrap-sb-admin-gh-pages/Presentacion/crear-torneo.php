<?php
include "menuGlobal.php";

?>
<html>
<head>
    <link href="css/torneo/crearTorneo.css" rel="stylesheet">
    <link href="css/registrar-jugador.css" rel="stylesheet">

    <!--    <script src='js/calendar/jquery.min.js'></script>-->
    <script src="js/torneo/crearTorneo.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>




<body>

<div class="container" >
    <h1 class="page-header" id="encabezado" align="center">Elija un tipo de torneo</h1>
    <div class="row form-group product-chooser" id="contenedor">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="product-chooser-item selected">
                <img src="http://plainicon.com/download-icons/46266/plainicon.com-46266-0561-256px.png" id="liga" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                    <span class="title" align="center">Liga</span>
                    <span class="description">Competición del todos contra todos. Gana el que consigue más puntos.</span>
                    <input type="radio" name="product" value="mobile_desktop" checked="checked">
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="product-chooser-item">
                <img src="http://plainicon.com/download-icons/52561/plainicon.com-52561-4b10-512px.png" id="eliminacion" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Desktop">
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                    <span class="title" align="center">Eliminación Directa</span>
                    <span class="description">Los equipos avanzan si ganan cada partido y quedan eliminados a la primera derrota.</span>
                    <input type="radio" name="product" value="desktop">
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="product-chooser-item">
                <img src="http://plainicon.com/download-icons/54366/plainicon.com-54366-f575-256px.png" id="grupos" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile">
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                    <span class="title" align="center">Por Grupos</span>
                    <span class="description">Se juega una fase de grupos, luego eliminación directa con los equipos resultantes de cada grupo.</span>
                    <input type="radio" name="product" value="mobile">
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<!--    <br>-->
<!--    <div class="row">-->
<!--        <div class="col-lg-4"></div>-->
<!--        <div class="form-group col-lg-2" >-->
<!--            <button id="btAtras" type="button" class="btn btn-danger btn-lg" >Atrás</button>-->
<!--        </div>-->
<!--        <div class="col-lg-4"></div>-->
<!--        <div class="form-group col-lg-4" align="center">-->
<!--            <button id="btSiguiente" type="button" class="btn btn-success btn-lg" >Siguiente</button>-->
<!--        </div>-->
<!--    </div>-->
</body>

<!--Modal crear torneo-->

<div class="modal fade" tabindex="-1" role="dialog" id="modalCrearTorneo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h3 id="tituloModalCrearTorneo" class="modal-title" >Creando una liga</h3>
            </div>
            <div class="modal-body row">
                <!--                <div class="col-lg-2"></div>-->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nombre del torneo<i id="advertencia1" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                        <input id="nombreTorneo" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label align="left">Categoria (*)<i id="advertencia2" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                        <select id="dropdownCategoria" class="form-control" onchange="obtenerClubesPorCategoria(this.value);">
                            <option disabled selected value> -- Seleccione una opción -- </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label id="labelNumEquipos" align="center">Número de equipos<i id="advertencia3" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                        <select id="dropdownNumEquipos" onchange="uncheckAll()" class="form-control">
                            <option disabled selected value> -- Seleccione una opción -- </option>
                            <option value="8"> 8 </option>
                            <option id="opt16" value="16"> 16 </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="labelNumGrupos" align="center">Número de grupos<i id="advertencia4" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
                        <select id="dropdownNumGrupos" class="form-control">
                            <option disabled selected value> -- Seleccione una opción -- </option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group" id="checkboxClubes">
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="form-group">-->
                    <!--                        <label id="labelCuantosPasan" align="center">Número de equipos que clasifican por grupo<i id="advertencia5" class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>-->
                    <!--                        <select id="dropdownCuantosPasan" class="form-control">-->
                    <!--                            <option disabled selected value> -- Seleccione una opción -- </option>-->
                    <!--                            <option value="2"> 2 </option>-->
                    <!--                            <option value="4"> 4 </option>-->
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <label><em>(*) Las categorias que no aparezcan ya se encuentran jugando un torneo actualmente</em></label>
                    <label><em>Recuerde marcar el fin de un torneo después de su último partido</em></label>
                    <label><em>Si no aparece la categoría que desea, por favor asegúrese de que el torneo que estuvo jugando dicha categoría ha sido marcado como finalizado.</em></label>

                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <br>
                    <!--                    <div class="col-lg-8">-->
                </div>
                <div class="form-group col-lg-2"">
                <button id="crear" type="button" class="btn btn-success" value="registrar">Crear</button>
            </div>
            <div class="form-group col-lg-2"">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
</div>
</div>
</div>

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
                <p id="mensajeConfirmacion">¿Está seguro que desea iniciar un torneo?</p>
            </div>
            <div class="modal-footer">
                <button id="confirmar" type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

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