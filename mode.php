<?php 
	$mode = getIndex('mode','product');
	if($mode=='user')
		include 'module/users/index.php';
	else if($mode=='product')
		include 'module/products/index.php';
	else if($mode == 'detail')
		include 'module/comments/index.php';
	else if($mode == 'news')
		include 'module/news/index.php';
	else if($mode == 'order')
		include 'module/orders/index.php';
	else if($mode =='exit'){
		//if(isset($_COOKIE['user_email'])) {
		if(isset($_SESSION['user'])){
			//setcookie('user_email','',time()-3600);
			//echo "<script>alert(window.location.pathname)</script>";
			unset($_SESSION['user']);
			unset($_SESSION['wishlist']);
			//Load thêm lần nữa để xoá dc cookie . 1 lần cookie chưa reload lại 
			header("location:index.php");
		}
	}
 ?>