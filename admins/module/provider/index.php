<?php
	$pros_ad = new Provider();
	$ac= getIndex("ac", "home");
	// echo '345';
	
	if ($ac=="home")
		include ROOT."/admins/module/provider/home.php";
	else if ($ac=="search")
		include ROOT."/admins/module/provider/search.php";
	else if($ac=="insert")
		include ROOT."/admins/module/provider/insert.php";
	else if($ac=="remove")
		include ROOT."/admins/module/provider/remove.php";
	else if($ac=="update")
		include ROOT."/admins/module/provider/update.php";
?>