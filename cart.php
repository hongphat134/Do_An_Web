<?php
	if(!isset($_SESSION)) session_start();
	if(isset($_GET['ac'])) {
		if(isset($_SESSION['shopping-cart'])) unset($_SESSION['shopping-cart']);		
	}
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

		<title>Giỏ hàng</title>

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
						<h3 class="breadcrumb-header">giỏ hàng</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">giỏ hàng</li>
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
				<div class="row" id='shopping-cart-detail'>						
						<?php
							if(isset($_SESSION['shopping-cart'])){
								echo '<div class="col-md-12"> 
										<div class="panel panel-default panel-table"> 
											<div class="panel-heading"> 
												<div class="row"> 
													<div class="col col-xs-6"> 
														<h3 class="panel-title">Danh sách sản phẩm</h3> 
													</div> 
													<div class="col col-xs-6 text-right"> 
														<button type="button" class="btn btn-sm btn-danger btn-create" ><a href="cart.php?ac=clear" style="font-weight: bold;color:lavender;padding:2px;">Xoá giỏ hàng</a></button> 
													</div> 
												</div> 
											</div>';
									echo "<div class='panel-body'> 
											<table class='table table-striped table-bordered table-list'>  
												<thead> 
													<tr> 												
														<th>Hình</th> 
														<th>Loại sản phẩm</th>
														<th>Tên sản phẩm</th> 
														<th>Đơn giá</th>
														<th>Số lượng</th>
													</tr> 
												</thead>
												<tbody>";
								foreach($_SESSION['shopping-cart'] as $key => $value)
								{
										echo "<tr> 
												<td><img src='image/{$value['image']}' style='width:100px;height:100px'/></td>
												<td>{$value['cat_name']}</td>
												<td>{$value['name']}</td>
												<td>".number_format($value['price'],0,'',',')."<sup>đ</sup></td>
												<td><input type='number' min=1 max=99 onChange=\"UpdateProductToCart('$key',this.value)\" class='form-control' value='{$value['quantity']}'></td>
											</tr>";
								}
								
								echo '</tbody></table></div>';
								echo '<div class="panel-footer"> 
										<div class="row"> 							
											<div class="col-xs-9" style="font-weight:bold;font-size:140%;margin-top:5px;"> 
													Tổng cộng : '.(isset($total)?number_format($total,0,'',','):0).' đ
											</div>
											<div class="col-xs-3"> 
												<a href="checkout.php" class="primary-btn order-submit float-right">Thanh toán</a>
											</div>
										</div>
									</div>
								</div>
							</div>	';
							}
							else echo "<div class='col-sm-12' style='text-align:center'>
											<div class='row'>
												<img src='img/giohangtrong.png' />
											</div>
											Giỏ hàng không có sản phẩm nào cả!
											<a href='index.php' class='primary-btn order-submit'>Quay về trang chủ</a>
										</div>";
						?>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<?php include 'subpage/newsletter.php';?>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<?php include 'subpage/footer.html';?>
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
