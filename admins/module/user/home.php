<?php
    //echo 'this is home';
    $page = getIndex("page", 1);
    $list_users = $users_ad->getAll($page);
	echo '<div class="col-md-12 col-md-offset-1"> 
			<div class="panel panel-default panel-table"> 
				<div class="panel-heading"> 
					<div class="row"> 
						<div class="col col-xs-6"> 
							<h3 class="panel-title">Danh sách khách hàng</h3> 
						</div> 
					</div> 
				</div>';
     echo " <div class='panel-body'> 
	 <table class='table table-striped table-bordered table-list'>  
		<thead> 
			<tr> 			
			<th class='hidden-xs'>Tài khoản</th> 
			<th>Mật khẩu</th> 
			<th>Email</th>
			<th>SDT</th>
			<th>Họ tên</th>
			</tr> 
		</thead>
		<tbody>";
	foreach($list_users as $value)
	{
            echo "<tr> 				
                <td>{$value['user_id']}</td>           
                <td>{$value['user_pwd']}</td>
                <td>{$value['user_email']}</td>
                <td>{$value['user_phone']}</td>
                <td>{$value['user_name']}</td>
			</tr>";
    }
    echo '</tbody></table></div>';

	echo '<div class="panel-footer"> 
	<div class="row"> 
	 <div class="col col-xs-4">Trang '.$page.' của '.$users_ad->getPageCount().'</div> 
	 <div class="col col-xs-8"> 
	  <ul class="pagination hidden-xs pull-right">';
    for($i=1; $i<=$users_ad->getPageCount(); $i++)
	{
        echo "<li><a href='index.php?mode=$mode&ac=home&page=$i'>$i</a></li>";
    }
    echo '</ul></div></div></div></div>';
    
?>