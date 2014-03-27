<?php
	session_start();

	$id = $_SESSION['id'];

	// Conectar con bd
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 
	// jala comidas restantes
	$query="SELECT F_comidas FROM T_Saldo WHERE F_Id = '".$id."'";
	$comidas=mysqli_query($con, $query );
	if($data = mysqli_fetch_array($comidas))
		$nocomidas = $data[0];

	if($nocomidas > 0){
		// Restar un comida
		$query="UPDATE T_Saldo SET F_Comidas = F_Comidas - 1 WHERE F_Id = '".$id."'";
		$restarcomida=mysqli_query($con, $query);
		if($nocomidas == 1){
			$comidaJSON = array('comida' => '0');
		} else {
			$comidaJSON = array('comida' => '1');
		}
		// Registra movimiento
		$query="INSERT INTO T_Movimientos VALUES ('".$id."', 'ALIMENTOS','1',NOW(), 'COMIDA')";
		$insertaMovimiento=mysqli_query($con, $query);	
	} else  {
		$comidaJSON = array('comida' => '-1');
	}
			
	// Desconectar bd
	mysqli_close($con);
	// Manda JSON con nuevo status de checkin
	echo json_encode($comidaJSON);
?>