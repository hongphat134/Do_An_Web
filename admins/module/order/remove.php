<?php

$mode = getIndex('mode');
$page = getIndex('page');
$kq = 'Xoá thất bại';
if($mode != ''){
	$madh = getIndex('order_id');
	if($madh != ''){
		 $kq = $orders_ad->delete($madh); 
		 if($kq == 1) $kq = 'Xoá thành công';	
		 else $kq = 'Xoá thất bại';
	}
	
	echo "<script>location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>";
}
?>