<?php 
	include('../config.php');

	$data = [];

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$doc = $_POST['doc'];
	$logo = $_FILES['logo'];
	$current_logo = $_POST['current_logo'];
	$permission = $_SESSION['permission'];
	$user_name = $_POST['user_name'];

	$table_names = array('tb_customer','tb_hearding','tb_opposite','tb_process','tb_task');

	if($logo['name'] != ''){
		if(Check::validImage($logo)){
			$logo = Crud::uploadFile($logo);

			if(file_exists('../uploads/'.$current_logo)){
				unlink('../uploads/'.$current_logo);
			};

			if(User::updateUser($name,$email,$password,$doc,$logo,$permission,$user_name)){
				Crud::editUserNameCol($table_names,$email);
				$_SESSION['image'] = $logo;
				$_SESSION['name'] = $name;
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $password;

				$data['success'] = true;
			}else{
				$data['error'] = true;
			}
		}else{
			$data['error'] = true;
		}
	}else{
		$logo = $current_logo;

		if(User::updateUser($name,$email,$password,$doc,$logo,$permission,$user_name)){
			Crud::editUserNameCol($table_names,$email);
			$_SESSION['image'] = $logo;
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;

			$data['success'] = true;
		}else{
			$data['error'] = true;
		}
	}

	die(json_encode($data));
?>