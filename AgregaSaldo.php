<?php
	session_start();

	$id = $_SESSION['id'];
	$saldoExtra = $_GET['saldo'];

	// Conectar con bd
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 

	// Agregar saldo
	$query="UPDATE T_Saldo SET F_Saldo = F_Saldo + '".$saldoExtra."' WHERE F_Id = '".$id."'";
	$agregaSaldo=mysqli_query($con, $query);

	// Registra movimiento
	$query="INSERT INTO T_Movimientos VALUES ('".$id."', 'ABONO SALDO', '".$saldoExtra."', NOW(), 'ABONO SALDO')";
	$insertaMovimiento=mysqli_query($con, $query);

	// Obtener y mandar nuevo saldo
	$query="SELECT F_Saldo FROM T_Saldo WHERE F_Id = '".$id."'";
	$nuevoSaldo=mysqli_query($con, $query );
	if($data = mysqli_fetch_array($nuevoSaldo))
		$saldo = array('saldo' => $data[0], 'agregado' => '1');
			
	// Desconectar bd
	mysqli_close($con);
	// Manda JSON con nuevo status de checkin
	echo json_encode($saldo);
?>