<?php
	if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php 
	include "config/config.php";
	include ROOT."/include/function.php";
	spl_autoload_register("loadClass");
 ?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Chính sách</title>

		<link rel="shortcut icon" href="img/favicon.png">
 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

 		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
 		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 		<!--[if lt IE 9]>
 		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 		<![endif]-->

    </head>
	<body onload="SetDefault();">
		<!-- HEADER -->
		<?php include_once 'subpage/header.php'; ?>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<?php include_once 'subpage/navigation.html'; ?>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Chính sách</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Chính sách</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-xs-12">
						<ul>
							<li>
								<p><h3>Bình luận</h3></p>
								<p>Khi bình luận phải đăng nhập. Có thể đóng góp đánh giá để sản phẩm được đánh giá chính xác hơn!</p>
							</li>
							<li>
								<p><h3>Giỏ hàng</h3></p>
								<p>Có thể thêm giỏ hàng tuỳ chỉnh số lượng,xoá thậm chí thay đổi số lượng</p>
							</li>
							<li>
								<p><h3>Thanh toán</h3></p>
								<p>Khi thanh toán thì bạn cần phải đăng nhập để chúng tôi có thể lưu lại lịch sử đơn hàng để bạn có thể kiểm tra!</p>
							</li>
							<li>
								<p><h3>Đăng nhập</h3></p>
								<p>Bạn có thể kiểm tra đơn hàng cũng như là thay đổi thông tin tài khoản của bạn!</p>
							</li>
							<li>
								<p><h3>Đăng ký</h3></p>
								<p>Thao tác đăng ký rất dễ dàng! Nhưng hãy lưu ý đừng dùng Email đã kích hoạt cho tài khoản khác trong hệ thống của chúng tôi và tài khoản cũng thế!</p>
							</li>
							<li>
								<p><h3>Khôi phục mật khẩu</h3></p>
								<p>Điền email tài khoản của bạn và nhận thông báo từ email để thay đổi mật khẩu!</p>
							</li>
							<li>
								<p><h3>Liên hệ</h3></p>
								<p>Nêu ra ý kiến của bạn để chúng tôi có thể giải quyết được cho bạn nếu có thể?</p>
							</li>
							<li>
								<p><h3>Tìm kiếm</h3></p>
								<p>Có 2 loại là tìm kiếm cơ bản và tìm kiếm theo nhiều tiêu chí. Chẳng hạn như: nhà cung cấp, loại sản phẩm, sắp xếp, show số lượng sản phẩm,...</p>
							</li>
						</ul>
					</div>
				</div>	
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<?php include'subpage/newsletter.php';?>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<?php include'subpage/footer.html';?>
		<!-- /FOOTER -->
		
		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
