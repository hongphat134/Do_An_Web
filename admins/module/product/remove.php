<?php

	$mode = getIndex('mode');
	if($mode != ''){
		$masp = getIndex('product_id');
		$hinhsp = getIndex('product_img');
		$kq = 'Xoá thất bại';
		if($masp != ''){
			 $kq = $products_ad->delete($masp); 
			 if($kq == 1){ 
			 	unlink(ROOT."/image/$hinhsp");
			 	$kq = 'Xoá thành công';
			 }
			 else $kq = 'Xoá thất bại';	
		}
		
		echo "<script>location.href = 'index.php?mode=$mode&rs=$kq'</script>";
	}
?>