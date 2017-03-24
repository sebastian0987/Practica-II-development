<?php
include "menuGlobal.php";
?>

<html lang="es">
<head>
    <!-- Website CSS style -->
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="container">
    <div class="row main">
        <div class="panel-heading">
            <div class="panel-title text-center">
                <h1 class="title">Liga Sector Norte</h1>
                <hr />
            </div>
        </div>
        <div class="main-login main-center">
            <form class="form-horizontal" method="post" action="#">
                <label id="errorUsuario" style="color:red; display: none;"></label>
                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Correo electrónico</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="correo" id="correo"  placeholder="Ingrese su correo electrónico"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Contraseña</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="password" id="password"  placeholder="Ingrese su contraseña"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Confirmar contraseña</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="password" id="confirmarPassword"  placeholder="Ingrese su contraseña"/>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <button id="btAceptar" type="button" class="btn btn-success btn-lg btn-block login-button">Aceptar</button>
                </div>
                <div class="login-register">
                    <a href="index.php">Regresar a la página principal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/registrar-usuario.js"></script>

</body>
<div class="modal fade" tabindex="-1" role="dialog" id="modalMensaje">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="encabezadoModalMensaje" class="modal-header" style="background-color: #DFF2BF">
                <h4 class="modal-title">Éxito</h4>
            </div>
            <div class="modal-body">
                <p>La nueva cuenta de usuario a sido registrada exitosamente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Registrar otra cuenta de usuario</button>
                <button type="button" class="btn btn-success" onclick="location.href = 'index.php'">Volver Página Principal</button>
            </div>
        </div>
    </div>
</div>
</html>
