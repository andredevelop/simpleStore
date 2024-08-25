<?php
	session_start();
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Fortaleza');
	//para gerar pdf
	//require('vendor/autoload.php');
	
	define('ROOT_PATH', __DIR__);

	$autoload = function($class){
	    $classPath = str_replace('\\','/', $class);
	    if(file_exists(ROOT_PATH.'/classes/'.$classPath.'.php')){
	        include(ROOT_PATH.'/classes/'.$classPath.'.php');
	    }elseif($class == 'Email'){
	        require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
	    }else{
	        echo 'The '.$class.' does not exist';
	    }
	};

	spl_autoload_register($autoload);

	
	define('INCLUDE_PATH', 'http://localhost/0%20-%20Desenvolvendo/simpleStore/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'central/');
	define('BASE_DIR_PAINEL',__DIR__);
	define('NOME_EMPRESA','DuartCode');
	if(isset($_SESSION['email'])){
		define('USER_NAME',$_SESSION['email']);
	}
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','loja_marlene');
	
?>