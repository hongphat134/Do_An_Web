<?php
	$page = getIndex("page", 1);
	$list_products = $products_ad->getAll($page);
	echo '<div class="col-md-12 col-md-offset-1"> 
	<div class="panel panel-default panel-table"> 
		<div class="panel-heading"> 
			<div class="row"> 
				<div class="col col-xs-6"> 
					<h3 class="panel-title">Danh sách sản phẩm</h3> 
				</div> 
			<div class="col col-xs-6 text-right"> 
			<button type="button" class="btn btn-sm btn-primary btn-create"><a href="add.php?mode=product&page='.$page.'">Thêm mới</a></button> 
		</div> 
	</div> 
</div>';
	 echo " <div class='panel-body'> 
	 <table class='table table-striped table-bordered table-list'>  
		<thead> 
			<tr> 
			<th><em class='fa fa-cog'></em>
			</th> 
			<th class='hidden-xs'>Mã sp</th> 
			<th>Tên sản phẩm</th> 
			<th>Giá</th>
			<th>Hình ảnh</th>
			<th>Ngày tạo</th>
			<th>Số lượng</th>
			</tr> 
		</thead>
		<tbody>";
	foreach($list_products as $value)
	{
			echo "<tr> 
				<td align=\"center\">
					<a href='edit.php?mode=$mode&pro_id={$value['product_id']}&pro_name={$value['product_name']}&pro_price={$value['product_price']}&pro_date={$value['product_date']}&pro_img={$value['product_img']}&pro_quantity={$value['product_quantity']}&cat_id={$value['cat_id']}&provider_id={$value['provider_id']}&page=$page' class=\"btn btn-default\"><em class=\"fa fa-pencil\"></em></a> 
					<a href='index.php?mode=$mode&ac=remove&product_id={$value['product_id']}&product_img={$value['product_img']}' class=\"btn btn-danger\"><em class=\"fa fa-trash\"></em></a>
				</td>
				<td>{$value['product_id']}</td>
				<td>{$value['product_name']}</td>
				<td>".number_format($value['product_price'],0,'',',')."<sup>đ</sup></td>
				<td><img src='../image/{$value['product_img']}'  style='height:100px;width:120px;'></img></td>
				<td>{$value['product_date']}</td>
				<td>{$value['product_quantity']}</td>
			</tr>";
	}
	echo '</tbody></table></div>';

	echo '<div class="panel-footer"> 
	<div class="row"> 
	 <div class="col col-xs-4">Trang '.$page.' của '.$products_ad->getPageCount().'</div> 
	 <div class="col col-xs-8"> 
	  <ul class="pagination hidden-xs pull-right">';
	for($i=1; $i<=$products_ad->getPageCount(); $i++)
	{
		echo "<li><a href='index.php?mode=$mode&ac=home&page=$i'>$i</a></li>";
	}
	echo '</ul></div></div></div></div>';
?>