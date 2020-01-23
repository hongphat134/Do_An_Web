<?php 
	//echo "This is Index Page";
	$ac = getIndex('ac','home');
	$products_clt = new Product();

	//Vì TOP SELLING hiện ở 2 trang index và store nên để ở đây
	$arr_product_top_selling = $products_clt->getTopSelling(18);
	
	// $count = count($arr_product_top_selling);
	// if($count < 18){
	// 	$arr_add = $products_clt->getRand(18 - $count);
	// 	$arr_product_top_selling = array_merge($arr_product_top_selling,$arr_add);
	// }
	if($ac == 'home')
		include 'home.php';
	else if($ac == 'search')
		include 'search.php';
	else if($ac == 'check-quantity')
		include 'check.php';
 ?>