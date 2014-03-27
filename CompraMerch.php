<?php
	session_start();

	$id = $_SESSION['id'];

	$item = $_GET['item'];

	if($item == "sombrero") {
		$precio = 10;
		$descMov = 'COMPRA SOMBRERO';
	} else if($item == "guayabera") {
		$precio = 200;
		$descMov = 'COMPRA GUAYABERA';
	} else if($item == "playera") {
		$precio = 10;
		$descMov = 'COMPRA PLAYERA';
	} else if($item == "thermo") {
		$precio = 25;
		$descMov = 'COMPRA THERMO';
	} else if($item == "mochila") {
		$precio = 30;
		$descMov = 'COMPRA MOCHILA';
	} else if($item == "comodin-1") {
		$precio = 1;
		$descMov = 'COMODIN $1 US';
	} else if($item == "comodin-2") {
		$precio = 2;
		$descMov = 'COMODIN $2 US';
	} else if($item == "comodin-5") {
		$precio = 5;
		$descMov = 'COMODIN $5 US';
	}

	// Conectar con bd
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 

	// Restar un cena
	$query="UPDATE T_Saldo SET F_Saldo = F_Saldo - ".$precio." WHERE F_Id = '".$id."'";
	$restarDrink=mysqli_query($con, $query);
	// obtener nuevo saldo
	$query="SELECT F_Saldo FROM T_Saldo WHERE F_Id = '".$id."'";
	$saldo=mysqli_query($con, $query );
	if($data = mysqli_fetch_array($saldo))
		$nuevoSaldo = $data[0];

	// Registra movimiento
	$query="INSERT INTO T_Movimientos VALUES ('".$id."', 'MERCHANDISING',-'".$precio."' ,NOW(), '".$descMov."')";
	$insertaMovimiento=mysqli_query($con, $query);	

	$saldoJSON = array('nuevoSaldo' => $nuevoSaldo);
		
	// Desconectar bd
	mysqli_close($con);
	// Manda JSON con nuevo status de checkin
	echo json_encode($saldoJSON);
?>