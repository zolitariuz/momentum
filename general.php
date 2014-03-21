<?php 
	$id = $_POST['id'];
	session_start($id);

	if(isset($_SESSION['usuario'])){
?>
<!doctype html>
	<head>
		<meta charset="utf-8">
		<title>Momentum México 2014</title>
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="style.css">
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

			<header class="index" >

				<img class="columna c-3 center block" src="images/logo-momentum.png" alt="">

			</header>

			<div class="main width">

				<form name="codigo" class="codigo-form columna c-6 center"  method="post">
					<input name="codigo" class="full" type="text" >
					<label class="text-center full block" for="codigo">Código de Barras</label>
				</form>

			</div><!-- main -->

		</div><!-- container -->

		<footer>

		</footer>
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script>
			$(document).ready(function(){
				 $('form input').keypress(function (e) {
				   	if (e.which == 13) {
				   		var cb = $('input').val();
				     	window.location.replace("check.php?cb="+cb);
				     	return false;    	
					}
				});
			})
		</script>
	</body>
</html>
<?php
	}	
	else
		header('Location: index.php');
?>
