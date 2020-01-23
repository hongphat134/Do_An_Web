<?php

	class User extends Db
	{
		private $_page_size = 5;//Một trang hiển hị 5 cuốn sách
		private $_page_count;



		public function setPageSize($page_size){
			$this->_page_size = $page_size;
		}

		public function getPageCount()
		{
			return $this->_page_count;	
		}
		//Khôi phục mật khẩu
		public function getUserByEmail($email){
			$dsUser = $this->getAll();
			foreach ($dsUser as $value) {
				if(strcasecmp($value['user_email'],$email) == 0)
					return $value;				
			}
			return '';
		}
		public function encrypt($pwd){
			return md5("P".$pwd);
		}
		//Kiểm tra trùng email và tài khoản 
		public function isDuplicate($id,$email,$phone){
			$dsUser = $this->getAll();
			foreach ($dsUser as $value) {
				if(strcasecmp($value['user_email'], $email) == 0)
					return -1;
				if(strcasecmp($value['user_id'], $id) == 0)
					return -2;
				if(strcasecmp($value['user_phone'], $phone) == 0)
					return -3;
			}
			return 1;
		}

		public function getAll($currPage = -1)
		{
			if($currPage == -1){
				$sql = "SELECT * FROM `user`";
				return $this->exeQuery($sql);
			}
			$offset = ($currPage -1) * $this->_page_size;
			$sql="SELECT
				Count(*)
				FROM
				user";

			$n  = $this->count($sql);
			// echo $n.$this->_page_size;
			$this->_page_count = ceil($n/$this->_page_size);

			$sql="SELECT
				*
				FROM
				user
				LIMIT $offset, " . $this->_page_size;
			return $this->exeQuery($sql);	
		}
		//Đăng ký tài khoản
		public function insert($id,$pwd,$email,$phone){
			$kq = $this->isDuplicate($id,$email,$phone);
			if($kq > 0){
				$encode_pwd = $this->encrypt($pwd);
				$sql = "INSERT INTO `user`(`user_id`,`user_pwd`,`user_email`,`user_phone`) 
						VALUES ('$id','$encode_pwd','$email','$phone')";
				return $this->exeNoneQuery($sql);
			}
			return $kq;
		}
		//Nhập mật khẩu mới khi khôi phục mật khẩu
		public function edit_pwd($user_id = '',$user_pwd = ''){
			if($user_id != ''){
				try{
					$user_pwd = $this->encrypt($user_pwd);
					$sql = "UPDATE `user` 
							SET `user`.user_pwd = '$user_pwd' 
							WHERE `user`.user_id = '$user_id'";
					return $this->exeNoneQuery($sql);					
				}
				catch(Exception $e){
					return -1;
				}	
			}
			// Trả về -1 là false
			return -1;
		}
		//Cập nhật thông tin tài khoản
		public function edit($user_id = '',$user_name = '',$user_address = '',$user_email = '',$user_phone= ''){
			//Nếu Email và Phone ko có gì thay đổi thì set = 'null'

			//Nếu cả Email và Phone ko thay đổi gì thì ko cần kiểm
			if(strcasecmp($_SESSION['user']['user_phone'],$user_phone) == 0 && strcasecmp($_SESSION['user']['user_email'],$user_email) == 0) ;			
			else if(strcasecmp($_SESSION['user']['user_phone'],$user_phone) == 0){
				if($this->isDuplicate('',$user_email,'null') != 1) {
					return "Bị trùng email";					
				}				
			}
			else if(strcasecmp($_SESSION['user']['user_email'],$user_email) == 0){				
				if($this->isDuplicate('','null',$user_phone) != 1){
					return "Bị trùng sdt";					
				} 
			}
			else if($this->isDuplicate('',$user_email,$user_phone) != 1){
				return "Bị trùng email hoặc sdt";				 
			} 
	        
			$sql = "UPDATE `user` 
					SET `user_name` = '$user_name',`user_address` = '$user_address',`user_email` = '$user_email',	`user_phone` = '$user_phone'
					WHERE `user_id` = '$user_id'";
			return $this->exeNoneQuery($sql) == 1?1:'cập nhật không có thay đổi';						
		}
		//Tìm kiếm User => Trang admin
		public function search($currPage = 1,$key='',$name='',$email='',$phone=''){
			$arr_cons = array();

			if($key != '') $arr_cons["user_id"] = $key;
			if($name != '')$arr_cons["user_name"] = $name;
			if($email != '') $arr_cons["user_email"] = $email;
			if($phone != '') $arr_cons["user_phone"] = $phone;
			
			$sql = "SELECT *
					FROM `user`
					WHERE 1";

			foreach ($arr_cons as $key => $value) {
				$sql .= " AND $key LIKE '%$value%'";
			}
			$offset = ($currPage -1) * $this->_page_size;
			$sql_count = "SELECT Count(*) ".strstr($sql,'FROM');
			$n  = $this->count($sql_count);
			$this->_page_count = ceil($n/$this->_page_size);

			$sql .= " LIMIT $offset, ".$this->_page_size;
			//echo $sql;
			return $this->exeQuery($sql);
		}

		public function count($sql, $arr=array())
		{
			return $this->countItems($sql, $arr);
		}
	}
?>