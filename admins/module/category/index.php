<?php
	$cats_ad = new Category();
	$ac= getIndex("ac", "home");
	// echo '345';
	if ($ac=="home")
			include ROOT."/admins/module/category/home.php";
	else if ($ac=="search")
			include ROOT."/admins/module/category/search.php";
	else if($ac=="insert")
			include ROOT."/admins/module/category/insert.php";
	else if($ac=="remove")
			include ROOT."/admins/module/category/remove.php";
	else if($ac=="update")
			include ROOT."/admins/module/category/update.php";

?>