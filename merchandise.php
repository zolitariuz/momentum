<?php 
	session_start();

	$cb = $_SESSION['id']; 

	// ¿existe sesión activa y usuario válido?
	$deco = existeCodBar($cb);
	if(isset($_SESSION['usuario']) && $deco) {
		// Guarda codigo de barras en la sesión
		$_SESSION['id'] = $deco['id'];
		// Datos usuario
		$nombre =  $deco['nombre'];
		$apellidos = $deco['apellido'];
		($deco['tipo']=='AIE') ? $tipo = 'AIESEC' : $tipo = 'Alumni';
		$pais = $deco['pais'];
		// Saldo
		$saldo = $deco['saldo'];
		// Check-in info
		$cuarto = $deco['cuarto'];
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
							<li class="activo columna c-2">
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

						<li class="columna c-4"><strong>Nombre: </strong><?php echo $nombre." ".$apellidos; ?></li>
						<li class="columna c-4"><strong>No. de cuarto: </strong><?php echo $cuarto; ?></li>
						<li class="saldo columna c-4">Saldo: $<?php echo $saldo; ?>.00 US</li>

					</ul><!-- info-usuario -->

					<ul class="clearfix">

						<li class="columna c-4"><strong>País: </strong><?php echo $pais; ?></li>
						<li class="columna c-4"><strong>RP:</strong></li>
						<li class="columna c-4"><strong>Tipo de usuario: </strong><?php echo $tipo; ?></li>

					</ul><!-- info-usuario -->

				</div><!-- info-usuario -->

				<h2>Merchandise</h2>

				<div class="columna c-4">

					<div class="merch boton sombrero">Sombrero $10 US</div>

				</div><!-- columna c-4 -->

				<div class="columna c-4">

					<div class="merch boton guayabera">Guayabera $200 US</div>

				</div><!-- columna c-4 -->

				<div class="columna c-4">

					<div class="merch boton playera">Playera $10 US</div>

				</div><!-- columna c-4 -->

				<div class="clear"></div>

				<div class="span c-2">&nbsp;</div>

				<div class="columna c-4">

					<div class="merch boton thermo">Thermo $25 US</div>

				</div><!-- columna c-2 -->

				<div class="columna c-4">

					<div class="merch boton mochila">Mochila $30 US</div>

				</div><!-- columna c-2 -->

				<div class="clear"></div>

				<div class="columna c-4 comodin-1">

					<div class="merch boton">$1 US</div>

				</div><!-- columna c-2 -->

				<div class="columna c-4 comodin-2">

					<div class="merch boton">$2 US</div>

				</div><!-- columna c-2 -->

				<div class="columna c-4 comodin-5">

					<div class="merch boton">$5 US</div>

				</div><!-- columna c-2 -->

				<div class="columna c-6 insuficiente hide">

					<div class="">Saldo insuficiente para comprar merchandise, <a href="saldo.php">¿deseas agregar más dinero?</a></div>

				</div><!-- columna c-6 -->

			</div><!-- main -->

		</div><!-- container -->

		<footer>

		</footer>

		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="js/functions.js"></script>
		<script>
			$(document).ready(function(){
				var saldo = '<?php Print($saldo); ?>';
				escondeMerch();
				muestraMerchDisponible(saldo);
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
				"cuarto"=>$rUsuario['F_Cuarto']
			);
			return $datosUsuario;
		} else {
			return 0;
		}
	}
?>

