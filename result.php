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

		<title>Kết quả</title>
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
						<h3 class="breadcrumb-header">Result Page</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Kết quả</li>
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
				<?php					
					include 'mode.php';
				?>
					<div class="col-md-7">
						<!-- Billing Details -->						
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">
								<?php 
									$payment = getIndex('payment');
									if($payment != ''){
										if($payment == 'cast') echo "<p style='color:green;'><i class='fa fa-check-circle'></i>&nbsp;&nbsp;Đặt hàng thành công</p>";
										else if($payment == 'credit') echo "<p style='color:green;'><i class='fa fa-check-circle'></i>&nbsp;&nbsp;Đặt hàng và thanh toán thành công</p>";
									}
									else {
										 echo "<script>alert('Lỗi trang!'); window.location.href = 'store.php'</script>"; exit;
									}
									
								?></h3>
							</div>
							
							<!-- Nội Dung -->
							<?php																
								echo "<p>Cảm ơn quý khách đã đặt hàng tại HTP!</p>
								<p>Đơn hàng đã được tạo thành công. Để <a href='user/index.php'><strong>kiểm tra đơn hàng</strong></a> hoặc thay đổi thông tin, vui lòng Đăng nhập vào website. Nếu Quý khách có yêu cầu đặc biệt, vui lòng liên hệ nhân viên tư vấn tại trang liên hệ của chúng tôi hoặc hotline 0938900000 (Miễn phí).</p>
								<p>Tham gia cộng đồng 'HTP' để được hỗ trợ đơn hàng tốt nhất!</p>
								<div class='col-xs-12' style='background-color:lavender;margin:25px 0 25px 0; padding:15px 0 15px 15px;'>
									<div class='row'>
										<p>
										<div class='col-xs-4'>Khách hàng :</div> 
										<div class='col-xs-8'><strong>$name</strong></div>
										</p>
									</div>
									<div class='row'>
										<p>
										<div class='col-xs-4'>Tên người nhận hàng:</div> 
										<div class='col-xs-8'> <strong>{$_GET['name']}</strong></div>
										</p>
									</div>
									<div class='row'>
										<p>
										<div class='col-xs-4'>SDT người nhận hàng:</div> 
										<div class='col-xs-8'> <strong>{$_GET['tel']}</strong></div>
										</p>
									</div>
									<div class='row'>
										<p>
										<div class='col-xs-4'>Địa chỉ nhận:</div> 
										<div class='col-xs-8'> <strong>{$_GET['address']}</strong></div>
										</p>
									</div>
								</div>";
								
							?>

							<a href="store.php" class="primary-btn order-submit" style='float:right;'>Tiếp tục mua hàng&nbsp;&nbsp;<i class='fa fa-cart-plus' style='font-size:150%;'></i></a>						
							<div class="clearfix"></div>			
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
									if(isset($_SESSION['shopping-cart'])){					
										$total = 0;
										foreach ($_SESSION['shopping-cart'] as $value) {
											echo "<div class='order-col'>
													<div>{$value['quantity']}x {$value['name']}</div>
													<div>".number_format($value['quantity']*$value['price'],0,'',',')."<sup>đ</sup></div>
												</div>";
											$total += $value['quantity']*$value['price'];
										}	
									}								
								?>
							</div>
							<div class="order-col">
								<div>Vận chuyển</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TỔNG CỘNG</strong></div>								
								<div><strong class="order-total"><?php echo isset($total)?number_format($total,0,'',','):0; ?>đ</strong></div>
							</div>
						</div>
						
											
						
					</div>
					<!-- /Order Details -->
					<?php 
							//Thanh toán thành công thì xoá giỏ hàng nhưng chưa xoá = ajax dc
							unset($_SESSION['shopping-cart']);
					 ?>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<?php include 'subpage/newsletter.php'; ?>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<?php include 'subpage/footer.html'; ?>
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
