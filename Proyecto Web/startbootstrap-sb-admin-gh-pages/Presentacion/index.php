<?php
include "menuGlobal.php";
?>
<html>
<head>
    <!-- Importar estilos -->
    <link href="css/index.css" rel="stylesheet">
    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>

</head>

<body>

<div class="row">
    <div class="col-lg-4">
        <IMG SRC="image/logo.png" class="escudoPrimario">
    </div>

    <div class="col-lg-8">
        <ul id="ulCategorias" class="nav nav-tabs">
        </ul>

        <div class="tab-content" id="liga">

        </div>
    </div>
    <div id="divCategorias" class="col-lg-8">

    </div>
</div>


<script src="js/torneo/grupos.js"></script>
<script src="js/torneo/liga.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</body>
</html>
