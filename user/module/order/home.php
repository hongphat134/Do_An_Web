<?php
    //echo 'This is home of order';
    $page = getIndex('page',1);
    $arr_orders = $orders_clt->getAll($ma_user,$page);
?>