<?php 
 	echo "This is remove detail";
 	$mode = getIndex('mode');
 	$madh = getIndex('order_id');
 	$masp = getIndex('product_id');	 
 	$trangthai = getIndex('order_status');
 	$rs = 'Xoá thất bại';
 	if(is_numeric($masp)) {
 		$kq = $orders_ad->removeOrderDetail($madh,$masp);	
 		if($kq == 1) $rs = 'Xoá thành công';
 	}
	echo "<script>window.location.href = 'index.php?mode=$mode&ac=view-order-detail&order_id=$madh&order_status=$trangthai&rs=$rs'</script>";
 ?>