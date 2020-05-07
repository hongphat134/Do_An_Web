<?php 
    //Ajax này xử lý cho cart menu
    include "config/config.php";
	include ROOT."/include/function.php";
	spl_autoload_register("loadClass");
    if(!isset($_SESSION)) session_start();
    $ac = $_GET['ac'];
    $ma = $_GET['ma'];
    if($ac == 'insert'){
        $ten = $_GET['ten'];
        $gia = $_GET['gia'];
        $hinh = $_GET['hinh'];
        $loaisp = $_GET['loai'];
        $soluong = isset($_GET['soluong'])?$_GET['soluong']:1;

      //Kiểm tra xem còn hàng ko?
        $products_clt = new Product();
        $product = $products_clt->searchById($ma);
        if(isset($_SESSION['shopping-cart'][$ma])){
          
                       
            if($product[0]['product_quantity'] <= $_SESSION['shopping-cart'][$ma]['quantity']) echo "<script>alert('Hết hàng rồi')</script>";
            else $_SESSION['shopping-cart'][$ma]['quantity'] += $soluong; 
        }
        else{
              if($product[0]['product_quantity'] < $soluong) echo "<script>alert('Hết hàng rồi')</script>";
            else {
                $_SESSION['shopping-cart'][$ma]['cat_name'] = $loaisp;
                $_SESSION['shopping-cart'][$ma]['name'] = $ten;
                $_SESSION['shopping-cart'][$ma]['price'] = $gia;
                $_SESSION['shopping-cart'][$ma]['image'] = $hinh;  
                $_SESSION['shopping-cart'][$ma]['quantity'] = $soluong; 
            }
        }
    }
    else if($ac == 'remove'){
        if(isset($_SESSION['shopping-cart'][$ma])){
            unset($_SESSION['shopping-cart'][$ma]); 
            if(count($_SESSION['shopping-cart']) == 0) unset($_SESSION['shopping-cart']);
        }
    }
    else if($ac == 'update'){
        $soluong = $_GET['soluong'];
        if(isset($_SESSION['shopping-cart'][$ma])){
            $products_clt = new Product();
            $product = $products_clt->searchById($ma);
                       
            if($product[0]['product_quantity'] < $soluong) echo "<script>alert('Tồn kho không đủ')</script>";
            else $_SESSION['shopping-cart'][$ma]['quantity'] = $soluong; 
        }
    }
    if(isset($_SESSION['shopping-cart'])){
        $count = 0;
        $total = 0;
        $str = '';
        foreach ($_SESSION['shopping-cart'] as $key => $value) {                                    
            $str .= "<div class='product-widget'>
                        <div class='product-img'>
                            <img src='./image/{$value['image']}' alt=''>
                        </div>
                        <div class='product-body'>
                            <h3 class='product-name'><a href='#'>{$value['name']}</a></h3>
                            <h4 class='product-price'><span class='qty'>{$value['quantity']}x</span>".number_format($value['price'],0,'',',')."<sup>đ</sup></h4>
                        </div>
                        <button class='delete' onClick=\"RemoveProductToCart('$key')\"><i class='fa fa-close'></i></button>
                    </div>";
            $count += $value['quantity'];
            $total += $value['quantity']*$value['price'];
        }       
    }

    echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"true\">
                <i class=\"fa fa-shopping-cart\"></i>
                <span>Giỏ hàng</span>
                <div class=\"qty cart\">".(isset($_SESSION['shopping-cart'])?$count:0)."</div>
            </a>
            <div class=\"cart-dropdown\">
                <div class=\"cart-list\">                            
                    ".(isset($str)?$str:'')."                                                                                     
                </div>
                <div class=\"cart-summary\">
                    <small>".(isset($_SESSION['shopping-cart'])?$count:0)." sản phẩm đã chọn</small>
                    <h5>tổng tiền:".(isset($total)?number_format($total,0,'',','):0.)." đ</h5>
                </div>
                <div class=\"cart-btns\">
                    <a href=\"../cart.php\">Xem giỏ hàng</a>
                    <a href=\"checkout.php\">Thanh toán <i class=\"fa fa-arrow-circle-right\"></i></a>
                </div>
            </div>";
?>
