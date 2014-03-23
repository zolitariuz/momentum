<?php 
	session_start();

	$cb = $_SESSION['id'];

	// ¿existe sesión activa y usuario válido?
	$deco = existeCodBar($cb);
	if(isset($_SESSION['usuario']) && $deco) {

		// Datos usuario
		$nombre =  $deco['nombre'];
		$apellidos = $deco['apellido'];
		($deco['tipo']=='AIE') ? $tipo = 'AIESEC' : $tipo = 'Alumni';
		$pais = $deco['pais'];
		// Saldo
		$saldo = $deco['saldo'];
		// Check-in info
		$cuarto = $deco['cuarto'];
		$ci_hotel = $deco['ci_hotel'];
		$ci_gala = $deco['ci_gala'];
		$ci_noche_mex = $deco['ci_noche_mex'];
		$ci_y2b = $deco['ci_y2b'];
?>
<!doctype html>
	<head>
		<meta charset="utf-8">

		<title>Momentum México 2014</title>

		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="style.css">

		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cleartype" content="on">
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>

	<body>
		<!--[if lt IE 9]>
			<p class="chromeframe">Estás usando una versión <strong>vieja</strong> de tu explorador. Por favor <a href="http://browsehappy.com/" target="_blank"> actualiza tu explorador</a> para tener una experiencia completa.</p>
		<![endif]-->
		<div class="container">

			<header>

				<div class="width clearfix">

					<a class="logout columna c-1 right" href="#">
						Logout
					</a>

					<div class="clear"></div>

					<a class="span c-1" href="general.php">
						<img src="images/logo-momentum.png" alt="">
					</a>

					<nav class="columna c-11" >
						<ul class="clearfix">
							<li class="columna c-2">
								<a href="check.php">Check-in/out</a>
							</li>
							<li class="activo columna c-2">
								<a href="alimentos.php">Alimentos</a>
							</li>
							<li class="columna c-2">
								<a href="fiesta.php">Fiesta</a>
							</li>
							<li class="columna c-2">
								<a href="merchandise.php">Merchandise</a>
							</li>
							<li class="columna c-2">
								<a href="saldo.php">Saldo</a>
							</li>
							<li class="columna c-2">
								<a href="movimientos.php">Movimientos</a>
							</li>
						</ul>
					</nav>

				</div><!-- width -->

			</header>

			<div class="main width">

				<div class="info-usuario">

					<ul class="clearfix">

						<li class="columna c-8"><strong>Nombre:</strong></li>
						<li class="columna c-2"><strong>No. de cuarto:</strong></li>
						<li class="saldo columna c-2">Saldo: $680</li>

					</ul><!-- info-usuario -->

					<ul class="clearfix">

						<li class="columna c-4"><strong>País:</strong></li>
						<li class="columna c-4"><strong>RP:</strong></li>
						<li class="columna c-4"><strong>Tipo de usuario:</strong></li>

					</ul><!-- info-usuario -->

				</div><!-- info-usuario -->

				<h2>Alimentos AIESEC</h2>

				<div class="columnas">

					<div class="columna c-4">

						<h3>Desayunos</h3>

						<div class="span c-4">&nbsp;</div>

						<div class="cantidad columna c-3">
							6
						</div>

						<div class="restar columna c-1">
							<i class="fa fa-minus-square fa-lg"></i>
						</div>

						<div class="span c-4">&nbsp;</div>

					</div><!-- columna c-3 -->

					<div class="columna c-4">

						<h3>Comidas</h3>

						<div class="span c-4">&nbsp;</div>

						<div class="cantidad columna c-3">
							7
						</div>

						<div class="restar columna c-1">
							<i class="fa fa-minus-square fa-lg"></i>
						</div>

					</div><!-- columna c-3 -->

					<div class="columna c-4">

						<h3>Cenas</h3>

						<div class="span c-4">&nbsp;</div>

						<div class="cantidad columna c-3">
							4
						</div>

						<div class="restar columna c-1">
							<i class="fa fa-minus-square fa-lg"></i>
						</div>

					</div><!-- columna c-3 -->

				</div><!-- columnas -->

				<br />
				<br />
				<br />
				<br />
				<br />

				<h2>Alimentos Alumni</h2>

				<div class="columnas">

					<div class="columna c-6">

						<h3>Desayunos</h3>

						<div class="span c-4">&nbsp;</div>

						<div class="cantidad columna c-3">
							3
						</div>

						<div class="restar columna c-1">
							<i class="fa fa-minus-square fa-lg"></i>
						</div>

					</div><!-- columna c-3 -->

					<div class="columna c-6">

						<h3>Comidas</h3>

						<div class="span c-4">&nbsp;</div>

						<div class="cantidad columna c-3">
							4
						</div>

						<div class="restar columna c-1">
							<i class="fa fa-minus-square fa-lg"></i>
						</div>

					</div><!-- columna c-3 -->

				</div><!-- columnas -->


			</div><!-- main -->

		</div><!-- container -->

		<footer>

		</footer>

	</body>

</html>
<?php
	} else if(isset($_SESSION['usuario']))
		header('Location: general.php');
	else 
		header('Location: index.php');

	// FUNCIONES
	function existeCodBar($cb) {
		$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
		if (mysqli_connect_errno()){
		  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
		} 
		$qUsuario="SELECT * FROM T_Usuario U INNER JOIN T_Saldo S ON S.F_Id = U.F_Id INNER JOIN T_CheckIn CI ON CI.F_Id = U.F_Id WHERE U.F_Id = '".$cb."'";

		$aUsuario=mysqli_query($con, $qUsuario);
		
		if($rUsuario = mysqli_fetch_array($aUsuario)) {
			$datosUsuario = array(
				"id"=>$rUsuario['F_Id'],
				"nombre"=>$rUsuario['F_Nombre'],
				"apellido"=>$rUsuario['F_Apellidos'],
				"pais"=>$rUsuario['F_Pais'],
				"tipo"=>$rUsuario['F_Tipo'],
				"saldo"=>$rUsuario['F_Saldo'], 
				"cuarto"=>$rUsuario['F_Cuarto'],
				"ci_hotel"=>$rUsuario['F_Hotel'],
				"ci_gala"=>$rUsuario['F_CenaGala'],
				"ci_noche_mex"=>$rUsuario['F_NocheMex'],
				"ci_y2b"=>$rUsuario['F_Y2B']
			);
			return $datosUsuario;
		} else {
			return 0;
		}
	}
?>
