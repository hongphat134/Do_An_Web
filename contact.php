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

		<title>Liên hệ</title>

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
						<h3 class="breadcrumb-header">Trung tâm CSKH</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Liên hệ</li>
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
					<div class="col-sm-6">
						<form action="index.php" method="get">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Liên hệ</h3>
							</div>
							<div class="form-group">
								<input type="hidden" name='mode' value='user'>
								<input type="hidden" name='ac' value='contact'>
								<input class="input" type="email" name="email" placeholder="Nhập email nhận thông báo">
							</div>
							<div class="form-group">
								<textarea name="opinition" pattern="[a-zA-Z0-9]{10-500}" class="input" placeholder="Trình bày ý kiến của bạn"></textarea>
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Lưu ý:
									</label>
									<div class="caption">
										<p>Hãy điền thông tin thật chính xác để chúng tôi phục vụ cho bạn tốt nhất</p>
									</div>
								</div>
							</div>
							<div class="form-group">
								<button name="contact-sm" value="contact" class="primary-btn">Gửi</button>
							</div>
						</div>
						</form>
					</div>
					<div class="col-sm-6">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.955107491798!2d106.67572221428671!3d10.737943462840267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752fad0158a09f%3A0xfd0a6159277a3508!2zMTgwIMSQxrDhu51uZyBDYW8gTOG7lywgUGjGsOG7nW5nIDQsIFF14bqtbiA4LCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1576114110800!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:1;" allowfullscreen=""></iframe>
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
