<?php
	$products_ad = new Product();
	$ac= getIndex("ac", "home");
	// echo '345';
	if ($ac=="home")
			include ROOT."/admins/module/product/home.php";
	else if ($ac=="search")
			include ROOT."/admins/module/product/search.php";
	else if($ac=="insert")
			include ROOT."/admins/module/product/insert.php";
	else if($ac=="remove")
			include ROOT."/admins/module/product/remove.php";
	else if($ac=="sold")
			include ROOT."/admins/module/product/sold.php";
	else if($ac=="update")
			include ROOT."/admins/module/product/update.php";

?>