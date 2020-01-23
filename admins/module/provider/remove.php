<?php

$mode = getIndex('mode');
$page = getIndex('page');
$kq = 'Xoá thất bại';
if($mode != ''){
	$mancc = getIndex('provider_id');
	if($mancc != ''){
		 $kq = $pros_ad->delete($mancc); 
		 if($kq == 1) $kq = 'Xoá thành công';
		 else $kq = 'Xoá thất bại vì có '.(-$kq).' sản phẩm thuộc nhà cung cấp này!';	
	}	
	echo "<script>location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>";
}
else exit;
?>