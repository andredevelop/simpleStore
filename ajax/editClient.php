<?php 
	include('../config.php');

	$data = [];

	if(isset($_POST['id'])){

		$id = $_POST['id'];
		
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

		$binds = array($name,$doc,$phone,$email,$address,$lawyer,$date,$observation,$person_type,$user_name,$id,$user_name);
		$query = ' name = ?, doc = ?, phone = ?, email = ?, address = ?,lawyer = ?, date = ?, observation = ?, person_type = ?, user_name = ? WHERE id = ? AND user_name = ?';

		if(Crud::editAll($tabName,$query,$binds)){
			$data['success'] = true;
		}else{
			$data['error'] = true;
		}
	}

	die(json_encode($data));

?>