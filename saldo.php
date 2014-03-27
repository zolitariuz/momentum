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

					<a class="escanear-cb columna c-2 right" href="general.php">
						Escanear código de barras
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
							<li class="columna c-2">
								<a href="alimentos.php">Alimentos</a>
							</li>
							<li class="columna c-2">
								<a href="fiesta.php">Drinks</a>
							</li>
							<li class="columna c-2">
								<a href="merchandise.php">Merchandise</a>
							</li>
							<li class="activo columna c-2">
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

						<li class="columna c-8"><strong>Nombre: <?php echo $nombre." ".$apellidos; ?></strong></li>
						<li class="columna c-2"><strong>No. de cuarto: <?php echo $cuarto; ?></strong></li>
						<li class="saldo columna c-2">Saldo: $<?php echo $saldo; ?>.00 US</li>

					</ul><!-- info-usuario -->

					<ul class="clearfix">

						<li class="columna c-4"><strong>País: <?php echo $pais; ?></strong></li>
						<li class="columna c-4"><strong>RP:</strong></li>
						<li class="columna c-4"><strong>Tipo de usuario: <?php echo $tipo; ?></strong></li>

					</ul><!-- info-usuario -->

				</div><!-- info-usuario -->

				<h2>Agregar saldo</h2>

				<form class="saldo-form columna c-6 center" action="">
					<input class="full" type="text">
					<input class="text-center center columna c-6 block" type="submit" value="agregar">
				</form>

			</div><!-- main -->

		</div><!-- container -->

		<footer>

		</footer>
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="js/functions.js"></script>
		<script>
			$(document).ready(function(){
				var tipo = '<?php Print($tipo); ?>';
				var saldo = '<?php Print($saldo); ?>';
			});
		</script>

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
		$qUsuario="SELECT * FROM T_Usuario U INNER JOIN T_Saldo S ON S.F_Id = U.F_Id  WHERE U.F_Id = '".$cb."'";

		$aUsuario=mysqli_query($con, $qUsuario);

		if($rUsuario = mysqli_fetch_array($aUsuario)) {
			$datosUsuario = array(
				"id"=>$rUsuario['F_Id'],
				"nombre"=>$rUsuario['F_Nombre'],
				"apellido"=>$rUsuario['F_Apellidos'],
				"pais"=>$rUsuario['F_Pais'],
				"tipo"=>$rUsuario['F_Tipo'],
				"saldo"=>$rUsuario['F_Saldo'],
			);
			return $datosUsuario;
		} else {
			return 0;
		}
	}
?>

