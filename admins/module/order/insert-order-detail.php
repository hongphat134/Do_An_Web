<?php 
	if(isset($_GET['insert-sm'])){
	 	echo "This is insert detail";
	 	$mode = getIndex('mode');
	 	$madh = getIndex('order_id');
	 	$masp = getIndex('product_id');
	 	$soluong = getIndex('quantity');
	 	$trangthai = getIndex('order_status');
	 	$rs = 'Thêm thất bại vì mã sản phẩm không tồn tại';
	 	echo "$madh - $masp - $soluong";
	 	if(is_numeric($masp)) {
	 		$kq = $orders_ad->insertOrderDetail($madh,$masp,$soluong);	
	 		if($kq == 1) $rs = 'Thêm thành công';
	 	}
		echo "<script>window.location.href = 'index.php?mode=$mode&ac=view-order-detail&order_id=$madh&order_status=$trangthai&rs=$rs'</script>";
	}
	else exit;
 ?>