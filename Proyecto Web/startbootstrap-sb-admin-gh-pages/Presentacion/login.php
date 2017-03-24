<html lang="es">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="css/login.css">

		<!-- Website Font style https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css-->
	    <link rel="stylesheet" type='text/css' href="font-awesome/css/font-awesome.min.css" >

		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

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
                        <label id="errorUsuario" style="color:red;"></label>
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

						<div class="form-group ">
							<button id="btIngresar" type="button" class="btn btn-success btn-lg btn-block login-button">Ingresar</button>
						</div>
                        <div class="login-register">
                            <a href="index.php">Regresar a la página principal</a>
                        </div>
					</form>
				</div>
			</div>
		</div>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <script type="text/javascript" src="js/login.js"></script>
	</body>
</html>