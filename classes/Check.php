<?php 
	
	class Check{

		public static function fileExistsUrl($path,$name,$type){
			if($path == ''){
				if(file_exists($name.'.'.$type)){
					return true;
				}else{
					return false;
				}
			}else{
				if(file_exists($path.'/'.$name.'.'.$type)){
					return true;
				}else{
					return false;
				}
			}
		}

		public static function validImage($image){
			if($image['type'] == 'image/jpeg' ||
		       $image['type'] == 'image/jpg' ||
		       $image['type'] == 'image/png'){

				$size = intval($image['size']/1024);
				if($size < 1900){
					return true;
				}else{
					return false;
				}
				
				return true;
			}else{
				return false;
			}
		}

	}

?>