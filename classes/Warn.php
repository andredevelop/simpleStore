<?php 

	class Warn{
		
		public static function htmlWarn($type,$msg){
			if($type == 'success'){
				echo '<div class="container"><div class="html-success-box" >'.$msg.'</div></div>';
			}elseif($type == 'error'){
				echo '<div class="container"><div class="html-error-box" >'.$msg.'</div></div>';
			}
		}

	}

?>