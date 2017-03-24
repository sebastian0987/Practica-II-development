<?php
session_start();
if (isset($_SESSION['login'])) {
    $usuario = $_SESSION['login'];
} else {
    $usuario = 'publico';
    $url = "http://".$_SERVER['HTTP_HOST']."/".@$_SERVER['REQUEST_URI'] ;
    $paginaActual = basename( $url );
    switch ($paginaActual) {
        case "jugador.php":
            break;
        case "club-deportivo.php":
            break;
        case "categoria.php":
            break;
        case "login.php":
            break;
        case "index.php":
            break;
        case "index.html":
            break;
        case "seleccionar-torneo.php":
            break;
        case "calendario.php":
            break;
        case "liga.php":
            break;
        case "torneo-eliminacion.php":
            break;
        case "grupos.php":
            break;
        default:
            header('Location: acceso-denegado.php'); ;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liga Norte</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Importar estilos principales -->
    <link href="css/menuGlobal.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
</html>
<?php if ($usuario == "privado") { ?>
    <html>
    <body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav id="menu" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div id="menuTitulo" class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Liga Sector Norte</a>
            </div>

            <!-- Top Menu Items -->
            <div id="menuOpciones" class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-futbol-o"></i> Partidos <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="calendario.php"><i class="fa fa-list"></i> Ver Partidos</a>
                            </li>
                            <li>
                                <a href="modificar-partidos.php"><i class="fa fa-check-circle"></i> Marcar resultado</a>
                            </li>
                            <li>
                                <a href="crear-partidos.php"><i class="fa fa-plus-circle"></i> Crear un partido</a>
                            </li>
                            <li>
                                <a href="modificar-partidos.php"><i class="fa fa-pencil"></i> Modificar partidos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shield"></i> Clubes
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="registrar-club.php"><i class="fa fa-plus-circle"></i> Agregar</a>
                            </li>
                            <li>
                                <a href="modificar-club.php"><i class="fa fa-pencil"></i>Modificar</a>
                            </li>
                            <li>
                                <a href="eliminar-club.php"><i class="fa fa-minus-circle"></i> Eliminar</a>
                            </li>
                            <li>
                                <a href="club-deportivo.php"><i class="fa fa-search-plus"></i> Ver</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Jugadores
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="registrar-jugador.php"><i class="fa fa-plus-circle"></i> Agregar</a>
                            </li>
                            <li>
                                <a href="modificar-jugador.php"><i class="fa fa-pencil"></i> Modificar</a>
                            </li>
                            <li>
                                <a href="eliminar-jugador.php"><i class="fa fa-minus-circle"></i> Eliminar</a>
                            </li>
                            <li>
                                <a href="jugador.php"><i class="fa fa-search-plus"></i> Ver</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tags"></i> Categoría
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="registrar-categoria.php"><i class="fa fa-plus-circle"></i> Agregar</a>
                            </li>
                            <li>
                                <a href="modificar-categoria.php"><i class="fa fa-pencil"></i> Modificar</a>
                            </li>
                            <li>
                                <a href="eliminar-categoria.php"><i class="fa fa-minus-circle"></i> Eliminar</a>
                            </li>
                            <li>
                                <a href="categoria.php"><i class="fa fa-search-plus"></i> Ver</a>
                            </li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-trophy"></i> Torneos <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="seleccionar-torneo.php"><i class="fa fa-list"></i> Ver Torneos</a>
                            </li>
                            <li>
                                <a href="crear-torneo.php"><i class="fa fa-plus-circle"></i> Iniciar un torneo</a>
                            </li>
                            <li>
                                <a href="modificar-torneo.php"><i class="fa fa-minus-circle"></i> Modificar un torneo</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Cuentas de
                            Usuario <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="registrar-usuario.php"><i class="fa fa-sign-in"></i> Agregar Nueva Cuenta</a>
                            </li>
                            <li>
                                <a href="modificar-usuario.php"><i class="fa fa-pencil"></i> Modificar Contraseña</a>
                            </li>
                            <li>
                                <a href="eliminar-usuario.php"><i class="fa fa-minus-circle"></i> Eliminar Cuenta</a>
                            </li>
                            <li>
                                <a id="cerrarSesion" href="#"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
                            </li>
                            <!--
                            <li class="divider"></li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                            </li>
                            -->
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    </body>
    </html>
<?php }else{ ?>
    <html>
    <body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav id="menu" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div id="menuTitulo" class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Liga Sector Norte</a>
            </div>

            <!-- Top Menu Items -->
            <div id="menuOpciones" class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-futbol-o"></i> Partidos <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="calendario.php"><i class="fa fa-list"></i> Ver Partidos</a>
                            </li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shield"></i> Clubes
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li>
                                <a href="club-deportivo.php"><i class="fa fa-search-plus"></i> Ver</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Jugadores
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li>
                                <a href="jugador.php"><i class="fa fa-search-plus"></i> Ver</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tags"></i> Categoría
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li>
                                <a href="categoria.php"><i class="fa fa-search-plus"></i> Ver</a>
                            </li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-trophy"></i> Torneos
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="seleccionar-torneo.php"><i class="fa fa-list"></i> Ver Torneos</a>
                            </li>

                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Cuentas de
                            Usuario <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="login.php"><i class="fa fa-fw fa-user"></i> Iniciar Sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    </body>
    </html>
<?php }?>
<!-- Pie de Pagina Fijo
<footer>
    <nav id="piePagina" class="navbar navbar-inverse navbar-fixed-bottom">
        <p class="navbar-text" >Union Comunal Deportiva Vecinal Liga Sector Norte</p>
        <p class="navbar-text" > R.U.T.: 72.470.300-3 </p>
        <p class="navbar-text" > Contacto: 97105118 </p>
        <p class="navbar-text" > Region de Antofagasta </p>
    </nav>
</footer>
-->
<html>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/menuGlobal.js"></script>

</html>
<!--</body>-->
<!---->
<!--Modal para Seleccionar un Club-->
<!---->
<!---->
<!--</html>-->