<?php
    //echo 'This is view of ordtl';

    $order_id = getIndex('id');
    
    // echo $order_id;

    $arr_ordtls = $orders_clt->viewOrderDetail($order_id);

    //$arr_orders = $orders_clt->searchDateToDateByUser($ma_user,$from_date,$to_date);
?>