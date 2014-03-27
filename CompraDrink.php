<?php
	session_start();

	$id = $_SESSION['id'];

	$drink = $_GET['drink'];

	if($drink == "cerveza") {
		$precio = 4;
		$descMov = 'COMPRA CERVEZA';
	}
	else{
		$precio = 6;
		$descMov = 'COMPRA LICOR';
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
	$query="INSERT INTO T_Movimientos VALUES ('".$id."', 'DRINKS',-'".$precio."' ,NOW(), '".$descMov."')";
	$insertaMovimiento=mysqli_query($con, $query);	

	$saldoJSON = array('nuevoSaldo' => $nuevoSaldo);
		
	// Desconectar bd
	mysqli_close($con);
	// Manda JSON con nuevo status de checkin
	echo json_encode($saldoJSON);
?>