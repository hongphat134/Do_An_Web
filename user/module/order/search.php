<?php
    $from_date = getIndex('from-date');
    $to_date = getIndex('to-date');
    if($from_date == '') $from_date = date('Y-m-d');
    if($to_date == '') $to_date = date('Y-m-d');

    //echo "$from_date - $to_date";
    $arr_orders = $orders_clt->searchDateToDate($from_date,$to_date,$ma_user);
?>