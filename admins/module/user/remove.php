<?php
	$mode = getIndex('mode');
	$page = getIndex('page');
	$kq = 'Xoá thất bại';
	if($mode != ''){
		$ma_user = getIndex('user_id');
		if($ma_user != '') $kq = $users_ad->delete($ma_user); 
		if($kq == 1) $kq ='Xoá thành công';
		else $kq = 'Xoá thất bại';
	}
	else exit;
	echo "<script>window.location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>";

	
?>