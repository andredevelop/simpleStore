<?php 
	include('../config.php');
	
	$data = [];

	if(isset($_POST['id'])){
		$ids = $_POST['id'];

		if(Crud::deletePost('tb_hearding',' id = ?',$ids)){
			Crud::deletePost('tb_task',' id_hearding = ?',$ids);
			$data['success'] = true;
		}else{
			$data['error'] = true;
		}
	}

	die(json_encode($data));
?>