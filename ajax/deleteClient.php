<?php 
	include('../config.php');
	
	$data = [];

	if(isset($_POST['id'])){
		$ids = $_POST['id'];

		if(Crud::deletePost('tb_customer',' id = ?',$ids)){
			$data['success'] = true;
		}else{
			$data['error'] = true;
		}
	}

	die(json_encode($data));
?>