<?php 
	include('../config.php');
	
	$data = [];

	$hearding = $_POST['hearding'];
	$type = $_POST['type'];
	$location = $_POST['location'];
	$date = $_POST['date'];
	$hour = $_POST['hour'];
	$tipstaff = $_POST['tipstaff'];
	$lawyer = $_POST['lawyer'];
	$customer = $_POST['customer'];
	$prosecuted = $_POST['prosecuted'];
	$process_number = $_POST['process_number'];
	$observation = $_POST['observation'];
	$user_name = $_POST['user_name'];
	$tabName = 'tb_hearding';
	$tabNameTask = 'tb_task';


	$values = array($hearding,$type,$location,$date,$hour,$tipstaff,$lawyer,$customer,$prosecuted,$process_number,$observation,$user_name);

	if(Crud::insertAll($tabName,$values)){
		
		$lastId = MySql::conectar()->lastInsertId();
		$taskVal = array('Audiência: '.$hearding.', obs: '.$observation.', Local: '.$location.', Cliente: '.$customer.' x Parte contrária: '.$prosecuted,$date,$hour,$lawyer,'pendente',$lastId,$user_name);

		Crud::insertAll($tabNameTask,$taskVal);

		$data['success'] = true;
	}else{
		$data['error'] = true;
	}

	die(json_encode($data));

?>