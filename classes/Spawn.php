<?php 
	
	class Spawn{

		function __construct(){
			$this->url = explode('/', $_GET['url'])[0];
		}

		public static function returnUrl(){
			$urlInstance = new self();
			$pageName = $urlInstance->url;
			return $pageName;
		}

		public static function spawnPage(){
			$pageName = self::returnUrl();

			if(Check::fileExistsUrl('pages',$pageName,'php')){
				include('pages/'.$pageName.'.php');
			}elseif($pageName == 'home'){
				include('pages/main.php');
			}else{
				Warn::htmlWarn('error','Página não existente!');
			}
		}

		public static function selectMenuSide($pageUrl){
			$pageName = self::returnUrl();
		
			if($pageUrl == $pageName){
				echo 'selected-profile-menu';
			}
		}

		public static function selectMenuHead($headUrl){
			$pageName = self::returnUrl();
		
			if($headUrl == $pageName){
				echo 'selected-home-menu';
			}
		}

		public static function spawnLinkFile($pageUrl,$path,$file){
			$pageName = self::returnUrl();

			if($pageName == $pageUrl){
				if(substr($file, -3) === '.js'){
					echo '<script src="'.INCLUDE_PATH.$path.'/'.$file.'"></script>';
				}elseif(substr($file,-4) === '.css'){
					echo '<link rel="stylesheet" href="'.INCLUDE_PATH.$path.'/'.$file.'" />';
				}
			}elseif($pageUrl == 'all'){
				if(substr($file, -3) === '.js'){
					echo '<script src="'.INCLUDE_PATH.$path.'/'.$file.'"></script>';
				}elseif(substr($file,-4) === '.css'){
					echo '<link rel="stylesheet" href="'.INCLUDE_PATH.$path.'/'.$file.'" />';
				}
			}
			
		}

		public static function spawnBarUrl($urlName){
			$pageName = self::returnUrl();

			if($pageName == ''){
				header('Location: '.INCLUDE_PATH.$urlName);
			}
		}

		public static function spawnScriptsJs(){
			self::spawnLinkFile('all','js/jsLibs','jquery.js');
			self::spawnLinkFile('all','js/jsLibs','jquery.mask.js');
			self::spawnLinkFile('all','js/jsLibs','fontAwesome.js');
			self::spawnLinkFile('all','js/jsGlobal','funcMask.js');
			self::spawnLinkFile('all','js/jsGlobal','funcAside.js');
			self::spawnLinkFile('all','js/jsGlobal','arrowToUp.js');
			self::spawnLinkFile('all','js/jsGlobal','const.js');
			self::spawnLinkFile('all','js/jsGlobal','funcFormValidate.js');
			self::spawnLinkFile('all','js/jsGlobal','funcOpenForms.js');
			self::spawnLinkFile('clientes','js/jsAjax','deleteClient.js');
			self::spawnLinkFile('clientes','js/jsAjax','searchClient.js');
			self::spawnLinkFile('clientes','js/jsAjax','insertClient.js');
			self::spawnLinkFile('clientes','js/jsAjax','editClient.js');
			self::spawnLinkFile('user-profile','js/jsAjax','editUser.js');
		}

		public static function spawnLinkCss(){
			self::spawnLinkFile('all','css/cssLibs','all.css');
			self::spawnLinkFile('all','css/cssLibs','fontAll.css');
			self::spawnLinkFile('all','css/cssGlobal','globalStyle.css');
			self::spawnLinkFile('all','css/cssGlobal','homeStyle.css');
			self::spawnLinkFile('all','css/cssGlobal','formStyle.css');
			self::spawnLinkFile('all','css/cssGlobal','tabStyle.css');
			self::spawnLinkFile('home','css/cssPages','mainStyle.css');
			self::spawnLinkFile('clientes','css/cssPages','clienteStyle.css');
			self::spawnLinkFile('user-profile','css/cssPages','profileStyle.css');
		}

	}


?>