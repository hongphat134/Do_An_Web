<?php

	$mode = getIndex('mode');
	$page = getIndex('page');
	$kq   = 'Xoá thất bại';
	if($mode != ''){
		$maloai = getIndex('cat_id');
		if($maloai != ''){
			 $kq = $cats_ad->delete($maloai); 
			 if($kq == 1) $kq = 'Xoá thành công';	
			 else $kq = 'Xoá thất bại vì có '.(-$kq).' sản phẩm thuộc danh mục này';
		}		
		echo "<script>location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>";
	}
	else exit;

?>