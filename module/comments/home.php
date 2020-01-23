<?php
    //echo "This is Home Comment";
    $product_id = getIndex('id');
    if($product_id != ''){
        $page = getIndex('page',1);
        $arr_comments = $comments_clt->getCommentByProductId($page,$product_id);
        $arr_rate = $comments_clt->rating_AVG($comments_clt->getCommentByProductId(-1,$product_id));    
        $count_comment = $comments_clt->getCount();
    }
?>