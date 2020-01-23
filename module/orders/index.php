<?php 
	$ac = getIndex('ac','home');
	$orders_clt = new Order();
	if($ac == 'insert')
		include 'insert.php';
 ?>