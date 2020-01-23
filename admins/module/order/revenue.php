<?php
    if (!defined("ROOT"))
    {
        echo "Err!"; exit;	
    }
    $from_date = getIndex('from-date');
    $to_date = getIndex('to-date');
    if($from_date != ''){
        $list_orders = $orders_ad->revenueByDate($from_date,$to_date);
        $notice = " từ ngày : $from_date  ->  Đến ngày: $to_date</br>";
    }
    else $list_orders = $orders_ad->revenue();

    echo '<div class="col-md-12 col-md-offset-1"> 
            <div class="panel panel-default panel-table"> 
                <div class="panel-heading"> 
                    <div class="row"> 
                        <div class="col col-xs-6"> 
                            <h3 class="panel-title">Danh sách đơn hàng đã đặt'.(isset($notice)?$notice:'').'</h3> 
                        </div> 
            </div> 
        </div>';
        
    echo "<div class='panel-body'> 
            <table class='table table-striped table-bordered table-list'>  
                <thead> 
                    <tr> 
                        <th>Mã đơn hàng</th> 
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th> 
                        <th>Thành tiền</th>
                        <th style='text-align:center;'>
                            <em class='fa fa-cog'></em>
			            </th> 
                    </tr> 
                </thead>
                <tbody>";
    $total = 0;
    foreach($list_orders as $value)
    {
        echo "<tr> 
            <td>{$value['order_id']}</td>
            <td>{$value['order_date']}</td>
            <td>".($value['order_status'] == 1?'Đã thanh toán':'Chưa thanh toán')."</td>
            <td>".number_format($value['total'],0,'',',')."<sup>đ</sup></td>
            <td align=\"center\">                
                <a href='index.php?mode=order&ac=view-order-detail&order_id={$value['order_id']}&order_status=1' class=\"btn btn-info\" title='Xem chi tiết hoá đơn'><em class=\"fa fa-search\"></em></a>
            </td>      
        </tr>";
        //$total += $value['product_price']*$value['quantity'];
        $total += $value['total'];
    }
    echo "<div class='panel-title'>Tổng doanh thu: ".number_format($total,0,'',',')." <sup>đ</sup></div>";
    echo '</tbody></table></div>';
    
?>