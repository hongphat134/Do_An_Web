<?php

	class Product extends Db
	{
		private $_page_size = 9;//Một trang hiển thị số lượng cuốn sách
		private $_page_count;
		private $_count_item;

		//Thiết lập số sản phẩm hiện trên 1 trang => phân trang
		public function setPageSize($page_size = 9){
			$this->_page_size = $page_size;
		}

		//Lấy ngẫu nhiên sản phẩm (có dùng trong việc lấy danh sách top selling)
		public function getRand($n)
		{
			//$sql="select * from product order by rand() limit 0, $n";
			$sql = "SELECT product_id,product_name,product_price,product_img,cat_name
					FROM `category` JOIN `product` on `category`.cat_id = `product`.cat_id
					ORDER BY rand()
					LIMIT 0, $n";
			$this->_count_item = $n;
			return $this->exeQuery($sql);	
		}

		//Lấy tổng sản phẩm từ 1 đơn hàng nào đó
		public function getTotalFromOrderDetail($masp){
			$sql = "SELECT SUM(`order_detail`.`quantity`)  
					FROM `order` JOIN `order_detail` on `order`.`order_id` = `order_detail`.`order_id`
				    WHERE `order_detail`.`product_id` = $masp";
			return $this->count($sql);
		}

		//Lấy danh sách sản phẩm mới nhất với số lượng max
		public function getNewProduct($max){
			$sql = "SELECT `category`.cat_name,`product`.product_id,`product`.product_name,`product`.product_price,`product`.product_img
					FROM `category` JOIN `product` ON `category`.cat_id = `product`.cat_id
					ORDER BY `product`.product_date DESC
					LIMIT 0 , $max";
			
			return $this->exeQuery($sql);
		}

		//Lấy danh sách sản phẩm bán chạy nhất với số lượng max
		public function getTopSelling($max){
			// $sql = "SELECT *
			// 		FROM product
			// 		ORDER BY check_count(`product`.`product_id`) DESC 
			// 		LIMIT 0, $max";
			$sql = "SELECT `category`.cat_name,`product`.product_id,`product`.product_name,`product`.product_price,`product`.product_img
					FROM `category` JOIN `product` ON `category`.cat_id = `product`.cat_id
					ORDER BY `product`.product_date DESC
					LIMIT 0 , $max";

			$ds = $this->exeQuery($sql);
			for ($i=0; $i < count($ds); $i++) { 
				$ds[$i]['quantity'] = $this->getTotalFromOrderDetail($ds[$i]['product_id']);
			}
			return $ds;
		}

		//Lấy số lượng sản phẩm từ mã sản phẩm
		public function getQuantityProduct($masp){
			$sql = "SELECT product_quantity
					FROM product
					WHERE product_id = $masp";
			return $this->exeQuery($sql);	 
		}

		//Lấy danh sách tất cả sản phẩm. Nếu currPage > 0 thì áp dụng phân trang
		public function getAll($currPage = 1)
		{
			$offset = ($currPage -1) * $this->_page_size;
			$sql="SELECT
				Count(*)
				FROM
				product";

			$n  = $this->count($sql);
			$this->_page_count = ceil($n/$this->_page_size);

			$sql="SELECT
				*
				FROM
				product
				limit $offset, " . $this->_page_size;
			return $this->exeQuery($sql);	
		}

		//Trả về mảng mã các sản phẩm ko đủ hàng đáp ứng
		public function checkOrder($dssp){
			$arr = array();
			foreach ($dssp as $key => $value) {
				if($value['quantity'] > $this->getQuantityProduct($key))
					$arr[] = $key;
			}
			return $arr;
		}

		//Trừ hàng đã thanh toán
		public function ExportFromOrder($masp,$soluongsp){
			$sql = "UPDATE product
					SET product_quantity = product_quantity - $soluongsp
					WHERE product_id = $masp";
			return $this->exeNoneQuery($sql);
		}

		//Tìm kiếm sản phẩm theo mã sản phẩm
		public function searchById($masp){
			$sql = "SELECT * 
					FROM `category` JOIN `product` ON `category`.cat_id = `product`.cat_id
					WHERE `product`.product_id = $masp";
			return $this->exeQuery($sql);
		}

		//Tìm kiếm cơ bản => phục vụ cho tìm kiếm ở header client
		public function basic_seachByCategory($currPage = 1,$key='',$cat_id='all')
		{	
			$offset = ($currPage -1) * $this->_page_size;			
			$sql = "SELECT Count(*)
					FROM `category` join `product` on `category`.cat_id = `product`.cat_id
					WHERE 1";
			if($cat_id != 'all') $sql .= " and category.cat_id = $cat_id";
			if($key != '') $sql .= " and product.product_name like '%$key%'";
			//echo $sql;
			$this->_count_item = $this->count($sql);
			$this->_page_count = ceil($this->_count_item/$this->_page_size);

			$sql = "SELECT cat_name,product_id,product_price,product_img,product_name
					FROM `category` join `product` on `category`.cat_id = `product`.cat_id
					WHERE 1";
			if($cat_id != 'all') $sql .= " and category.cat_id = $cat_id";
			if($key != '') $sql .= " and product.product_name like '%$key%'";	
			$sql .= " limit $offset, " . $this->_page_size;	

			return $this->exeQuery($sql);
		}

		//Tìm kiếm nâng cao, phục vụ cho trang store.php (chọn nhà cung cấp,danh mục,giá,sắp xếp,show số lượng)
		public function search($arr_cats = '',$arr_pros= '',$price_min= '',$price_max= '',$order='',$currPage=1){
			$sql = "SELECT cat_name,product_id,product_img,product_name,product_price FROM `category`
					JOIN (`provider` JOIN `product` ON `provider`.provider_id = `product`.provider_id)
					ON `category`.cat_id = `product`.cat_id
					WHERE 1";			
			//Lọc theo danh sách danh mục đã chọn		
			if(is_array($arr_cats)){
				$sql .= " and (category.cat_id={$arr_cats[0]}";
				for ($i=1; $i < count($arr_cats); $i++) { 
					$sql .= " or category.cat_id={$arr_cats[$i]}";
				}
				$sql .= ")";
			}
			//Lọc theo danh sách nhà cung cấp đã chọn
			if(is_array($arr_pros)){
				$sql .= " and (provider.provider_id={$arr_pros[0]}";
				for ($i=1; $i < count($arr_pros); $i++) { 
					$sql .= " or provider.provider_id={$arr_pros[$i]}";
				}
				$sql .= ")";
			}
			//Lọc theo giá đã chọn
			if($price_min != ''&&$price_max != ''){
				$arrMin = explode('.',$price_min);
				$arrMax = explode('.',$price_max);
				$sql .= " and product.product_price between ".($arrMin[0]*1000)." and ".($arrMax[0]*1000);
			}
			//Lọc theo kiểu sắp xếp đã chọn
			if($order != ''){
				if($order == 'asc') $sql .= " order by product.product_price asc";
				else if($order == 'desc') $sql .= " order by product.product_price desc";
			} 			

			$offset = ($currPage -1) * $this->_page_size;
			$sql_count = "SELECT Count(*) ".strstr($sql,'FROM');
			$this->_count_item  = $this->count($sql_count);
			$this->_page_count = ceil($this->_count_item/$this->_page_size);
			//echo $sql_count.'<hr>'.$n.'-'.$this->_page_count;
			$sql .= " limit $offset, ".$this->_page_size;	

			return $this->exeQuery($sql);	
		}

		//Tìm kiếm => phục vụ cho tìm kiếm ở admin
		public function searchForAdmin($tensp='',$tugia='',$dengia='',$tungay='',$denngay='',$maloai='',$mancc='',$currPage = 1){
			$arr_cons = array();
			if($tensp != '') $arr_cons["`product`.product_name"] = "like '%".$tensp."%'";
			if($tugia != '' && $dengia != '') $arr_cons["`product`.product_price"] = "BETWEEN ".$tugia." AND ".$dengia;
			if($tungay != '' && $denngay != '') $arr_cons["`product`.product_date"] = "BETWEEN '".$tungay."' AND '".$denngay."'";
			if($maloai != '' && $maloai != 'all') $arr_cons["`category`.cat_id"] = "= ".$maloai;
			if($mancc != '' && $mancc != 'all') $arr_cons["`provider`.provider_id"] = "= ".$mancc;
			// var_dump($arr_cons);
			$sql = "SELECT `category`.cat_id,`provider`.provider_id,`product`.product_id,`product`.product_name,`product`.product_price,`product`.product_date,`product`.product_img,`product`.product_quantity FROM `category`
					JOIN (`provider` JOIN `product` ON `provider`.provider_id = `product`.provider_id)
					ON `category`.cat_id = `product`.cat_id
					WHERE 1";

			//Kết hợp điều kiện
			foreach ($arr_cons as $k => $v) {
				$sql .= " AND ($k $v)";
			}
			
			//Tách chuỗi $sql để đếm số lượng sản phẩm
			$sql_count = "SELECT Count(*) ".strstr($sql,'FROM');

			$offset = ($currPage -1) * $this->_page_size;

			$this->_count_item  = $this->count($sql_count);
			$this->_page_count = ceil($this->_count_item/$this->_page_size);

			$sql .= " LIMIT $offset, ".$this->_page_size;
			//echo $sql;
			return $this->exeQuery($sql);
		}


		//Thêm sản phẩm => cho trang admin
		public function insert($tensp,$giasp,$hinhsp,$ngaytaosp,$solgsp,$motasp,$chitietsp,$maloai,$mancc){
			$sql = "INSERT INTO `product`(`product_id`, `product_name`,`product_price`,`product_img`,`product_date`,`product_quantity`,`product_description`,`product_detail`,`cat_id`,`provider_id`)
					VALUES (null,'$tensp','$giasp','$hinhsp','$ngaytaosp','$solgsp','$motasp','$chitietsp','$maloai','$mancc')";
			return $this->exeNoneQuery($sql);
		}
		
		//Xoá sản phẩm => cho trang admin
		public function delete($masp){
			$sql = "DELETE FROM `product` WHERE product_id = $masp";
			return $this->exeNoneQuery($sql);
		}

		//Cập nhật sản phẩm => cho trang admin
		public function update($masp,$tensp,$giasp,$hinhsp='',$soluongsp,$motasp,$chitietsp,$maloai,$mancc){			
			$sql = "UPDATE `product`
					SET `product`.product_name = '$tensp', `product`.product_price = $giasp".($hinhsp!=''?", `product`.product_img = '$hinhsp'":"").",`product`.product_quantity = $soluongsp,
					".($motasp != ''?"`product`.product_description = '$motasp',":"").($chitietsp != ''?"`product`.product_detail = '$chitietsp',":"")."`product`.cat_id = $maloai, `product`.provider_id = $mancc
						WHERE `product`.product_id = $masp";
			return $this->exeNoneQuery($sql);
		}

		//Hàm này là hàm thống kê số lượng sản phẩm đã bán ra (bao gồm cả đã hoặc chưa thanh toán)
		public function getSoldProduct(){
			$sql = "SELECT `product`.product_id,`product`.product_img,`product`.product_name,`product`.product_price
					FROM product";

			$ds = $this->exeQuery($sql);
			for ($i=0; $i < count($ds) ; $i++) { 
				$ds[$i]['quantity'] = $this->getTotalFromOrderDetail($ds[$i]['product_id']);
			}
			return $ds;
		}

		//Hàm lấy số lượng sản phẩm (thường dùng cho select count(*) )
		public function count($sql, $arr=array())
		{
			return $this->countItems($sql, $arr);
		}

		//Hàm lấy số lượng trang của câu truy vấn
		public function getPageCount()
		{
			return $this->_page_count;	
		}
		//Hàm lấy số lượng sản phẩm hiện hành
		public function getCountItem(){
			return $this->_count_item;
		}
	}
?>