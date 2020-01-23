<?php

	class Admin extends Db
	{
		public function getAll()
		{
			$sql="select ad_user,ad_pwd,ad_name from admin";
			return $this->exeQuery($sql);	
		}

		public function encode($pwd){
			return md5(sha1('k'.$pwd));
		}
	}
?>