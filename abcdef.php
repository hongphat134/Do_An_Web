<?php
	include "config/config.php";
	include ROOT."/include/function.php";

	if(!isset($_SESSION)) session_start();
	$user= getIndex('a');
	$name = getIndex('b');
	$pwd = getIndex('c');
	$email = getIndex('d');
	$phone = getIndex('e');
	$address = getIndex('f');
	if($user != '' && $pwd != '' && $phone != '' && $email != ''){
		$_SESSION['user']['user_id'] =  $user;
		$_SESSION['user']['user_pwd'] =  $pwd;
		$_SESSION['user']['user_email'] =  $email;
		$_SESSION['user']['user_phone'] =  $phone;
		$_SESSION['user']['user_name'] =  $name;
		$_SESSION['user']['user_address'] =  $address;
		echo "đã set Session";
		echo "<script>window.location = '".BASE_URL."/user/change-user.php?type=forgot'</script>";
	}
	else echo "Có vấn đề xảy ra ở đây!";
?>
