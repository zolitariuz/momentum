<?php
	session_start();

	$id = $_SESSION['id'];

	// Conectar con bd
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 
	// jala cenas restantes
	$query="SELECT F_cenas FROM T_Saldo WHERE F_Id = '".$id."'";
	$cenas=mysqli_query($con, $query );
	if($data = mysqli_fetch_array($cenas))
		$nocenas = $data[0];

	if($nocenas > 0){
		// Restar un cena
		$query="UPDATE T_Saldo SET F_cenas = F_cenas - 1 WHERE F_Id = '".$id."'";
		$restarcena=mysqli_query($con, $query);
		if($nocenas == 1){
			$cenaJSON = array('cena' => '0');
		} else {
			$cenaJSON = array('cena' => '1');
		}
		// Registra movimiento
		$query="INSERT INTO T_Movimientos VALUES ('".$id."', 'ALIMENTOS','1',NOW(), 'CENA')";
		$insertaMovimiento=mysqli_query($con, $query);	
	} else  {
		$cenaJSON = array('cena' => '-1');
	}
			
	// Desconectar bd
	mysqli_close($con);
	// Manda JSON con nuevo status de checkin
	echo json_encode($cenaJSON);
?>