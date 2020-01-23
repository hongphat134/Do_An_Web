<?php 
 	
 	if($_GET['update-sm']){
 		echo "This is update detail";
	 	$mode = getIndex('mode');
	 	$madh = getIndex('order_id');
	 	$masp = getIndex('product_id');	 
	 	$soluong = getIndex('quantity');
	 	$trangthai = getIndex('order_status');
	 	$rs = 'Sửa thất bại';
	 	if(is_numeric($masp)) {
	 		$kq = $orders_ad->updateOrderDetail($madh,$masp,$soluong);	
	 		if($kq == 1) $rs = 'Sửa thành công';
	 	}
		echo "<script>window.location.href = 'index.php?mode=$mode&ac=view-order-detail&order_id=$madh&order_status=$trangthai&rs=$rs'</script>";
	}
	else exit;
 ?>