<?php 
	include('../config.php');
	
	$data = [];

	$number = $_POST['number'];
	$tipstaff = $_POST['tipstaff'];
	$type_action = $_POST['type_action'];
	$lawyer = $_POST['lawyer'];
	$customer = $_POST['customer'];
	$prosecuted = $_POST['prosecuted'];
	$audience_date = $_POST['audience_date'];
	$audience_hour = $_POST['audience_hour'];
	$term = $_POST['term'];
	$petition_date = $_POST['petition_date'];
	$opening_date = $_POST['opening_date'];
	$status = $_POST['status'];
	$person_type = $_POST['person_type'];
	$user_name = $_POST['user_name'];
	$tabName = 'tb_process';

	$values = array($number,$tipstaff,$type_action,$lawyer,$customer,$prosecuted,$audience_date,$audience_hour,$term,$petition_date,$opening_date,$status,$person_type,$user_name);
	
	if(Crud::insertAll($tabName,$values)){
		$data['success'] = true;
	}else{
		$data['error'] = true;
	}

	die(json_encode($data));

?>