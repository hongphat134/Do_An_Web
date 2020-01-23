<?php
    if(isset($_GET['update-sm'])){
        $page = getIndex('page',1);
        $cat_id = getIndex('cat_id');
        $cat_name = getIndex('cat_name');

        if($cat_id != '') $kq = $cats_ad->update($cat_id,addslashes($cat_name));
        if($kq == 1) $kq = 'Sửa thành công';
        else         $kq = 'Sửa thất bại';
    }
    else exit;
    echo "<script>location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>"
?>