<?php
    if(isset($_GET['update-sm'])){
        $mode = getIndex('mode');
        $page = getIndex('page');
        $provider_id = getIndex('provider_id');
        $provider_name = getIndex('provider_name');
        $provider_email = getIndex('provider_email');
        $provider_phone = getIndex('provider_phone');

        if($provider_id == '') $kq = 'Lỗi nhà cung cấp';
        else if($provider_name == '') $kq = 'Không để trống tên nhà cung cấp';
        else if($provider_email == '') $kq = 'Không để trống email liên lạc với nhà cung cấp';
        else if($provider_phone == '') $kq = 'Không để trống sdt liên lạc với nhà cung cấp';
        else{
            $kq = $pros_ad->update($provider_id,addslashes($provider_name),addslashes($provider_email),addslashes($provider_phone));
            if($kq == 1) $kq = 'Sửa thành công';
            else         $kq = 'Sửa thất bại';
        }
    }
    echo "<script>location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>"
?>