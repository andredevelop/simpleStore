<?php
	include('../config.php');

	$data = [];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$permission = $_POST['permission'];
	
	if(User::registerUser($name,$email,$pass,'','',$permission)){
		$data['success'] = true;
	}else{
		$data['success'] = false;
	}

	die(json_encode($data));
?>