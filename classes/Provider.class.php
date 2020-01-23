<?php

	class Provider extends Db
	{
		private $_page_size = 5;//Một trang hiển hị 5 cuốn sách
		private $_page_count;

		public function setPageSize($page_size){
			$this->_page_size = $page_size;
		}
		public function getProductCount($mancc){
			$sql = "SELECT COUNT(*) 
					FROM product
					WHERE `product`.provider_id = $mancc";
			return $this->count($sql);
		}
		public function getAll($currPage = -1)
		{		
			//Mặc định là ko phân trang
			if($currPage == -1){
				$sql = 'select * from provider';				
				return $this->exeQuery($sql);
			}
			$offset = ($currPage -1) * $this->_page_size;
			$sql="SELECT
				Count(*)
				FROM
				provider";

			$n  = $this->count($sql);			
			$this->_page_count = ceil($n/$this->_page_size);

			$sql="SELECT
				*
				FROM
				provider
				limit $offset, " . $this->_page_size;		
			$ds = $this->exeQuery($sql);	
			for ($i=0; $i < count($ds); $i++) { 
				$ds[$i]['count_item'] =  $this->getProductCount($ds[$i]['provider_id']);
			}			
			return $ds;
		}

		//Thêm nhà cung cấp => Trang admin
		public function insert($tenncc,$emailncc,$sdtncc){
			$sql = "INSERT INTO `provider`(`provider_id`, `provider_name`,`provider_email`,`provider_phone`) VALUES (null,'$tenncc','$emailncc','$sdtncc')";
			return $this->exeNoneQuery($sql);
		}
		//Xoá nhà cung cấp => Trang admin
		public function delete($mancc){
			//Kiểm tra xem có sản phẩm nào thuộc nhà cung cấp hay ko?
			$sql = "SELECT Count(*) FROM `provider`
					JOIN `product` ON `provider`.provider_id = `product`.provider_id
					WHERE `provider`.provider_id = $mancc";
			$rs = $this->count($sql);
			if($rs > 0) return -$rs;
			$sql = "delete from `provider` where provider_id = $mancc";
			return $this->exeNoneQuery($sql);
		}
		//Cập nhật nhà cung cấp => Trang admin
		public function update($mancc,$tenncc,$email,$phone){			
			$sql = "UPDATE `provider`
					SET `provider_name` = '$tenncc', `provider_email` = '$email', `provider_phone` = '$phone'
					WHERE provider_id = $mancc";
			return $this->exeNoneQuery($sql);
		}
		//Tìm kiếm tiêu chí => Trang admin
		public function search($currPage = 1,$key='',$email='',$phone=''){
			$arr_cons = array();

			if($key != '') $arr_cons["provider_name"] = "LIKE '%$key%'";
			if($email != '') $arr_cons["provider_email"] = "LIKE '%$email%'";
			if($phone != '') $arr_cons["provider_phone"] = "LIKE '%$phone%'";
						
			$sql = "SELECT *
					FROM `provider`
					WHERE 1";
			//Kết hợp điều kiện
			foreach ($arr_cons as $key => $value) {
				$sql .= " AND $key $value";
			}
			//Trích chuỗi $sql để tìm kiếm tổng số lượng nhà cung cấp
			$sql_count = "SELECT Count(*) ".strstr($sql,'FROM');
			$offset = ($currPage -1) * $this->_page_size;
			$n  = $this->count($sql_count);			
			$this->_page_count = ceil($n/$this->_page_size);
			//echo $sql;
			$sql .= " LIMIT $offset, ".$this->_page_size;
			$ds = $this->exeQuery($sql);
			
			for ($i=0; $i < count($ds); $i++) { 
				$ds[$i]['count_item'] =  $this->getProductCount($ds[$i]['provider_id']);
			}			
			return $ds;
		}
		//Tìm kiếm theo mã nhà cung cấp => Trang admin
		public function searchByID($mancc){
			$arr = array(":provider_id" => $mancc);
			$sql = "SELECT *
					FROM `provider`
					WHERE `provider`.provider_id = :provider_id";
			$ds = $this->exeQuery($sql, $arr);
			for ($i=0; $i < count($ds); $i++) { 
				$ds[$i]['count_item'] =  $this->getProductCount($ds[$i]['provider_id']);
			}			
			return $ds;		
		}

		public function count($sql, $arr=array())
		{
			return $this->countItems($sql, $arr);
		}

		public function getPageCount()
		{
			return $this->_page_count;	
		}

		//Lấy tổng số lượng sản phẩm của 1 nhà cung cấp nào đó
		public function getProductCountByProvider($condition = ''){
			$sql = "SELECT `provider`.provider_id,`provider`.provider_name,count(*) quantity
					FROM provider JOIN product ON `provider`.provider_id = `product`.provider_id";
					
			if($condition != '') $sql .= "WHERE provider_id = $condition";

			$sql .= " GROUP BY provider.provider_id";
			
			return $this->exeQuery($sql);
		}

	}
?>