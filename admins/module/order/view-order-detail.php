<?php
	// $page = getIndex("page", 1);
	$madh = getIndex('order_id');
	$trangthai = getIndex('order_status');
	 $list_ordtls = $orders_ad->viewOrderDetail($madh);
	 
	 $thaotac = '';
	 $chucnang = '';
	 $chucnangthem = '';
	 //Nếu hoá đơn đã thanh toán rồi thì ko dc thêm,sửa,xoá gì hết
	 //if($trangthai == 0){
		 // $chucnangthem = '<div class="col col-xs-6 text-right"> 
			// 				<button type="button" class="btn btn-sm btn-primary btn-create">Thêm mới</button> 
			// 			</div>';
		 $thaotac = "<th><em class='fa fa-cog'></em></th>";
		 // $chucnang = "<td align=\"center\">
			// 			<a href='index.php?mode=order&ac=remove-order-detail&product_id=&order_id=$madh' class=\"btn btn-default\"><em class=\"fa fa-pencil\"></em></a> 
			// 			<a href='./' class=\"btn btn-danger\"><em class=\"fa fa-trash\"></em></a>		
			// 		</td>";
	 //}
	
	echo '<div class="col-md-12 col-md-offset-1"> 
				<div class="panel panel-default panel-table"> 
					<div class="panel-heading"> 
						<div class="row"> 
							<div class="col col-xs-6"> 
								<h3 class="panel-title">Chi tiết của đơn hàng '.$madh.' ('.($trangthai==1?'Đã thanh toán':'Chưa thanh toán').')</h3> 
							</div> 
							<div class="col col-xs-6 text-right"> 
								<button type="button" class="btn btn-sm btn-primary btn-create"><a href="add.php?mode=order-detail&order_id='.$madh.'&order_status='.$trangthai .'">Thêm mới</a></button> 
							</div>
						</div> 
					</div>';
	 echo "<div class='panel-body'> 
			<table class='table table-striped table-bordered table-list'>  
				<thead> 
					<tr> 
					".$thaotac."
					<th>Hình sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng</th>
					<th>Đơn giá</th>
					</tr> 
				</thead>
				<tbody>";
	 $total = 0;
	foreach ($list_ordtls as $value) {
		echo "<tr> 
				<td align=\"center\">
						<a href='edit.php?mode=order&ac=update-order-detail&product_id={$value['product_id']}&order_id=$madh&quantity={$value['quantity']}' class=\"btn btn-default\"><em class=\"fa fa-pencil\"></em></a> 
						<a href='index.php?mode=order&ac=remove-order-detail&product_id={$value['product_id']}&order_id=$madh' class=\"btn btn-danger\"><em class=\"fa fa-trash\"></em></a>		
				</td>
				<td><img src='../image/{$value['product_img']}' style='width:100px;height:100px;'></dv>
				<td>{$value['product_name']}</td>				
				<td>{$value['quantity']}</dv>
				<td>".number_format($value['product_price'],0,'',',')."<sup>đ</sup></td>
			</tr>";
		$total += $value['product_price']*$value['quantity'];
	}
	echo '</tbody></table></div>';
	echo "<div class='panel-footer'><h4>Tổng tiền là: ".number_format($total,0,'',',')."<sup>đ</sup></h3></div>";
?>