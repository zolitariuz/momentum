<?php
	session_start();

	$id = $_SESSION['id'];

	// Conectar con bd
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 
	// Actualiza checkin hotel
	$query="UPDATE T_CheckIn SET F_Y2B = -1 WHERE F_Id = '".$id."'";
	$checkInHotel=mysqli_query($con, $query);
	// Registra movimiento
	$query="INSERT INTO T_Movimientos VALUES ('".$id."', 'CHECK-OUT','1',NOW(), 'CHECK-OUT Y2B')";
	$insertaMovimiento=mysqli_query($con, $query);

	$query="SELECT F_Y2B FROM T_CheckIn WHERE F_Id = '".$id."'";
	$checkInHotel=mysqli_query($con, $query );
	if($data = mysqli_fetch_array($checkInHotel))
		$hotel_arr = array('hotel' => $data[0]);

	// Desconectar bd
	mysqli_close($con);

	// Manda JSON con nuevo status de checkin
	echo json_encode($hotel_arr);
?>