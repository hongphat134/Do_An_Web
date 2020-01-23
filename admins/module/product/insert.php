<?php
	if(isset($_POST['insert-sm'])){
		$mode = getIndex('mode');
		$tensp = postIndex('product_name');
		$giasp = postIndex('product_price');
		$hinhanhsp = fileIndex('product_img');
		$soluongsp = postIndex('product_quantity');
		$motasp = postIndex('product_description');
		$chitietsp = postIndex('product_detail');
		$maloai = postIndex('cat_id');
		$mancc = postIndex('provider_id');

		if($tensp == '' || $giasp == '' || $hinhanhsp == '')
			$kq = 'Thêm thất bại';
		else{
			date_default_timezone_set('Asia/Ho_Chi_Minh');

			$arrImg = array("image/png", "image/jpeg", "image/bmp");
			$errFile = $hinhanhsp["error"];
			$err = '';
			$kq = 'Thêm thất bại';
			if ($errFile>0)
				$err .= 'Lỗi hình</br>';
			else
			{
				$type = $hinhanhsp["type"];
				if (!in_array($type, $arrImg))
					$err .= 'Lỗi định dạng</br>';
			}
			
			if(is_numeric($giasp)){
				if($err == ''){
					$temp = $hinhanhsp["tmp_name"];
					$name = $hinhanhsp["name"];
					if (!move_uploaded_file($temp, ROOT."/image/".$name))
						$err .= 'Lỗi copy file</br>';	
					if($err == '') $kq = $products_ad->insert(addslashes($tensp),$giasp,$hinhanhsp['name'],date('Y-m-d'),$soluongsp,addslashes($motasp),addslashes($chitietsp),$maloai,$mancc); 
				}
				if($kq == 1) $kq = 'Thêm thành công';	
				else $kq = 'Thêm thất bại';			
			}
		}
	}
?>
<script language="javascript">
window.location = "index.php?mode=<?php echo $mode; ?>&rs=<?php echo $kq; ?>";
</script>