<?php
	session_start();

	$id = $_SESSION['id'];

	// Conectar con bd
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 
	// jala desayunos restantes
	$query="SELECT F_Desayunos FROM T_Saldo WHERE F_Id = '".$id."'";
	$desayunos=mysqli_query($con, $query );
	if($data = mysqli_fetch_array($desayunos))
		$noDesayunos = $data[0];

	if($noDesayunos > 0){
		// Restar un desayuno
		$query="UPDATE T_Saldo SET F_Desayunos = F_Desayunos - 1 WHERE F_Id = '".$id."'";
		$restarDesayuno=mysqli_query($con, $query);
		if($noDesayunos == 1){
			$desayunoJSON = array('desayuno' => '0');
		} else {
			$desayunoJSON = array('desayuno' => '1');
		}
		// Registra movimiento
		$query="INSERT INTO T_Movimientos VALUES ('".$id."', 'ALIMENTOS','1',NOW(), 'DESAYUNO')";
		$insertaMovimiento=mysqli_query($con, $query);		
	} else  {
		$desayunoJSON = array('desayuno' => '-1');
	}
			
	// Desconectar bd
	mysqli_close($con);
	// Manda JSON con nuevo status de checkin
	echo json_encode($desayunoJSON);
?>