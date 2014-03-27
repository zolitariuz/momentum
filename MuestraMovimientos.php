<?php
	session_start();

	$id = $_SESSION['id'];

	// Conectar con bd
	$con=mysqli_connect("localhost","momentu1_cuervo","cuervoestudio","momentu1_RegistroCB");
	if (mysqli_connect_errno()){
	  echo "Error, no se pudo conectar la base de datos: " . mysqli_connect_error();
	} 
	
	// selecciona todos los registros
	$query="SELECT * FROM T_Movimientos WHERE F_Id = '".$id."'";
	$registros=mysqli_query($con, $query );
	$noMov = 1;
	while($data = mysqli_fetch_array($registros))
	{
		echo "<ul class='clearfix'>";
		echo "<li class='columna c-2'><h3>$noMov</h3></li>";
		echo "<li class='columna c-2'><h3>$data[1]</h3></li>";
		echo "<li class='columna c-2'><h3>$data[2]</h3></li>";
		echo "<li class='columna c-2'><h3>$data[3]</h3></li>";
		echo "<li class='span c-1'>&nbsp;</li>";
		echo "<li class='columna c-3'><h3>$data[4]</h3></li>";
		echo "</ul>";
		$noMov++;
	}

	// Desconectar bd
	mysqli_close($con);
?>