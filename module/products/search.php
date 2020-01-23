<?php 
	//echo "This is Search Page";
	$sm = getIndex('basic-search');
	$page = getIndex('page',1);
	// echo $sm.'Hỏi chấm';
	//Trường hợp tìm kiếm cơ bản
	if($sm != ''){
		//echo "<script>alert('Đây là search cơ bản')</script>";
		$cat_id = getIndex('cat-id');
		$basic_key = getIndex('key');
		
		if($cat_id == 'all'){
			$cats_clt = new Category();
			$arrs_cats = $cats_clt->getAll();
			//var_dump($arrs_cats);
			foreach ($arrs_cats as $v) {
				$lst_cats[] = $v['cat_id'];
			}
			 //$lst_cats = array(1,2,3,4,5,6,8,9,10);
		} 
		else $lst_cats[] = $cat_id;

		//echo "$cat_id - $key";
		// $products->setPageSize(10);
		$lstSP = $products->basic_seachByCategory($page,addslashes($basic_key),$cat_id);
		$count_item = $products->getCountItem();
	}
	else{
		$lst_cats = getIndex('lst_cats');
		$lst_pros = getIndex('lst_pros');
		$price_min = getIndex('price-min');
		$price_max = getIndex('price-max');
		$order = getIndex('order');
		$show = getIndex('show');
	
		//var_dump($lst_cats);var_dump($lst_pros);

		//echo "$price_min - $price_max<hr>";
		if($show == '9sp') $products->setPageSize(9);
		else if($show == '12sp') $products->setPageSize(12);
		else if($show == '15sp') $products->setPageSize(15);
		
		$lstSP = $products->search($lst_cats,$lst_pros,$price_min,$price_max,$order,$page);
		$count_item = $products->getCountItem();
	}
 ?>