<?php
	if(isset($_GET['insert-sm'])){
		$mode = getIndex('mode');
		$page = getIndex('page');
		$tenloai = getIndex('cat_name');
		$rs = 'Thêm thất bại';
		if($tenloai != '') {
			$kq = $cats_ad->insert(addslashes($tenloai)); 
		}
		if($kq == 1) $rs = 'Thêm thành công';
		echo "<script>window.location.href = 'index.php?mode=$mode&rs=$rs&page=$page'</script>";
	}
	else exit;
?>