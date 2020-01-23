<?php
    if (!defined("ROOT"))
    {
        echo "Err!"; exit;	
    }
    $page = getIndex("page", 1);
     echo '<div class="col-md-12 col-md-offset-1"> 
    <div class="panel panel-default panel-table"> 
        <div class="panel-heading"> 
            <div class="row"> 
                <div class="col col-xs-6"> 
                    <h3 class="panel-title">Danh sách nhà cung cấp</h3> 
                </div> 
            <div class="col col-xs-6 text-right"> 
            <button type="button" class="btn btn-sm btn-primary btn-create"><a href="add.php?mode=provider&page='.$page.'">Thêm mới</a></button> 
        </div> 
    </div> 
</div>';
     echo " <div class='panel-body'> 
     <table class='table table-striped table-bordered table-list'>  
        <thead> 
            <tr> 
            <th><em class='fa fa-cog'></em>
            </th> 
            <th class='hidden-xs'>Mã nhà cung cấp</th> 
            <th>Tên nhà cung cấp</th>
            <th>Email liên hệ</th>
            <th>SDT liên hệ</th>
            <th>Tổng sản phẩm</th>
            </tr> 
        </thead>
        <tbody>";
    
    $provider_id = getIndex("provider-id");

    //Tìm kiếm theo mã nhà cung cấp
    if($provider_id != ''){
        $list_pros = $pros_ad->searchByID($provider_id);
        foreach($list_pros as $value)
        {
                echo "<tr> 
                    <td align=\"center\">
                        <a href='edit.php?mode=$mode&provider_id={$value['provider_id']}&provider_name={$value['provider_name']}&page=$page' class=\"btn btn-default\"><em class=\"fa fa-pencil\"></em></a> 
                        <a class=\"btn btn-danger\" href='index.php?mode=$mode&ac=remove&provider_id={$value['provider_id']}&page=$page'><em class=\"fa fa-trash\"></em></a>
                    </td>
                    <td>{$value['provider_id']}</td>
                    <td>{$value['provider_name']}</td>
                    <td>{$value['provider_email']}</td>
                    <td>{$value['provider_phone']}</td>
                    <td>{$value['count_item']}</td>
                </tr>";
        }
        echo '</tbody></table></div></div>';
    }
    //Tìm kiếm theo tiêu chí
    else{
        $key = getIndex("key", "");
        $provider_email = getIndex("provider-email");
        $provider_phone = getIndex("provider-phone");
        
        $list_pros = $pros_ad->search($page,addslashes($key),addslashes($provider_email),addslashes($provider_phone));
        foreach($list_pros as $value)
        {
                echo "<tr> 
                    <td align=\"center\">
                        <a href='edit.php?mode=$mode&provider_id={$value['provider_id']}&provider_name={$value['provider_name']}&page=$page' class=\"btn btn-default\"><em class=\"fa fa-pencil\"></em></a> 
                        <a class=\"btn btn-danger\" href='index.php?mode=$mode&ac=remove&provider_id={$value['provider_id']}&page=$page'><em class=\"fa fa-trash\"></em></a>
                    </td>
                    <td>{$value['provider_id']}</td>
                    <td>{$value['provider_name']}</td>
                    <td>{$value['provider_email']}</td>
                    <td>{$value['provider_phone']}</td>
                    <td>{$value['count_item']}</td>
                </tr>";
        }
        echo '</tbody></table></div>';
    
        echo '<div class="panel-footer"> 
        <div class="row"> 
         <div class="col col-xs-4">Trang '.$page.' của '.$pros_ad->getPageCount().'</div> 
         <div class="col col-xs-8"> 
          <ul class="pagination hidden-xs pull-right">';
        for($i=1; $i<=$pros_ad->getPageCount(); $i++)
        {
            echo "<li><a href='index.php?key=$key&mode=$mode&ac=search&page=$i'>$i</a></li>";
        }
        echo '</ul></div></div></div></div>';
    }
?>