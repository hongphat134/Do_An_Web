<?php
    if (!defined("ROOT"))
    {
        echo "Err!"; exit;	
    }
    //$key = getIndex("key", "");


    //$page = getIndex("page", 1);
    $list_products = $products_ad->getSoldProduct();

    echo '<div class="col-md-12 col-md-offset-1"> 
    <div class="panel panel-default panel-table"> 
        <div class="panel-heading"> 
            <div class="row"> 
                <div class="col col-xs-6"> 
                    <h3 class="panel-title">Danh sách sản phẩm đã bán</h3> 
                </div> 
            </div>
        </div> 
    </div> 
</div>';
    echo " <div class='panel-body'> 
	 <table class='table table-striped table-bordered table-list'>  
		<thead> 
			<th>Mã sp</th> 
            <th>Hình ảnh</th>
			<th>Tên sản phẩm</th> 
			<th>Giá</th>
			<th>Số lượng đã bán</th>
			</tr> 
		</thead>
		<tbody>";
    
    foreach($list_products as $value)
    {        
        echo "<tr> 
            <td>{$value['product_id']}</td>            
            <td><img src='../image/{$value['product_img']}' style='width:125px;height:100px;' /></td>
            <td>{$value['product_name']}</td>
            <td>".number_format($value['product_price'],0,'',',')."<sup>đ</sup></td>
            <td>".(isset($value['quantity'])?$value['quantity']:0)."</td>
        </tr>";
    }
    echo '</tbody></table></div>';
    
?>