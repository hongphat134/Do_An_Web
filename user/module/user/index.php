<?php
    $ac = getIndex('ac');

    $users_clt = new User();
    if($ac == 'check-order')
        include 'check-order.php';
    else if($ac == 'edit')
        include 'edit.php';
?>