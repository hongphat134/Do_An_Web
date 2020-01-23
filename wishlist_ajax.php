<?php 
    include "config/config.php";
	include ROOT."/include/function.php";
	spl_autoload_register("loadClass");
    if(!isset($_SESSION)) session_start();
    $ac = $_GET['ac'];
    $ma = $_GET['ma'];
    if($ac == 'insert'){
        $ten = $_GET['ten'];
        $hinh = $_GET['hinh'];
        
        if(!isset($_SESSION['wishlist'][$ma])){
            $_SESSION['wishlist'][$ma]['name'] = $ten;
            $_SESSION['wishlist'][$ma]['image'] = $hinh;  

            echo "<div class=\"product-wishlist\">
                    <div class=\"product-wishlist-img\">
                        <img src=\"../image/$hinh\" alt=\"\">
                    </div>
                    <div class=\"product-wishlist-name\">$ten</div>
                </div>";
        }
    }
?>
