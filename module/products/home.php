<?php 
	//Mảng này xuất cho section new  Product ở Index.php
	$arr_products_new = $products_clt->getNewProduct(12);

	//Mảng này xuất random ở store.php 
	$lstSP = $products_clt->getRand(12);
	$count_item = $products_clt->getCountItem();
 ?>