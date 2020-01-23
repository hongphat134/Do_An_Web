<?php
    if(isset($_GET['update-sm'])){
        $page = getIndex('page',1);

        $mode = getIndex('mode');
        $order_id = getIndex('order_id');
        $consignee_name = getIndex('consignee_name');
        $consignee_phone = getIndex('consignee_phone');
        $consignee_address = getIndex('consignee_address');
        $order_status = getIndex('order_status');
        $kq = 'Sửa thất bại';


        //echo "$order_id - $consignee_name - $consignee_phone - $consignee_address - $order_status";


        if($order_id != '') $kq = $orders_ad->update($order_id,addslashes($consignee_name),$consignee_phone,$consignee_address,$order_status);
        if($kq == 1) $kq = 'Sửa thành công';
        else         $kq = 'Sửa thất bại';
        
    }
    else exit;
    echo "<script>location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>";
?>