<?php
	if(isset($_GET['insert-sm'])){
		$mode = getIndex('mode');
		$page = getIndex('page');
		$tenncc = getIndex('provider_name');
		$emailncc = getIndex('provider_email');
		$sdtncc = getIndex('provider_phone');
		$kq = 'Thêm thất bại';
		if($tenncc != '') {
			$kq = $pros_ad->insert($tenncc,$emailncc,$sdtncc); 
			if($kq == 1) $kq = 'Thêm thành công';
			else $kq = 'Thêm thất bại';
		}
		echo "<script>window.location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>";
	}
	else exit;
?>