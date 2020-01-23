<?php
	if(isset($_REQUEST['insert-sm'])){
		$mode = isset($_REQUEST['mode'])?$_REQUEST['mode']:'';
		//echo $active;

		
		$orders_ad = new Order();
		$tennn = isset($_REQUEST['consignee-name'])?$_REQUEST['consignee-name']:'';
		$sdtnn = isset($_REQUEST['consignee-phone'])?$_REQUEST['consignee-phone']:'';
		$ngaydathang = isset($_REQUEST['order-date'])?$_REQUEST['order-date']:'';
		$trangthai = isset($_REQUEST['order-status'])?$_REQUEST['order-status']:'';
		if($tenncc != '') 
			$kq = $orders_ad->insert(addslashes($tennn),$sdtnn,$ngaydathang,$trangthai); 
	
		// echo "<script> alert($kq);</script>";
		// header("location:main.php?ac=$active");
	}
?>
<script language="javascript">
alert("<?php echo $kq;?>");
window.location = "index.php?mode=<?php echo $mode; ?>";
</script>