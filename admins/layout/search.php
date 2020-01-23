<?php 
	$mode = getIndex("mode",'');
    // $page = getIndex("page",1);
    if($mode == 'category')
    {
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
                <h2 style='text-align:center; margin:15px 0 15px 0;'>Tìm kiếm danh mục</h3>
                <div class='form-group'>
                    <form action='index.php' method='get'>
                        <div class='col-sm-2 label'>
                            <label for='cat-id'>Mã danh mục</label>
                        </div>
                        
                        <div class=\"col-sm-2\">
                            <input type=\"text\" class=\"form-control\" name='cat-id' placeholder='Nhập mã...'>
                        </div>     

                        <div class='col-sm-2 label'>
                            <label for='cat-name'>Tên danh mục</label>
                        </div>
                        
                        <div class=\"col-sm-5\">
                            <input type=\"text\" class=\"form-control\" name='key' placeholder='Nhập tên danh mục.....'>
                        </div>                     
                        <div class=\"col-sm-1\">
                        <button class=\"btn btn-warning\" name='search-sm' value='search' title='Tìm'><i class='fa fa-search'></i></button>
                        </div>
                        <input type=\"hidden\" name='mode' value='category'>
                        <input type=\"hidden\" name='ac' value='search'>
                    </form>
                </div>           
            </div>";   
    }
    else if($mode == 'provider'){
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
                <h2 style='text-align:center; margin:15px 0 15px 0;'>Tìm kiếm nhà cung cấp</h3>
                <div class='form-group'>
                    <form action='index.php' method='get'>
                        <div class='row element'>
                            <div class='col-sm-2 label'>
                                <label for='provider-name'>Mã nhà cung cấp</label>
                            </div>
                            
                            <div class=\"col-sm-3\">
                                <input type=\"text\" class=\"form-control\" name='provider-id' placeholder='Nhập mã.....'>
                            </div>
                            <div class='col-sm-2 label'>
                                <label for='provider-name'>Tên nhà cung cấp</label>
                            </div>
                            
                            <div class=\"col-sm-5\">
                                <input type=\"text\" class=\"form-control\" name='key' placeholder='Nhập tên nhà cung cấp......'>
                            </div>                   
                        </div>  

                        <div class='row element'>
                            <div class='col-sm-2 label'>
                                <label for='provider-name'>Email</label>
                            </div>
                            
                            <div class=\"col-sm-3\">
                                <input type=\"text\" class=\"form-control\" name='provider-email' placeholder='Nhập email.....'>
                            </div>
                            <div class='col-sm-2 label'>
                                <label for='provider-name'>SDT</label>
                            </div>
                            
                            <div class=\"col-sm-3\">
                                <input type=\"text\" class=\"form-control\" name='provider-phone' placeholder='Nhập sdt....'>
                            </div>          
                             <div class=\"col-sm-2\">
                                <button class=\"btn btn-warning float-right\" name='search-sm' value='search' title='Tìm'><i class='fa fa-search'></i></button>
                            </div>         
                        </div>  
                       
                        <input type=\"hidden\" name='mode' value='provider'>
                        <input type=\"hidden\" name='ac' value='search'>
                    </form>
                </div>           
            </div>";   
    }
    else if($mode == 'product'){
        $cats_ad = new Category();
        $arr1 = $cats_ad->getAll();
        // var_dump($arr1);
        $cats_dropdown = ''; $prors_dropdown = '';
        foreach ($arr1 as $v) {
            $cats_dropdown .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>";
        }

        $prors_ad = new Provider();
        $arr2 = $prors_ad->getAll();        
        // var_dump($arr2);
         foreach ($arr2 as $v) {
            $prors_dropdown .= "<option value='{$v['provider_id']}'>{$v['provider_name']}</option>";
        }
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
        <h2 style='text-align:center; margin:15px 0 15px 0;'>Tìm kiếm sản phẩm</h3>
        <div class='form-group'>
            <form action='index.php' method='get'>
                <div class='row element'>
                    <div class='col-sm-2 label'>
                        <label for='cat-name'>Tên sản phẩm</label>
                    </div>                
                    <div class=\"col-sm-4\">
                        <input type=\"text\" class=\"form-control\" name='key' placeholder='Nhập tên sản phẩm'>
                    </div>                    
                    <div class='col-sm-2 label'>
                        <label for='cat-name'>Giá sản phẩm từ</label>
                    </div>                
                    <div class=\"col-sm-2\">
                        <input type=\"text\" class=\"form-control\" name='from-price' placeholder='Từ giá'>
                    </div>                     
                    <div class=\"col-sm-2\">
                        <input type=\"text\" class=\"form-control\" name='to-price' placeholder='Đến giá'>
                    </div>                            
                </div>
                   
                <div class='row element'>                    
                     <div class='col-sm-2 label'>
                        <label for='from-date'>Từ ngày</label>
                    </div>                
                    <div class=\"col-sm-4\">
                        <input type=\"date\" class=\"form-control\" name='from-date'>
                    </div>              
                    
                    <div class='col-sm-2 label'>
                        <label for='to-date'>Đến ngày</label>
                    </div>                
                    <div class=\"col-sm-4\">
                        <input type=\"date\" class=\"form-control\" name='to-date'>
                    </div>               
                </div>

                <div class='row element'>
                    <div class='col-sm-2 label'>
                        <label for='provider-id'>Danh mục</label>
                    </div>                
                    <div class=\"col-sm-2\">
                        <select class=\"form-control\" name='cat-id'>
                            <option value='all'>ALL</option>
                            ".$cats_dropdown."
                        </select>
                    </div>  

                    <div class='col-sm-2 label'>
                        <label for='cat-id'>Nhà cung cấp</label>
                    </div>                
                    <div class=\"col-sm-2\">
                        <select class=\"form-control\" name='provider-id'>
                            <option value='all'>ALL</option>
                            ".$prors_dropdown."
                        </select>
                    </div>  
                    <div class='col-sm-2 label'>
                        <label for='product-id'>Mã sản phẩm</label>
                    </div>
                    <div class='col-sm-1'>
                        <input type=\"text\" class=\"form-control\" name='product-id' placeholder='Mã'>
                    </div>
                    <div class=\"col-sm-1\">
                        <button class=\"btn btn-warning float-right\" name='search-sm' value='search' title='Tìm'><i class='fa fa-search'></i></button>
                    </div>
                </div>
               
                <input type=\"hidden\" name='mode' value='product'>
                <input type=\"hidden\" name='ac' value='search'>                
            </form>
        </div>           
    </div>";   
    }
    else if($mode == 'order'){
        $ac = getIndex('ac');
        if($ac != 'revenue'){
            echo " <div class='col-sm-12 check-order' style='background-color:lavender;'>   
                    <h2 style='text-align:center; margin:15px 0 15px 0;'>Tìm kiếm đơn hàng</h3>
                    <div class='form-group'>
                        <form action='index.php' method='get'>
                        <div class='row element'>
                             <div class='col-sm-2 label'>
                                <label for='order-id'>Mã đơn hàng </label> 
                            </div>
                            
                            <div class='col-sm-3'>
                                <input type='text' class='form-control' name='order-id' placeholder='Nhập mã đơn hàng.....'>
                            </div>
                             <div class='col-sm-2 label'>
                                <label for='order-status'>Trạng thái </label>
                            </div>
                            
                            <div class='col-sm-3'>
                                <select class='form-control' name='order-status'>
                                    <option value='all'>Tất cả</option>
                                    <option value='0'>Chưa thanh toán</option>
                                    <option value='1'>Đã thanh toán</option>
                                </select>                                
                            </div>
                        </div>
                        <div class='row element'>
                             <div class='col-sm-2 label'>
                                <label for='consignee-name'>Tên người nhận </label> 
                            </div>                            
                            <div class='col-sm-3'>
                                <input type='text' class='form-control' name='consignee-name' placeholder='Nhập tên người nhận.....'>
                            </div>
                             <div class='col-sm-2 label'>
                                <label for='consignee-phone'>SDT người nhận </label>
                            </div>
                            
                            <div class='col-sm-3'>                                
                                <input type='text' class='form-control' name='consignee-phone' placeholder='Nhập SDT người nhận.....'>
                            </div>
                        </div>
                        <div class='row element'>
                            <div class='col-sm-2 label'>
                                <label for='from-date'>Từ ngày (</label> )
                            </div>
                            
                            <div class='col-sm-3'>
                                <input type='date' class='form-control' name='from-date' id='from-date'>
                            </div>
                            <div class='col-sm-2 label'>
                                <label for='to-date'>Đến ngày (</label> )
                            </div>
                            
                            <div class='col-sm-3'>
                            <input type='date' class='form-control' name='to-date' id='to-date'>
                            </div>
                            
                            <div class='col-sm-2'>
                            <button class='btn btn-warning float-right' name='search-sm' value='search-order' title='Tìm kiếm'><i class='fa fa-search'></i></button>
                            </div>
                        </div>
                            <input type='hidden' name='ac' value='search'>
                            <input type='hidden' name='mode' value='order'>
                        </form>
                    </div>           
                </div>
                <!--script>
                    Date.prototype.toDateInputValue = (function() {
                        var local = new Date(this);
                        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                        return local.toJSON().slice(0,10);
                    });
                    document.getElementById('to-date').value = new Date().toDateInputValue();
                    document.getElementById('from-date').value = new Date().toDateInputValue();
                </script!-->";
            }
            //Dành cho phần tìm kiếm của thống kê doanh thu
            else{
                echo " <div class='col-sm-12 check-order' style='background-color:lavender;'>   
                    <h2 style='text-align:center; margin:15px 0 15px 0;'>Doanh thu trong khoảng</h3>
                    <div class='form-group'>
                        <form action='index.php' method='get'>
                            <div class='col-sm-2 label'>
                                <label for='from-date'>Từ ngày (</label> )
                            </div>
                            
                            <div class='col-sm-3'>
                                <input type='date' class='form-control' name='from-date' id='from-date'>
                            </div>
                            <div class='col-sm-2 label'>
                                <label for='to-date'>Đến ngày (</label> )
                            </div>
                            
                            <div class='col-sm-3'>
                            <input type='date' class='form-control' name='to-date' id='to-date'>
                            </div>
                            
                            <div class='col-sm-2'>
                            <button class='btn btn-warning' name='search-sm' value='search-order' title='Tìm kiếm'><i class='fa fa-search'></i></button>
                            </div>
                            <input type='hidden' name='ac' value='revenue'>
                            <input type='hidden' name='mode' value='order'>
                        </form>
                    </div>           
                </div>
                <script>
                    Date.prototype.toDateInputValue = (function() {
                        var local = new Date(this);
                        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                        return local.toJSON().slice(0,10);
                    });
                    document.getElementById('to-date').value = new Date().toDateInputValue();
                    document.getElementById('from-date').value = new Date().toDateInputValue();
                </script>";
            }
    }
    else if($mode == 'user'){
        echo "<div class='col-sm-12 check-order' style='background-color:lavender;'>   
        <h2 style='text-align:center; margin:15px 0 15px 0;'>Tìm kiếm User</h3>
        <div class='form-group'>
            <form action='index.php' method='get'>
                <div class='row element'>
                    <div class='col-sm-2 label'>
                        <label for='user-id'>Tài khoản</label>
                    </div>                    
                    <div class=\"col-sm-3\">
                        <input type=\"text\" class=\"form-control\" name='key' placeholder='Nhập tài khoản cần tìm....'>
                    </div>
                    <div class='col-sm-2 label'>
                        <label for='user-name'>Họ tên</label>
                    </div>                    
                    <div class=\"col-sm-3\">
                        <input type=\"text\" class=\"form-control\" name='user-name' placeholder='Nhập họ tên.....'>
                    </div>                   
                </div>
                <div class='row element'>
                    <div class='col-sm-2 label'>
                        <label for='user-email'>Email</label>
                    </div>                    
                    <div class=\"col-sm-3\">
                        <input type=\"text\" class=\"form-control\" name='user-email' placeholder='Nhập Email cần tìm....'>
                    </div>
                    <div class='col-sm-2 label'>
                        <label for='user-phone'>SDT</label>
                    </div>                    
                    <div class=\"col-sm-3\">
                        <input type=\"text\" class=\"form-control\" name='user-phone' placeholder='Nhập SDT cần tìm.....'>
                    </div>

                    <div class=\"col-sm-2\">
                    <button class=\"btn btn-warning\" name='search-sm' value='search' title='Tìm'><i class='fa fa-search'></i></button>
                    </div>
                </div>
                <input type=\"hidden\" name='mode' value='user'>
                <input type=\"hidden\" name='ac' value='search'>
            </form>
        </div>           
    </div>";   
    }
 ?>