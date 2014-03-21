<?php
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 

	$usuario = $_POST['usuario'];
	$password = $_POST['password'];

	$qUsuario="SELECT * FROM T_Login WHERE F_Usuario = '".$usuario."' AND F_Password = '".$password."'";

	$aUsuario=mysqli_query($con, $qUsuario);
	
	if($rUsuario = mysqli_fetch_array($aUsuario)) {
		session_start();
		$_SESSION['usuario'] = $usuario;
		header('Location: general.php?id='. session_id()) ;	
	} else {
		header('Location: index.php');
	}

?>