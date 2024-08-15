<?php 
	
	class User{
		
		public static function registerUser($name,$email,$password,$doc,$image,$permission){
			$name = strip_tags($name);
			
			if($name == '' || $email == '' || $password == '' || strlen($password) < 7){
				return false;
			}else{
				$password = password_hash($password, PASSWORD_DEFAULT);
				$insert = MySql::conectar()->prepare("INSERT INTO `tb_user` VALUES (null,?,?,?,?,?,?) ");
				
				$select = MySql::conectar()->prepare("SELECT * FROM `tb_user` WHERE email = ?");
				$select->execute(array($email));
				if($select->rowCount() == 1){
					return false;
				}else{
					$insert->execute(array($name,$email,$password,$doc,$image,$permission));
					return true;
				}
			}
		}

		public static function startLogin($email,$password){
			$email = strip_tags($email);

			if($email == '' || $password == ''){
				Warn::htmlWarn('error','Campos vazios não são permitidos!');
				return false;
			}else{
				$select = MySql::conectar()->prepare("SELECT * FROM `tb_user` WHERE email = ?");
				$select->execute(array($email));

				if($select->rowCount() === 1){
					$info = $select->fetch();
					if(password_verify($password, $info['password'])){
						$_SESSION['login'] = true;
						$_SESSION['name'] = $info['name'];
						$_SESSION['email'] = $email;
						// $_SESSION['password'] = $password;
						$_SESSION['image'] = $info['image'];
						$_SESSION['permission'] = $info['permission'];
	 					
	 					if(isset($_POST['recordPass'])){
							setcookie('recordPass',true,time()+(60*60*2400),'/');
							setcookie('email',$email,time()+(60*60*2400),'/');
							setcookie('password',$info['password'],time()+(60*60*2400),'/');
						}

						header('Location: '.INCLUDE_PATH.'home');
						die();
					}else{
						Warn::htmlWarn('error','E-mail e senha não correspondem!');
					}
				}else{
					Warn::htmlWarn('error','Usuário não encotrado');
				}
			}
		}

		public static function verifyCookie(){
			if(isset($_COOKIE['recordPass'])){
				$email = $_COOKIE['email'];
				$password = $_COOKIE['password'];
				
				$select = MySql::conectar()->prepare("SELECT * FROM `tb_user` WHERE email = ? AND password = ?");
				$select->execute(array($email,$password));

				if($select->rowCount() === 1){
					$info = $select->fetch();
					$_SESSION['login'] = true;
					$_SESSION['name'] = $info['name'];
					$_SESSION['email'] = $email;
					$_SESSION['password'] = $password;
					$_SESSION['image'] = $info['image'];
					$_SESSION['permission'] = $info['permission'];
					header('Location: '.INCLUDE_PATH.'home');
					die();
				}
			}
		}

		public static function logged(){
			return isset($_SESSION['login']) ? true : false;
		}

		public static function loggout(){
			setcookie('recordPass',true,time()-1,'/');
			session_destroy();
			header('Location:'.INCLUDE_PATH);
		}

		public static function verifyPermission($permission){
			if($_SESSION['permission'] == $permission){
				return;
			}else{
				echo 'style="display:none;"';
			}
		}

		public static function updateUser($name,$email,$password,$doc,$image,$permission,$user_name){
			$name = strip_tags($name);
			$sql = MySql::conectar()->prepare("UPDATE `tb_user` SET name = ?, email = ?, password = ?, doc = ?, image = ?, permission = ? WHERE email = ?");
			if($sql->execute(array($name,$email,$password,$doc,$image,$permission,$user_name))){
				return true;
			}else{
				return false;
			}
		}
		
	}


?>