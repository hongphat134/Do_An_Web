<?php

	class Comment extends Db
	{
		private $_page_size = 5;//Một trang hiển hị 5 cuốn sách
		private $_page_count;
		private $quantity = 0;

		public function setPageSize($page_size){
			$this->_page_size = $page_size;
		}

		public function getAll($currPage = -1)
		{
			if($currPage == -1){
				$sql = 'select * from `comment`';
				return $this->exeQuery($sql);
			}
			$offset = ($currPage -1) * $this->_page_size;
			$sql="SELECT
				Count(*)
				FROM
				comment";

			$this->quantity  = $this->count($sql);
			// echo $n.$this->_page_size;
			$this->_page_count = ceil($this->quantity/$this->_page_size);

			$sql="SELECT
				*
				FROM
				comment
				limit $offset, " . $this->_page_size;
			return $this->exeQuery($sql);	
		}

		public function getCommentByProductId($currPage = -1,$masp){	
			if($currPage == -1){
				$sql="SELECT
				*
				FROM
				`comment`
				WHERE `comment`.product_id = :product_id";
				$arr = array(":product_id"=>$masp);
				return $this->exeQuery($sql,$arr);
			}	
			$offset = ($currPage -1) * $this->_page_size;
			$sql="SELECT
				Count(*)
				FROM
				`comment`
				WHERE `comment`.product_id = :product_id";
			$arr = array(":product_id"=>$masp);
			$this->quantity   = $this->count($sql,$arr);
			$this->_page_count = ceil($this->quantity/$this->_page_size);	

			$sql="SELECT
				*
				FROM
				`comment`
				WHERE `comment`.product_id = :product_id
				limit $offset, ".$this->_page_size;
			
			return $this->exeQuery($sql,$arr);
		}

		public function insert($noidung,$ngaytao,$danhgia,$masp,$ma_user){
			$sql = "INSERT INTO `comment` (`comment_id`, `comment_content`, `comment_date`, `comment_rate`, `product_id`, `user_id`) 
                                            VALUES (NULL, '$noidung', '$ngaytao', '$danhgia', '$masp', '$ma_user');";
			return $this->exeNoneQuery($sql);
		}

		public function delete($mabinhluan){
			$sql = "delete from `comment` where comment_id = $mabinhluan";
			return $this->exeNoneQuery($sql);
		}

		//Trả về 1 mảng đánh giá 5,4,3,2,1 sao
		public function rating_AVG($listBinhLuan){
			$arr = array();
			$rate_5 = 0; $rate_4 = 0; $rate_3 = 0; $rate_2 = 0; $rate_1 = 0;
			foreach ($listBinhLuan as $value) {
				if(!isset($arr[$value['comment_rate']]))
					$arr[$value['comment_rate']] = 1;
				else $arr[$value['comment_rate']] += 1;
			}
			return $arr;
		}
		// public function edit($user_id = '',$user_name = '',$user_address = ''){
		// 	if($user_id != ''){
		// 		try{
		// 			$sql = "update `user` set `user`.user_name = '$user_name',`user`.user_address = '$user_address'
		// 					where `user`.user_id = '$user_id'";
		// 			return $this->exeNoneQuery($sql);
		// 		}
		// 		catch(Exception $e){
		// 			return -1;
		// 		}	
		// 	}
		// 	return -1;
		// }
		
		// public function search($currPage = 1,$key=''){
		// 	// $key = getIndex("key");
			
		// 	$arr = array(":user_id"=>"%". $key ."%");
			
		// 	$offset = ($currPage -1) * $this->_page_size;
		// 	$sql="SELECT
		// 			Count(*)
		// 			FROM
		// 			user
		// 			where user_id like :user_id";
		// 	$n  = $this->count($sql, $arr);
		// 	$this->_page_count = ceil($n/$this->_page_size);
		// 	$sql="SELECT
		// 			*
		// 			FROM
		// 			user
		// 			where user_id like :user_id	
		// 			limit $offset, " . $this->_page_size;	

		// 	return $this->exeQuery($sql, $arr);
		// }

		public function count($sql, $arr=array())
		{
			return $this->countItems($sql, $arr);
		}

		public function getPageCount()
		{
			return $this->_page_count;	
		}

		public function getCount(){
			return $this->quantity;
		}
	}
?>