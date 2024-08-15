<?php 
	
	class Crud{
		
		public static function countRow($col,$table,$query = null,$binds = null){
			if($query == null && $binds == null){
				$select = MySql::conectar()->prepare("SELECT $col FROM `$table`");
				$select->execute();
			}else{
				$select = MySql::conectar()->prepare("SELECT $col FROM `$table` $query");
				if(is_array($binds)){
					$select->execute($binds);
				}else{
					$select->execute(array($binds));
				}
			}
			echo $select->rowCount();
		}

		public static function simpleSelectAll($col,$table,$query = null,$binds = null){
			if($query == null && $binds == null){
				$select = MySql::conectar()->prepare("SELECT $col FROM `$table`");
				$select->execute();
			}else{
				$select = MySql::conectar()->prepare("SELECT $col FROM `$table` $query ");
				if(is_array($binds)){
					$select->execute($binds);
				}else{
					$select->execute(array($binds));
				}
			}
			
			return $elements = $select->fetchAll();
		}

		public static function insertAll($tabName,$arg){
			$okay = true;

			$query = "INSERT INTO `$tabName` VALUES (null ";

			foreach($arg as $key => $value){
				if($value == ''){
					$okay = false;
				}
				
				$query.=",?";
				$params[] = $value;
			}
			$query.=")";
			if($okay){
				$insert = MySql::conectar()->prepare($query);
				$insert->execute($params);
			}
			return $okay;
		}

		public static function editAll($tabName,$query,$binds){
			$edit = MySql::conectar()->prepare("UPDATE `$tabName` SET $query");
			if(is_array($binds)){
				$edit->execute($binds);
			}else{
				$edit->execute(array($binds));
			}
			return true;
		}

		public static function deletePost($tabName,$query,$binds){
			foreach ($binds as $values) {
				$delete = MySql::conectar()->prepare("DELETE FROM `$tabName` WHERE $query");
				if(is_array($values)){
					$delete->execute($values);
				}else{
					$delete->execute(array($values));
				}
			}
			return true;
		}

		public static function uploadFile($file){
			$fileFormat = explode('.',$file['name']);
			$fileName = uniqid().'.'.$fileFormat[count($fileFormat) - 1];
			if(move_uploaded_file($file['tmp_name'], ROOT_PATH.'/uploads/'.$fileName)){
				return $fileName;
			}else{
				return false;
			}
		}

		public static function editUserNameCol($tabName,$binds){
			foreach ($tabName as $value) {
				$edit = MySql::conectar()->prepare("UPDATE `$value` SET user_name = ? WHERE user_name = ?");
				$edit->execute(array($binds,USER_NAME));
			}
		}

	}
?>