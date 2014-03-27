<?php
	session_start();
	$cb = $_GET['cb'];

	// ¿existe sesión activa y usuario válido?
	if(isset($_SESSION['usuario']) ){
		$deco = existeCodBar($cb);
		$nombre =  $deco['nombre'];
		$apellidos = $deco['apellido'];
		($deco['tipo']=='AIE') ? $tipo = 'AIESEC' : $tipo = 'Alumni';
		$pais = $deco['pais'];

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

					<a class="span c-1" href="general.php">
						<img src="images/logo-momentum.png" alt="">
					</a>

					<nav class="columna c-11" >
						<ul class="clearfix">
							<li class="columna c-2">
								<a href="check.php">Check-in/out</a>
							</li>
							<li class="columna c-2">
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
				<p class="saldo columna c-2 right">Saldo: $680</p>
				<div class="clearfix"></div>
				<div class="info-usuario">

					<ul class="clearfix">

						<li class="columna c-8"><strong>Nombre: <?php echo $nombre." ".$apellidos; ?></strong></li>
						<li class="columna c-2"><strong>No. de cuarto:</strong></li>

					</ul><!-- info-usuario -->

					<ul class="clearfix">

						<li class="columna c-4"><strong>País: <?php echo $pais; ?></strong></li>
						<li class="columna c-4"><strong>RP:</strong></li>
						<li class="columna c-4"><strong>Tipo de usuario: <?php echo $tipo; ?></strong></li>

					</ul><!-- info-usuario -->

				</div><!-- info-usuario -->

				<div class="check-in">

				</div><!-- check-in -->

				<h2>Check-in</h2>

				<div class="columnas">

					<div class="columna c-3">

						<h3>Hotel</h3>

						<div class="check in columna c-6">
							<i class="fa fa-sign-in fa-2x"></i>
						</div><!-- in -->

						<div class="check out columna c-6">
							<i class="fa fa-sign-out fa-2x"></i>
						</div><!-- out -->

					</div><!-- columna c-3 -->

					<div class="columna c-3">

						<h3>Cena de gala</h3>

						<div class="check in columna c-6">
							<i class="fa fa-sign-in fa-2x"></i>
						</div><!-- in -->

						<div class="check out columna c-6">
							<i class="fa fa-sign-out fa-2x"></i>
						</div><!-- out -->

					</div><!-- columna c-3 -->

					<div class="columna c-3">

						<h3>Noche mexicana</h3>

						<div class="check in columna c-6">
							<i class="fa fa-sign-in fa-2x"></i>
						</div><!-- in -->

						<div class="check out columna c-6">
							<i class="fa fa-sign-out fa-2x"></i>
						</div><!-- out -->

					</div><!-- columna c-3 -->

					<div class="columna c-3">

						<h3>Y2B</h3>

						<div class="check in columna c-6">
							<i class="fa fa-sign-in fa-2x"></i>
						</div><!-- in -->

						<div class="check out columna c-6">
							<i class="fa fa-sign-out fa-2x"></i>
						</div><!-- out -->

					</div><!-- columna c-3 -->

				</div><!-- columnas -->

			</div><!-- main -->

		</div><!-- container -->

		<footer>

		</footer>

	</body>

</html>
<?php
	}
	else
		header('Location: general.php');

	function existeCodBar($cb) {
		$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
		if (mysqli_connect_errno()){
		  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
		}
		$qUsuario="SELECT * FROM T_Usuario WHERE F_Id = '".$cb."'";
		$aUsuario=mysqli_query($con, $qUsuario);

		if($rUsuario = mysqli_fetch_array($aUsuario)) {
			$datosUsuario = array(
				"nombre"=>$rUsuario['F_Nombre'],
				"apellido"=>$rUsuario['F_Apellidos'],
				"pais"=>$rUsuario['F_Pais'],
				"tipo"=>$rUsuario['F_Tipo'],

			);
			return $datosUsuario;
		} else {
			return 0;
		}
	}
?>

