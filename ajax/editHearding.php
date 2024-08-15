<?php 
	include('../config.php');

	$data = [];

	if(isset($_POST['id'])){

		$id = $_POST['id'];
		
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

		$binds = array($hearding,$type,$location,$date,$hour,$tipstaff,$lawyer,$customer,$prosecuted,$process_number,$observation,$user_name,$id,$user_name);
		$query = ' hearding = ?, type = ?, location = ?, date = ?, hour = ?, tipstaff = ?, lawyer = ?, customer = ?, prosecuted = ?, process_number = ?, observation = ?, user_name = ? WHERE id = ? AND user_name = ?';
	
		// tasks table
		$bindTask = array('Audiência: '.$hearding.', obs: '.$observation.', Local: '.$location.', Cliente: '.$customer.' x Parte contrária: '.$prosecuted,$date,$hour,$lawyer,$user_name,$id,$user_name);
		$queryTask = ' task = ?, date = ?, hour = ?, lawyer = ?, user_name = ? WHERE id_hearding = ? AND user_name = ?';

		if(Crud::editAll($tabName,$query,$binds)){
			Crud::editAll($tabNameTask,$queryTask,$bindTask);
			$data['success'] = true;
		}else{
			$data['error'] = true;
		}
	}

	die(json_encode($data));

?>