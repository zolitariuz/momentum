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
							<li class="columna c-2">
								<a href="alimentos.php">Alimentos</a>
							</li>
							<li class="columna c-2">
								<a href="fiesta.php">Fiesta</a>
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
						<li class="saldo columna c-2">Saldo: $<?php echo $saldo; ?>.00</li>

					</ul><!-- info-usuario -->

					<ul class="clearfix">

						<li class="columna c-4"><strong>País: <?php echo $pais; ?></strong></li>
						<li class="columna c-4"><strong>RP:</strong></li>
						<li class="columna c-4"><strong>Tipo de usuario: <?php echo $tipo; ?></strong></li>

					</ul><!-- info-usuario -->

				</div><!-- info-usuario -->

				<h2>Agregar salgo</h2>

				<form class="saldo-form columna c-6 center" action="">
					<input class="full" type="text">
					<input class="text-center center columna c-6 block" type="submit" value="agregar">
				</form>

			</div><!-- main -->

		</div><!-- container -->

		<footer>

		</footer>

	</body>

</html>

