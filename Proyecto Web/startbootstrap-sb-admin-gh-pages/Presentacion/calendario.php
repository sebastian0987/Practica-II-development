<?php
include "menuGlobal.php";
?>
<html>
<head>

    <meta charset='utf-8' />
<!--    <link href='css/calendar/fullcalendar.min.css' rel='stylesheet' />-->
<!--    <link href='css/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />-->
<!--    <script src='js/calendar/moment.min.js'></script>-->
<!--    <script src='js/calendar/jquery.min.js'></script>-->
<!--    <script src='js/calendar/fullcalendar.min.js'></script>-->
<!--    <script src='js/calendar/locale-all.js'></script>-->
<!--    <script src='js/calendar/calendario.js'></script>-->

    <link href='css/calendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link href='css/jquery.modal.css' rel='stylesheet' media='print' />
    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script src='js/calendar/moment.min.js'></script>
    <script src='js/calendar/fullcalendar.min.js'></script>
    <script src='js/calendar/locale-all.js'></script>
    <script src='js/calendar/calendario.js'></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <div class="row">
        <div align="center" class="col-lg-3">
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
            <IMG SRC="image/logo.png" class="escudoPrimario">
        </div>
<!--        <h1 class="page-header" align="center"></h1>-->
        <br>
        <div class="col-lg-9" id='calendar'></div>
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


<div class="row">
    <div class="page-header">
    </div>
    <div class="well" style="text-align: center">
        <p>Union Comunal Deportiva Vecinal Liga Sector Norte * R.U.T.: 72.470.300-3 * Numero Contacto: 97105118 *
            Correo: liganorteantofagasta@gmail.com * Fecha Fundacion: 07/01/1977 * Personalidad Jurídica Nº358</p>
    </div>
</div>


</body>

<!--Modal-->

<div class="modal fade" tabindex="-1" role="dialog" id="detallePartido">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h3 id="tituloPartido" class="modal-title" align="center" >Arsenal vs Real Madrid</h3>

            </div>
            <div class="modal-body row">
                <div class="col-lg-4">
                    <img id="fotoEquipo1" src="image/arsenal.png" height="180" width="180" align="center">
                </div>
                <div class="col-lg-4">
                    <h4 id="fecha"   align="center">jueves, 23 de febrero de 2017</h4>
                    <h4 id="hora"    align="center">De 20:00 a 21:00</h4>
                    <h4 id="cancha"  align="center">Cancha:</h4>
                    <h4 id="torneo"  align="center">Torneo:</h4>
                </div>
                <div class="col-lg-4">
                    <img id="fotoEquipo2" src="image/RM.jpg" height="180" width="180" align="center">
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-4" align="center" >
                        <h2 id="golesEquipo1" >2</h2>
                    </div>
                    <div class="col-lg-4">
                        <h2  class="modal-title" align="center" >_</h2>
                    </div>
                    <div class="col-lg-4" align="center">
                        <h2 id="golesEquipo2" >1</h2>
                    </div>
                </div>
                <!--                <button id="btConfirmar" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>-->
                <!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
            </div>
        </div>
    </div>
</div>

</html>
