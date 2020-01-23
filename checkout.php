<?php
	if(!isset($_SESSION)) session_start();

	if(!isset($_SESSION['shopping-cart'])){ echo "<script>window.location.href='cart.php'</script>";
		exit;
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

		<title>Thanh toán</title>
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

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>


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
						<h3 class="breadcrumb-header">thanh toán</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">thanh toán</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<form action="result.php" method='get'>
						
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Điền thông tin nhận hàng</h3>
							</div>
							<div class="form-group">
								<input type="hidden" name='ac' value='insert'>
								<input type="hidden" name='mode' value='order'>
								<input class="input" type="text" name="name" placeholder="Tên người nhận hàng">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" pattern='[0-9]{9,11}' placeholder="SDT người nhận hàng">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Địa chỉ người nhận hàng">
							</div>	
							<div class="form-group">
								Ngày giờ nhận hàng:
								<input class="input" type="datetime-local" name="date-receipt" id="date-receipt">
							</div>							
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Lưu ý:
									</label>
									<div class="caption">
										<p>Hãy điền thông tin thật chính xác để chúng tôi phục vụ cho bạn tốt nhất! Thời gian giao hàng sớm nhất là 2 ngày! và trễ nhất là 1 tuần!</p>
										<!-- <input class="input" type="password" name="password" placeholder="Enter Your Password"> -->
									</div>
								</div>
							</div>
						</div>
						<!-- /Billing Details -->

						
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Đơn hàng của bạn</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>SẢN PHẨM</strong></div>
								<div><strong>THÀNH TIỀN</strong></div>
							</div>
							<div class="order-products">
							
								<?php									
									$total = 0;
									foreach ($_SESSION['shopping-cart'] as $key => $value) {
										echo "<div class='order-col'>
												<div>{$value['quantity']}x {$value['name']}</div>
												<div>".number_format($value['quantity']*$value['price'],0,'',',')."<sup>đ</sup></div>
											</div>";
										$total += $value['quantity']*$value['price'];
									}																	
								?>
							</div>
							<div class="order-col">
								<div>Vận chuyển</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TỔNG CỘNG</strong></div>
								<!-- <div><strong class="order-total">500.000.000 đ</strong></div> -->
								<div><strong class="order-total"><?php echo isset($total)?number_format($total,0,'',','):0; ?>đ</strong></div>
							</div>
						</div>
						
						<div class="payment-method">
							<div class="section-title text-center">
								<h3 class="title">Phương thức thanh toán</h3>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" value='cast' id="payment-1" checked>
								<label for="payment-1">
									<span></span>
									Tiền mặt
								</label>
								<div class="caption">
									<p>Thanh toán tại địa chỉ nhận hàng</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" value='credit' id="payment-2">
								<label for="payment-2">
									<span></span>
									thẻ tín dụng
								</label>
								<div class="caption">
									<p>Thanh toán qua thẻ tín dụng ngân hàng</p>
								</div>
							</div>
							
						</div>
						
						<button name='order-sm' value='order' class="primary-btn order-submit">Đặt hàng và thanh toán</a>
						</form>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<?php include_once 'subpage/newsletter.php'; ?>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<?php include_once 'subpage/footer.html'; ?>
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
