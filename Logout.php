<?php
	session_start();
	session_destroy();
	$logout = array('logout' => 1);
	echo json_encode($logout);
?>