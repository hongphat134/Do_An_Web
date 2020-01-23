<?php
	$users_ad = new User();
	$ac= getIndex("ac", "home");
	// echo '345';
	if ($ac=="home")
		include ROOT."/admins/module/user/home.php";
	else if ($ac=="search")
		include ROOT."/admins/module/user/search.php";
	else if($ac=="remove")
		include ROOT."/admins/module/user/remove.php";
?>