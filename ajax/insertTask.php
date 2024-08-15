<?php 
	include('../config.php');
	
	$data = [];

	$task = $_POST['task'];
	$date = $_POST['date'];
	$hour = date('H:i');
	$lawyer = $_SESSION['name'];
	$status = 'pendente';
	$user_name = $_SESSION['email'];
	$tabName = 'tb_task';
	$id_hearding = 0;

	$values = array($task,$date,$hour,$lawyer,$status,$id_hearding,$user_name);
	
	if(Crud::insertAll($tabName,$values)){
		$data['success'] = true;
	}else{
		$data['error'] = true;
	}

	die(json_encode($data));

?>