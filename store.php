<?php
	if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php 
	include "config/config.php";
	include ROOT."/include/function.php";
	spl_autoload_register("loadClass");

	$products = new Product();
	$support_link = "";
 ?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Store</title>

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
		<?php 	
			include 'mode.php';
		 ?>
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
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li><a href="store.php">Danh mục</a></li>
							<li><a href="#">Linh kiện</a></li>
							<li class="active">Sản phẩm (<?php echo isset($count_item)?$count_item:0; ?> Kết quả) <?php echo isset($basic_key)&&$basic_key!=''?" với từ khoá: <strong style='color:red; font-size:140%;'>$basic_key</strong>":''; ?></li>
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
					<form action="store.php" method="get">
					<input type="hidden" name="mode" value="product">
					<input type="hidden" name="ac" value="search">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">	
								<?php 
									// $cats = new Category();
									$cats_clt->setPageSize(20);
									$arrCat = $cats_clt->getProductCountByCat();

									if(isset($lst_cats)&&$lst_cats != ''){
										foreach ($arrCat as $key => $value) {
											$flag = 0;
											foreach ($lst_cats as $v) {
												
												if($value['cat_id'] == $v){
													$support_link .= "lst_cats[]=$v&";
													$flag = 1;
													echo "<div class=\"input-checkbox\">
															<input type=\"checkbox\" name='lst_cats[]' id=\"category-$key\" value='{$value['cat_id']}' checked>
															<label for=\"category-$key\">
																<span></span>
																{$value['cat_name']}
																<small>({$value['quantity']})</small>
															</label>
														</div>";
													break;
												}
											}
											if($flag == 0)
												echo "<div class=\"input-checkbox\">
														<input type=\"checkbox\" name='lst_cats[]' id=\"category-$key\" value='{$value['cat_id']}'>
														<label for=\"category-$key\">
															<span></span>
															{$value['cat_name']}
															<small>({$value['quantity']})</small>
														</label>
													</div>";
										}
									}
									else{
										foreach ($arrCat as $key => $value) {
											echo "<div class=\"input-checkbox\">
													<input type=\"checkbox\" name='lst_cats[]' id=\"category-$key\" value='{$value['cat_id']}'>
													<label for=\"category-$key\">
														<span></span>
														{$value['cat_name']}
														<small>({$value['quantity']})</small>
													</label>
												</div>";
										}
									}
								?>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
									<?php 
									$pros = new Provider();
									$arrProvider = $pros->getProductCountByProvider();

									if(isset($lst_pros) && $lst_pros != ''){
										foreach ($arrProvider as $key => $value) {
											$flag = 0;
											foreach ($lst_pros as $v) {
												
												if($value['provider_id'] == $v){
													$support_link .= "lst_pros[]=$v&";
													$flag = 1;
													echo "<div class=\"input-checkbox\">
															<input type=\"checkbox\" name='lst_pros[]' id=\"brand-$key\" value='{$value['provider_id']}' checked>
															<label for=\"brand-$key\">
																<span></span>
																{$value['provider_name']}
																<small>({$value['quantity']})</small>
															</label>
														</div>";
													break;
												}
											}
											if($flag == 0)
												echo  "<div class=\"input-checkbox\">
															<input type=\"checkbox\" name='lst_pros[]' id=\"brand-$key\" value='{$value['provider_id']}'>
															<label for=\"brand-$key\">
																<span></span>
																{$value['provider_name']}
																<small>({$value['quantity']})</small>
															</label>
														</div>";
										}
									}
									else{
										foreach ($arrProvider as $key => $value) {
											echo "<div class=\"input-checkbox\">
													<input type=\"checkbox\" name='lst_pros[]' id=\"brand-$key\" value='{$value['provider_id']}'>
													<label for=\"brand-$key\">
														<span></span>
														{$value['provider_name']}
														<small>({$value['quantity']})</small>
													</label>
												</div>";
										}
									}
								?>
								<!-- <div class="input-checkbox">
									<input type="checkbox" id="brand-1">
									<label for="brand-1">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>-->
							</div>
						</div>
						<!-- /aside Widget -->
						
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" name="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" name="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class='aside' bgcolor=red>
							<h3 class="aside-title">Ad - Search</h3>
						
							<div class="button-group">
								<input type="button" class="btn btn-default" value="Xoá bộ lọc" id="btn-clear">
								<input  type="submit" class="btn btn-danger" name="btn-apply" id="btn-apply" value="Áp dụng">
							</div>
							<div class='clearfix'></div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<div class="section-nav">
								<div id="slick-nav-6" class="products-slick-nav"></div>
							</div>

							<div class="products-widget-slick" data-nav="#slick-nav-6">
								<div>						
									<?php
										if(isset($arr_product_top_selling)){
											//làm mục chuyến trái phải như ở Top Selling index.php
											$i = 0;
											for ($i; $i < 4 ; $i++) { 
												echo "<div class='product-widget'>
														<div class='product-img'>
															<img src='./image/{$arr_product_top_selling[$i]['product_img']}' alt=''>
														</div>
														<div class='product-body'>
															<p class='product-category'>Category</p>
															<h3 class='product-name'><a href='product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}'>{$arr_product_top_selling[$i]['product_name']}</a></h3>
															<h4 class='product-price'>".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."</h4>
														</div>
													</div>";
											}
																	
									?>
								</div>
								<div>
									<?php
										for ($i; $i < 8 ; $i++) { 
											echo "<div class='product-widget'>
													<div class='product-img'>
														<img src='./image/{$arr_product_top_selling[$i]['product_img']}' alt=''>
													</div>
													<div class='product-body'>
														<p class='product-category'>Category</p>
														<h3 class='product-name'><a href='product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}'>{$arr_product_top_selling[$i]['product_name']}</a></h3>
														<h4 class='product-price'>".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."</h4>
													</div>
												</div>";
										}
									
									?>	
								</div>
								<div>
									<?php
										for ($i; $i < 12 ; $i++) { 
											echo "<div class='product-widget'>
													<div class='product-img'>
														<img src='./image/{$arr_product_top_selling[$i]['product_img']}' alt=''>
													</div>
													<div class='product-body'>
														<p class='product-category'>Category</p>
														<h3 class='product-name'><a href='product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}'>{$arr_product_top_selling[$i]['product_name']}</a></h3>
														<h4 class='product-price'>".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."</h4>
													</div>
												</div>";
										}
									}
									?>	
								</div>
							</div>
									
							
						</div>
						<!-- /aside Widget -->
					</div>
					
					<!-- /ASIDE -->



					<!-- STORE -->
					<div id="store" class="col-md-9" bgcolor=green>
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sắp xếp theo
									<select class='input-select' id='sort-price' name='order'>
									<?php 
										$arrSort = array('normal'=>'Thường',
														 'asc'=>'Tăng dần',
														 'desc'=>'Giảm dần');
										if(isset($order)){
											$support_link .= "order=$order&";
											foreach ($arrSort as $key => $value) {
												if($key == $order)
													echo "<option value='$key' selected>$value</option>";
												else echo "<option value='$key'>$value</option>";
											}
										}
										else{
											foreach ($arrSort as $key => $value) {
												echo "<option value='$key'>$value</option>";
											}
										}
									 ?>
									
										
									</select>
								</label>

								<label>
									Show:
									<select class="input-select" id='show-product' name='show'>
									<?php 
										$arrShow = array('9sp'=>'9'
														,'12sp'=>'12'
														,'15sp'=>'15');
										if(isset($show)){
											$support_link .= "show=$show&";
											foreach ($arrShow as $key => $value) {
												if($key == $show)
													echo "<option value='$key' selected>$value</option>";
												else echo "<option value='$key'>$value</option>";
											}
										}
										else{
											foreach ($arrShow as $key => $value) {
												echo "<option value='$key'>$value</option>";
											}
										}
									 ?>
										<!-- <option value="0">6</option>
										<option value="1">12</option> -->
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active" title="Dạng lưới"><i class="fa fa-th"></i></li>
								<li title="Dạng danh sách"><a href="store.php?mode=product"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						</form>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row" bgcolor=yellow id='content-product'>
							<?php 
								if(isset($lstSP)){
									foreach ($lstSP as $value) {
										echo "<div class='col-md-4 col-xs-6'>
													<div class='product'>
														<div class='product-img'>
															<img src='image/{$value['product_img']}' alt=\"\">
														</div>
														<div class=\"product-body\">
															<p class='product-id' hidden>{$value['product_id']}</p>
															<p class=\"product-category\">{$value['cat_name']}</p>
															<h3 class=\"product-name\"><a href=\"product.php?mode=detail&id={$value['product_id']}\" title='{$value['product_name']}'>{$value['product_name']}</a></h3>
															<h4 class=\"product-price\">".number_format($value['product_price'],0,'',',')."<sup>đ</sup></h4>
															<div class=\"product-rating\">
															</div>
															<div class=\"product-btns\">
																<button onClick=\"AddProductToWishList('{$value['product_id']}','".addslashes($value['product_name'])."','{$value['product_img']}')\" class=\"add-to-wishlist\"><i class=\"fa fa-heart-o\"></i><span class=\"tooltipp\">add to wishlist</span></button>
																<button class=\"add-to-compare\"><i class=\"fa fa-exchange\"></i><span class=\"tooltipp\">add to compare</span></button>
																<button class=\"quick-view\"><i class=\"fa fa-eye\"></i><span class=\"tooltipp\">quick view</span></button>
															</div>
														</div>
														<div class=\"add-to-cart\">
															<button class=\"add-to-cart-btn\" type='button' onClick=\"AddProductToCart('{$value['product_id']}','".addslashes($value['product_name'])."','{$value['product_price']}','{$value['product_img']}','{$value['cat_name']}')\"><i class=\"fa fa-shopping-cart\"></i> add to cart</button>
														</div>
													</div>
												</div>";

									}
									
								}
							 ?>
							
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Showing 6-12 sản phẩm</span>
							<ul class="store-pagination">
							<?php 
								// WORKING
								if(isset($page)){
									// echo $products->getPageCount();

									//có $sm là button subbmit của basic-search(search theo tên và loại sản phẩm)
									if($sm 	!= ''){
										for ($i=1; $i <= $products->getPageCount(); $i++) {
											if($i == $page) echo "<li class='active'>$page</li>";
											else echo "<li><a href='store.php?cat-id=$cat_id&key=$basic_key&mode=product&ac=search&basic-search=Search&page=$i'>$i</a></li>"; 
										}
									} 
									else{										
										for ($i=1; $i <= $products->getPageCount(); $i++) { 
											if($i == $page) echo "<li class='active'>$page</li>";	
											else echo "<li><a href='store.php?mode=product&ac=search&$support_link"."btn-apply=Áp+dụng&page=$i'>$i</a></li>";																							
										}
									}
								}
							 ?>
								
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
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
		<?php 
			if(isset($price_min)){
				$arrMin = explode('.',$price_min);
				$arrMax = explode('.',$price_max);
				//echo $arrMin[0].' + '.$arrMax[0].'<hr>';
				$support_link .= "price-min=$price_min&price-max=$price_max&";
				// echo "<script>
				// 	test();
				// </script>";
				echo "<script>
					updatePriceSlider($('#price-min').parent(),{$arrMin[0]});
					updatePriceSlider($('#price-max').parent(),{$arrMax[0]});</script>";
			}
		 ?>
	</body>
</html>
