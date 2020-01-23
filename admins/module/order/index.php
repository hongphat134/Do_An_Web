<?php
	$orders_ad = new Order();
	$ac= getIndex("ac", "home");
	// echo '345';
	if ($ac=="home")
			include ROOT."/admins/module/order/home.php";
	else if ($ac=="search")
			include ROOT."/admins/module/order/search.php";
	else if($ac=="insert")
			include ROOT."/admins/module/order/insert.php";
	else if($ac=="remove")
			include ROOT."/admins/module/order/remove.php";
	else if($ac=="revenue")
			include ROOT."/admins/module/order/revenue.php";
	else if($ac=="update")
			include ROOT."/admins/module/order/update.php";
	else if($ac=='view-order-detail')
			include ROOT."/admins/module/order/view-order-detail.php";
	else if($ac=='remove-order-detail')
		include ROOT."/admins/module/order/remove-order-detail.php";
	else if($ac=='update-order-detail')
		include ROOT."/admins/module/order/update-order-detail.php";
	else if($ac=='insert-order-detail')
		include ROOT."/admins/module/order/insert-order-detail.php";
?>