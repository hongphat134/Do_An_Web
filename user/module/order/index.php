<?php
    $ac = getIndex('ac','home');
    
    $orders_clt = new Order();
    if($ac == 'home')
        include 'home.php';
    else if($ac == 'search')
        include 'search.php';
    else if($ac == 'view')
        include 'view-ordtl.php';
?>