<?php

	class Order extends Db
	{
		private $_page_size = 5;//Một trang hiển hị 5 cuốn sách
		private $_page_count;

		public function setPageSize($page_size){
			$this->_page_size = $page_size;
		}

		public function getAll($ma_user = '',$currPage = -1)
		{
			$search_user = '';
			if($ma_user != '') $search_user = " where `order`.user_id like '$ma_user' ";
			if($currPage < 1) {
				$sql = "select * from `order`".$search_user;
				return $this->exeQuery($sql);
			}
			$offset = ($currPage -1) * $this->_page_size;
			$sql="SELECT count(*) FROM `order`".$search_user;
            
			$n  = $this->count($sql);
 
			$this->_page_count = ceil($n/$this->_page_size);
            $sql="SELECT * FROM `order`".$search_user."
                limit $offset, " . $this->_page_size;
              
			return $this->exeQuery($sql);	
		}

		public function getAllByUser($ma_user){
			$sql  = "SELECT `order`.order_id,`order`.`order_date`,`order`.`consignee_name`,`order`.`consignee_phone`,`order`.`consignee_address`,`order`.`order_status`,`order`.`user_id` FROM `user`
					JOIN `order` ON `user`.user_id = `order`.user_id
					WHERE `order`.user_id = '$ma_user'";
			return $this->exeQuery($sql);
		}

		public function isCheckProductID($masp){
			$sql = "SELECT Count(*)
					FROM `product`
					WHERE `product`.product_id = $masp";
			return $this->count($sql)>0;
		}

		public function isExistOrderDetail($madh,$masp){
			$sql = "SELECT Count(*)
					FROM `order_detail`
					WHERE order_id = $madh AND product_id = $masp";
			return $this->count($sql)>0;
		}

		public function viewOrderDetail($madh){
			$sql = "SELECT `product`.product_id,`product`.product_img,`product`.product_name,`product`.product_price,`order_detail`.quantity FROM `order`
					JOIN (`product` JOIN `order_detail` ON `product`.product_id = `order_detail`.product_id)
					ON `order`.order_id = `order_detail`.order_id
					WHERE `order`.order_id = $madh";
			return $this->exeQuery($sql);
		}
		//Thêm chi tiết hoá đơn => Trang admin
		public function insertOrderDetail($madh,$masp,$soluong){
			if($this->isCheckProductID($masp)){
				if(!$this->isExistOrderDetail($madh,$masp)){
					$sql = "INSERT INTO `order_detail` (`order_id`,`product_id`,`quantity`)
							VALUES ('$madh','$masp','$soluong');";
					return $this->exeNoneQuery($sql);
				}
				else{
					$sql = "UPDATE `order_detail`
							SET quantity =  quantity + $soluong
							WHERE order_id = $madh AND product_id = $masp";
					return $this->exeNoneQuery($sql);
				}
			}
			return 0;
		}

		//Xoá chi tiết hoá đơn theo mã đơn hàng và mã sản phẩm
		public function removeOrderDetail($madh,$masp){
			$sql = "DELETE FROM `order_detail`					
					WHERE order_id = $madh AND product_id = $masp";
			return $this->exeNoneQuery($sql);
		}
		//Xoá chi tiết hoá đơn theo mã đơn hàng => Trang admin
		public function deleteDetail($madh){
			$sql = "DELETE FROM `order_detail`
					WHERE `order_detail`.order_id = $madh";
			return $this->exeNoneQuery($sql);
		}
		//Cật nhật chi tiết hoá đơn => Trang admin
		public function updateOrderDetail($madh,$masp,$soluong){

			$sql = "UPDATE `order_detail`
					SET quantity = $soluong
					WHERE order_id = $madh AND product_id = $masp";
			return $this->exeNoneQuery($sql);
		}
        //BUG
		public function insert($mauser,$ngaynhap,$tennn,$sdtnn,$diachinhan,$trangthai){
			$sql = "INSERT INTO `order` (`order_id`, `order_date`, `consignee_name`, `consignee_phone`, `consignee_address`, `order_status`, `user_id`) 
					VALUES (NULL, '$ngaynhap', '$tennn', '$sdtnn', '$diachinhan', '$trangthai', '$mauser');";
			return $this->exeNoneQuery($sql);
		}
		//Khi huỷ đơn hàng thì số lượng sản phẩm phải quay về kho
		public function importFromOrder($masp,$soluongsp){
			$sql = "UPDATE product
					SET product_quantity = product_quantity + $soluongsp
					WHERE product_id = $masp";
			return $this->exeNoneQuery($sql);
		}
		//Xoá đơn hàng => Trang admin
		public function delete($madh){				
			//Thao tác nhập hàng vô kho khi huỷ đơn hàng
			$sql = "SELECT `order_detail`.product_id,`order_detail`.quantity
					FROM `order_detail`
					WHERE `order_detail`.order_id = $madh";
			$ds = $this->exeQuery($sql);
			foreach ($ds as $v) {
				$kq = $this->importFromOrder($v['product_id'],$v['quantity']);
				if($kq == 0) return 0;
			}
			$kq = $this->deleteDetail($madh);
			if($kq == 0) return 0;
			
			$sql = "delete from `order` where order_id = $madh";
			return $this->exeNoneQuery($sql);
		}
		//Cập nhật đơn hàng => Trang admin
		public function update($madh,$tennn,$sdtnn,$diachinhan,$trangthai){
			$sql = "UPDATE `order` 
					SET `order`.consignee_name = '$tennn',`order`.consignee_phone = '$sdtnn',`order`.consignee_address = '$diachinhan',`order`.order_status = '$trangthai'
					WHERE `order`.order_id = $madh";
			return $this->exeNoneQuery($sql);
		}
		//Tìm kiếm theo tiêu chí => Trang Admin
		public function search($from_date='',$to_date='',$trangthai = '',$tennn='',$sdtnn='',$currPage = 1){
			$arr_cons = array();
			if($from_date != '' && $to_date != '') $arr_cons["order_date"] = "BETWEEN '$from_date' AND '$to_date'";
			if($trangthai != '' && $trangthai != 'all') $arr_cons["order_status"] = "= $trangthai";			
			if($tennn != '') $arr_cons["consignee_name"] = "LIKE '%$tennn%'";
			if($sdtnn != '') $arr_cons["consignee_phone"] = "LIKE '%$sdtnn%'";
			$sql = "SELECT *
					FROM `order`
					WHERE 1";
			//Kết hợp điều kiện
			foreach ($arr_cons as $key => $value) {
				$sql .= " AND ($key $value)";						
			}					
			//Tách chuỗi $sql để đếm số lượng đơn hàng
			$sql_count = "SELECT Count(*) ".strstr($sql,'FROM');

			$offset = ($currPage -1) * $this->_page_size;
			$n  = $this->count($sql_count);
			$this->_page_count = ceil($n/$this->_page_size);
			$sql .= " LIMIT $offset, ".$this->_page_size;
			//echo $sql;
			return $this->exeQuery($sql);
		}
		public function searchByID($madh){
			$sql = "SELECT *
					FROM `order`
					WHERE `order`.order_id = $madh";
			return $this->exeQuery($sql);
		}
		//Tìm đơn hàng theo khoảng thời gian
		public function searchDateToDate($from_date='',$to_date='',$ma_user = '',$currPage = 1){
			$search_user = '';
			if($ma_user != '') $search_user = "and `order`.user_id = '$ma_user'";
			$sql = "SELECT Count(*) FROM `order`
				WHERE `order`.`order_date` BETWEEN '$from_date' AND '$to_date' ".$search_user;
			
			$offset = ($currPage -1) * $this->_page_size;
			$n  = $this->count($sql);
			$this->_page_count = ceil($n/$this->_page_size);
			$sql = "SELECT * FROM `order`
					WHERE `order`.`order_date` BETWEEN '$from_date' AND '$to_date' ".$search_user."
					limit $offset, ".$this->_page_size;
			return $this->exeQuery($sql);
		}
		//Thống kê doanh thu
		public function revenue(){
			$sql = "SELECT `order`.order_id,`order`.order_date,`order`.order_status,SUM(`product`.product_price*`order_detail`.quantity) as total FROM `order` 
			 		JOIN (`product` JOIN `order_detail` ON `product`.product_id = `order_detail`.product_id)
			 		ON `order`.order_id = `order_detail`.order_id 				 				
					GROUP BY `order`.order_id,`order`.order_status";
			return $this->exeQuery($sql);
		}
		//Thống kê doanh thu theo khoảng thời gian
		public function revenueByDate($tungay,$denngay){
			$sql = "SELECT `order`.order_id,`order`.order_date,`order`.order_status,SUM(`product`.product_price*`order_detail`.quantity) as total FROM `order` 
			 		JOIN (`product` JOIN `order_detail` ON `product`.product_id = `order_detail`.product_id)
			 		ON `order`.order_id = `order_detail`.order_id 
					WHERE `order`.`order_date` BETWEEN '$tungay' AND '$denngay'
					GROUP BY `order`.order_id,`order`.order_status";
			return $this->exeQuery($sql);
		}

		public function count($sql, $arr=array())
		{
			return $this->countItems($sql, $arr);
		}

		public function getPageCount()
		{
			return $this->_page_count;	
		}
	}
?>