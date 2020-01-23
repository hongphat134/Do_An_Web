<?php

	class Category extends Db
	{
		private $_page_size = 5;//Một trang hiển hị 5 cuốn sách
		private $_page_count;

		public function setPageSize($page_size){
			$this->_page_size = $page_size;
		}

		//Tổng sản phẩm từng danh mục
		public function getProductCountByCat($condition = ''){
			$sql = "SELECT `category`.cat_id,`category`.cat_name,count(*) quantity
					FROM `category` JOIN `product` ON `category`.cat_id = `product`.cat_id";
					
			if($condition != '') $sql .= "WHERE cat_id = $condition";

			$sql .= " GROUP BY category.cat_id";

			return $this->exeQuery($sql);
		}

		public function getNameById($maloai){
			$sql = "SELECT `category`.cat_name FROM `category` WHERE `category`.cat_id = $maloai";
			return $this->exeQuery($sql);
		}
		public function getProductCount($maloai){
			$sql = "SELECT COUNT(*) 
					FROM product
					WHERE `product`.cat_id = $maloai";
			return $this->count($sql);
		}

		public function getAll($currPage = -1)
		{
			if($currPage == -1){			
				$sql = "SELECT * FROM `category`";
				return $this->exeQuery($sql);
			}
			$offset = ($currPage -1) * $this->_page_size;
			$sql="SELECT
				Count(*)
				FROM
				category";

			$n  = $this->count($sql);
			$this->_page_count = ceil($n/$this->_page_size);

			$sql="SELECT
				*
				FROM
				category
				LIMIT $offset, " . $this->_page_size;		
			$ds = $this->exeQuery($sql);	
			for ($i=0; $i < count($ds); $i++) { 
				$ds[$i]['count_item'] =  $this->getProductCount($ds[$i]['cat_id']);
			}			
			return $ds;
		}

		public function insert($tenloai){
			$sql = "INSERT INTO `category`(`cat_id`, `cat_name`) VALUES (null,'$tenloai')";
			return $this->exeNoneQuery($sql);
		}

		public function delete($maloai){
			//Kiểm tra xem có sản phẩm nào thuộc loại sản phẩm này không?
			$sql = "SELECT Count(*) FROM `category`
					JOIN `product` ON `category`.cat_id = `product`.cat_id
					WHERE `category`.cat_id = $maloai";
			$rs = $this->count($sql);
			if($rs > 0) return -$rs;
			$sql = "delete from `category` where cat_id = $maloai";
			return $this->exeNoneQuery($sql);
		}

		public function update($maloai,$tenloai){
			$sql = "UPDATE `category` 
					SET `category`.cat_name = '$tenloai' 
					WHERE `category`.cat_id = $maloai";
			return $this->exeNoneQuery($sql);
		}
		//Tìm kiếm theo tên danh mục => Trang admin
		public function search($currPage = 1,$key=''){	
			$arr = array(":cat_name"=>"%". $key ."%");
			
			$offset = ($currPage -1) * $this->_page_size;
			$sql= " SELECT
					Count(*)
					FROM `category`
					WHERE cat_name like :cat_name";
					$n  = $this->count($sql, $arr);
					$this->_page_count = ceil($n/$this->_page_size);
			$sql= " SELECT `category`.cat_id,`category`.cat_name
					FROM `category`
					WHERE cat_name like :cat_name	
					LIMIT $offset, " . $this->_page_size;	

			$ds = $this->exeQuery($sql,$arr);	
			for ($i=0; $i < count($ds); $i++) { 
				$ds[$i]['count_item'] =  $this->getProductCount($ds[$i]['cat_id']);
			}			
			return $ds;
		}

		//Tìm kiếm theo mã danh mục => Trang admin
		public function searchByID($maloai){
			$arr = array(":cat_id"=>$maloai);
			$sql = "SELECT `category`.cat_id,`category`.cat_name 
					FROM `category`
					WHERE `category`.cat_id = :cat_id";
			$ds = $this->exeQuery($sql,$arr);	
			for ($i=0; $i < count($ds); $i++) { 
				$ds[$i]['count_item'] =  $this->getProductCount($ds[$i]['cat_id']);
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
	}
?>