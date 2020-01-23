<?php 
	$mode = getIndex("mode",'');
    $page = getIndex('page');
    if($mode == 'category')
    {
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
                <h2 style='text-align:center; margin:15px 0 15px 0;'>Thêm mới Category</h3>
                <div class='form-group'>
                    <form action='index.php' method='get'>
                        <div class='col-sm-2 label'>
                            <label for='cat-name'>Tên category</label>
                        </div>
                        
                        <div class=\"col-sm-8\">
                            <input type=\"text\" class=\"form-control\" name='cat_name'>
                        </div>                     
                        <div class=\"col-sm-2\">
                        <button class=\"btn btn-primary float-right\" name='insert-sm' value='insert' title='Thêm mới'>Thêm mới</button>
                        </div>
                        <input type=\"hidden\" name='page' value='$page'>
                        <input type=\"hidden\" name='mode' value='category'>
                        <input type=\"hidden\" name='ac' value='insert'>
                    </form>
                </div>           
            </div>";   
    }
    else if($mode == 'provider'){
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
                <h2 style='text-align:center; margin:15px 0 15px 0;'>Thêm mới Provider</h3>
                <div class='form-group'>
                    <form action='index.php' method='get'>
                        <div class='row element'>
                            <div class='col-sm-2 label'>
                                <label for='from-date'>Tên Provider</label>
                            </div>                            
                            <div class=\"col-sm-4\">
                                <input type=\"text\" class=\"form-control\" name='provider_name'>
                            </div>                            
                            <div class='col-sm-2 label'>
                                <label for='from-date'>Email</label>
                            </div>                        
                            <div class=\"col-sm-4\">
                                <input type=\"email\" class=\"form-control\" name='provider_email'>
                            </div>                                  
                        </div>

                        <div class='row element'>
                            <div class='col-sm-2 label'>
                                <label for='from-date'>SDT liên hệ</label>
                            </div>                            
                            <div class=\"col-sm-4\">
                                <input type=\"text\" pattern=\"[0-9]{9,15}\" class=\"form-control\" name='provider_phone'>
                            </div>        
                            <div class='col-sm-6'>
                             <button class=\"btn btn-primary float-right\" name='insert-sm' value='insert' title='Thêm mới'>Thêm mới</button>
                            </div>                             
                        </div>      

                        <input type=\"hidden\" name='page' value='$page'>
                        <input type=\"hidden\" name='mode' value='provider'>
                        <input type=\"hidden\" name='ac' value='insert'>
                    </form>
                </div>           
            </div>";   
    }
    else if($mode == 'product'){
        $cats_ad = new Category();
        $list_cats= $cats_ad->getAll();
        $pros_id = new Provider();
        $list_pros = $pros_id->getAll();
        // var_dump($list_cats);
        // var_dump($list_pros);

        $str1 = '';
        foreach ($list_cats as $value) {
            $str1 .= "<option value='{$value['cat_id']}'>{$value['cat_name']}</option>";
        }
        $str2 = '';
        foreach ($list_pros as $key => $value) {
            $str2 .= "<option value='{$value['provider_id']}'>{$value['provider_name']}</option>";
        }
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
                <h2 style='text-align:center; margin:15px 0 15px 0;'>Thêm mới Product</h3>
                <div class='form-group'>
                    <form action='index.php?mode=product&ac=insert&page=$page' method='post' enctype='multipart/form-data'>
                    <div class='row element'>
                        <div class='col-sm-2 label'>
                            <label for='from-date'>Tên sản phẩm</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                            <input type=\"text\" class=\"form-control\" name='product_name'>
                        </div>      
                        <div class='col-sm-2 label'>
                            <label for='from-date'>Giá</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                            <input type=\"text\" class=\"form-control\" pattern='[0-9]{5,10}' name='product_price'>
                        </div>                                         
                    </div>

                    <div class='row element'>
                        <div class='col-sm-2 label'>
                            <label for='from-date'>Hình ảnh</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                            <input type='file' name='product_img'>
                        </div>      
                        <div class='col-sm-2 label'>
                        <label for='from-date'>Nhà cung cấp</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                            <select class='form-control' name='provider_id'>
                                    ".$str2."
                            </select>                    
                        </div>
                    </div>

                    <div class='row element'>
                        <div class='col-sm-2 label'>
                            <label for='from-date'>Số lượng</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                            <input type='number' value='0' min='0' max='999' class=\"form-control\" name='product_quantity'>
                        </div>      
                        <div class='col-sm-2 label'>
                            <label for='from-date'>Loại sản phẩm</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                           <select class='form-control' name='cat_id'>
                                ".$str1."
                           </select>
                        </div>                                                     
                    </div>

                     <div class='row element'>
                        <div class='col-sm-2 label'>
                            <label for='from-date'>Mô tả</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                            <div class=\"form-group\">
                                <textarea name=\"product_description\" class=\"input\" placeholder=\"Điền mô tả của sản phẩm\"></textarea>
                            </div>
                        </div>      
                        <div class='col-sm-2 label'>
                            <label for='from-date'>Chi tiết</label>
                        </div>                        
                        <div class=\"col-sm-4\">
                           <div class=\"form-group\">
                                <textarea name=\"product_detail\" class=\"input\" placeholder=\"Điền chi tiết của sản phẩm\"></textarea>
                            </div>
                        </div>                                                                              
                    </div>

                    <div class='row element'>
                        <div class=\"col-sm-12\">
                            <button class=\"btn btn-primary float-right\" name='insert-sm' value='insert' title='Thêm mới'>Thêm mới</button>
                        </div>
                    </div>
                    </form>
                </div>           
            </div> ";
    }
    else if($mode == 'order-detail')
    {
        $madh = getIndex('order_id');$trangthai = getIndex('order_status');
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
                <h2 style='text-align:center; margin:15px 0 15px 0;'>Thêm mới đơn hàng $madh </h3>
                <div class='form-group'>
                    <form action='index.php' method='get'>
                        <div class='col-sm-2 label'>
                            <label for='cat-name'>Mã sản phẩm</label>
                        </div>
                        
                        <div class=\"col-sm-2\">
                            <input type=\"text\" class=\"form-control\" name='product_id'>
                            <input type=\"hidden\" name='order_id' value='$madh'>
                            <input type=\"hidden\" name='order_status' value='$trangthai'>
                        </div>                     

                        <div class='col-sm-2 label'>
                            <label for='cat-name'>Số lượng</label>
                        </div>
                        
                        <div class=\"col-sm-2\">
                            <input type=\"number\" class=\"form-control\" name='quantity'>
                        </div>                     
                                                                                          
                         <div class=\"col-sm-4\">
                            <input type=\"hidden\" name='mode' value='order'>
                            <input type=\"hidden\" name='ac' value='insert-order-detail'>
                           
                            <button class=\"btn btn-primary float-right\" name='insert-sm' value='insert' title='Thêm mới'>Thêm mới</button>
                        </div>  
                    </form>
                </div>           
            </div>";   
    }
 ?>