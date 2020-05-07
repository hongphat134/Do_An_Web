<?php
    //Ajax xử lý cho trang cart.php
    if(!isset($_SESSION)) session_start();
    $ac = isset($_GET['ac'])?$_GET['ac']:'';
    $type = isset($_GET['type'])?$_GET['type']:'';
    if($type == 'cart'){
        if(isset($_SESSION['shopping-cart'])){
            echo '<div class="col-md-12"> 
                    <div class="panel panel-default panel-table"> 
                        <div class="panel-heading"> 
                            <div class="row"> 
                                <div class="col col-xs-6"> 
                                    <h3 class="panel-title">Danh sách sản phẩm</h3> 
                                </div> 
                                <div class="col col-xs-6 text-right"> 
                                    <button type="button" class="btn btn-sm btn-danger btn-create" ><a href="cart.php?ac=clear" style="font-weight: bold;color:lavender;padding:2px;">Xoá giỏ hàng</a></button> 
                                </div> 
                            </div> 
                        </div>';
                echo "<div class='panel-body'> 
                        <table class='table table-striped table-bordered table-list'>  
                            <thead> 
                                <tr> 												
                                    <th>Hình</th> 
                                    <th>Loại sản phẩm</th>
                                    <th>Tên sản phẩm</th> 
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                </tr> 
                            </thead>
                            <tbody>";
            $total = 0;
            foreach($_SESSION['shopping-cart'] as $key => $value)
            {
                    echo "<tr> 
                            <td><img src='image/{$value['image']}' style='width:100px;height:100px'/></td>
                            <td>{$value['cat_name']}</td> 
                            <td>{$value['name']}</td>                                                       
                            <td>".number_format($value['price'],0,'',',')."<sup>đ</sup></td>
                            <td><input type='number' min=1 max=99 onChange=\"UpdateProductToCart('$key',this.value)\" class='form-control' value='{$value['quantity']}'></td>
                        </tr>";
                    $total += $value['price']*$value['quantity'];
            }
            echo '</tbody></table></div>';
            echo '<div class="panel-footer"> 
                    <div class="row"> 							
                        <div class="col-xs-9" style="font-weight:bold;font-size:140%;margin-top:5px;"> 
                                Tổng cộng : '.(isset($total)?number_format($total,0,'',','):0).' đ
                        </div>
                        <div class="col-xs-3"> 
                            <a href="checkout.php" class="primary-btn order-submit float-right">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>	';
        }
        else echo "<div class='col-sm-12' style='text-align:center'>
                        <div class='row'>
                            <img src='img/giohangtrong.png' />
                        </div>
                        Giỏ hàng không có sản phẩm nào cả!
                        <a href='index.php' class='primary-btn order-submit'>Quay về trang chủ</a>
                    </div>";
    }
?>