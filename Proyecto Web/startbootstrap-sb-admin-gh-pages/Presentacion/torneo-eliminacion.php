<?php
include "menuGlobal.php";

?>
<html>
<head>
    <meta charset="UTF-8">
    <!--    <title>Testing jQuery Gracket Version 1.5.5</title>-->
    <style type="text/css">
        /* formatting page */
        /*body { font-family: helvetica, verdana, arial, sans-serif; font-size: 12px; background-color: #efefef; padding: 35px; color: #333;}*/
        /*.wrapper { margin: 0; width: 100%; overflow: hidden; border-radius: 0 5px 5px 5px; }*/
        /*a {color: #2C96AF;}*/
        /*a:hover { color: #A0B43C; }*/
        /*h1 { font-size: 35px; line-height: 24px; }*/
        /*h1 small { font-size: 14px; font-weight: normal;}*/
        /*h1 a {text-decoration: none; text-transform: uppercase; text-shadow: 0 1px 0 #fff; }*/
        /*body > h3, .container-secondary > h3 { margin: 45px 0 0; font-size: 16px; background: #fff; display: inline-block; padding: 15px 25px 15px 15px; border-radius: 5px 5px 0 0}*/
        /*body > h3 p, .container-secondary > h3 > p { color: #CCCCCC; font-size: 14px; font-weight: normal; margin: 2px 0 0; }*/

        /* theme */
        .g_gracket {
            width: 1500px;
            background-color: #fff;
            padding: 55px 15px 5px;
            line-height: 100%;
            position: relative;
            overflow: hidden;
        }

        .g_round {
            float: left;
            margin-right: 70px;
        }

        .g_game {
            position: relative;
            margin-bottom: 15px;
            box-shadow: 3px 4px 0px #ddd;
            border: 1px solid #fff;
            border-top: 0;
            border-left: 0;
        }

        .g_gracket h3 {
            min-width: 180px;
            margin: 0;
            padding: 10px 8px 8px;
            font-size: 18px;
            font-weight: normal;
            color: #fff
        }

        /* @note: this width determinds node size */
        .g_team {
            background: #3597AE;
        }

        .g_round_label {
            top: -5px;
            font-weight: normal;
            color: #ccc;
            text-align: center;
            font-size: 18px
        }

        .g_team:last-child {
            background: #FCB821;
        }

        .g_round:last-child {
            margin-right: 20px;
        }

        .g_winner {
            background: #444;
        }

        .g_winner .g_team {
            background: none;
        }

        .g_current {
            cursor: pointer;
            background: #A0B43C !important;
        }

        /* custom colors*/
        .g_team_custom {
            background: #444;
            border-radius: 50px 50px 0 0;
        }

        .g_team_custom:last-child {
            background: #777;
            border-radius: 0 0 50px 50px;
        }

        .g_winner_custom .g_team_custom {
            background: none;
            border-radius: 50px;
        }

        .g_winner_custom {
            background: #444;
            border-radius: 50px;
        }

        .g_current_custom {
            cursor: pointer;
            background: #900 !important;
        }

        .g_gracket .g_team_custom h3 {
            font-weight: bold;
            padding: 30px;
            text-shadow: 0 2px 1px #222222;
            text-transform: uppercase;
        }

        .g_game_custom {
            position: relative;
            margin-bottom: 15px;
        }

        /* secondary-bracket */
        .container-secondary {
            position: relative;
            overflow: hidden;
        }

        .secondary-bracket {
            bottom: 40px;
            left: 802px;
            position: absolute;
            width: 500px;
        }

        .container-secondary h4 {
            color: #CCCCCC;
            font-weight: normal;
            left: 0;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 55px;
            z-index: 9999;
        }

        .secondary-bracket .g_round_label {
            top: -25px;
        }

        .secondary-bracket > div {
            padding-top: 35px;
        }
    </style>


    <!-- main lib -->
    <script type="text/javascript" src="js/torneo/jquery.gracket.js"></script>

    <!--    <script type="text/javascript" src="js/test.js"></script>-->

</head>
<body>
<div class="row">
    <div class="my_gracket" id="bracket"></div>
    <div class="form-group row col-lg-3">
        <label align="left">Torneo</label>
        <select id="dropdownTorneo" class="form-control" onchange="actualizarBracket(this.value)">
        </select>
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
<script src="js/torneo/bracket-torneo.js"></script>

</body>
</html>
