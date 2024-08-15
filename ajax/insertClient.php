<?php 
	include('../config.php');
	
	$data = [];

	$name = $_POST['name'];
	$doc = $_POST['doc'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['adress'];
	$lawyer = $_POST['lawyer'];
	$date = $_POST['date'];
	$observation = $_POST['observation'];
	$person_type = $_POST['person_type'];
	$user_name = $_POST['user_name'];
	$tabName = 'tb_customer';

	$values = array($name,$doc,$phone,$email,$address,$lawyer,$date,$observation,$person_type,$user_name);
	
	if(Crud::insertAll($tabName,$values)){
		$data['success'] = true;
	}else{
		$data['error'] = true;
	}

	die(json_encode($data));

?>