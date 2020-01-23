<?php
	$page = getIndex("page", 1);
	$list_orders = $orders_ad->getAll('',$page);
	
	echo '<div class="col-md-12 col-md-offset-1"> 
				<div class="panel panel-default panel-table"> 
					<div class="panel-heading"> 
						<div class="row"> 
							<div class="col col-xs-6"> 
								<h3 class="panel-title">Danh sách Đơn đặt hàng</h3> 
							</div> 
						<div class="col col-xs-6 text-right"> 
						
					</div> 
				</div> 
			</div>';
	 echo " <div class='panel-body'> 
	 <table class='table table-striped table-bordered table-list'>  
		<thead> 
			<tr> 
			<th><em class='fa fa-cog'></em>
			</th> 
			<th class='hidden-xs'>Mã đơn hàng</th> 
			<th>Ngày đặt hàng</th> 
			<th>Tên người nhận</th>
			<th>SDT người nhận</th>
			<th>Trạng thái</th>
			</tr> 
		</thead>
		<tbody>";
	foreach($list_orders as $value)
	{
		echo "<tr> 
				<td align=\"center\">
					<a href='edit.php?mode=$mode&order_id={$value['order_id']}&order_date={$value['order_date']}&consignee_name={$value['consignee_name']}&consignee_phone={$value['consignee_phone']}&consignee_address={$value['consignee_address']}&order_status={$value['order_status']}&user_id={$value['user_id']}&page=$page' class=\"btn btn-default\"><em class=\"fa fa-pencil\"></em></a> 
					<a href='index.php?mode=$mode&ac=remove&order_id={$value['order_id']}&page=$page' class=\"btn btn-danger\"><em class=\"fa fa-trash\" onClick=\"IsDeleteOrder();\"></em></a>
					<a href='index.php?mode=$mode&ac=view-order-detail&order_id={$value['order_id']}&order_status={$value['order_status']}' class=\"btn btn-info\" title='Xem chi tiết hoá đơn'><em class=\"fa fa-search\"></em></a>
				</td>
				<td>{$value['order_id']}</td>
				<td>{$value['order_date']}</td>
				<td>{$value['consignee_name']}</td>
				<td>{$value['consignee_phone']}</td>
				<td>".($value['order_status']==1?'Đã thanh toán':'Chưa thanh toán')."</td>	
			</tr>";
	}
	echo '</tbody></table></div>';

	echo '<div class="panel-footer"> 
	<div class="row"> 
	 <div class="col col-xs-4">Trang '.$page.' của '.$orders_ad->getPageCount().'</div> 
	 <div class="col col-xs-8"> 
	  <ul class="pagination hidden-xs pull-right">';
	for($i=1; $i<=$orders_ad->getPageCount(); $i++)
	{
		echo "<li><a href='index.php?mode=$mode&ac=home&page=$i'>$i</a></li>";
	}
	echo '</ul></div></div></div></div>';
?>