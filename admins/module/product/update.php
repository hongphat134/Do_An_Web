<?php
    if(isset($_POST['update-sm'])){
        $page = getIndex('page',1);
        $product_id = getIndex('product_id');
        $product_name = postIndex('product_name');
        $product_price = postIndex('product_price');
        //$product_img = postIndex('product_img');
        //$product_date = postIndex('product_date');
        $product_quantity = postIndex('product_quantity');
        $product_description = postIndex('product_description');
        $product_detail = postIndex('product_detail');
        $cat_id = postIndex('cat_id');
        $provider_id = postIndex('provider_id');
        
        $product_img = fileIndex('product_img');
        //này là link hình cũ thôi
        $old_img = getIndex('old_img');
        
        // echo ROOT."/image/$old_img";
        echo "$page -  $product_id -  $product_name - $product_quantity - $product_price";
        var_dump($product_img);
        if(!is_numeric($product_price)) $kq = 'Giá phải là số!';
        else if($product_id == '') $kq ='Lỗi mã sản phẩm không tồn tại!';
        else if($product_name == '') $kq = 'Không để trống tên sản phẩm!';
        else{
            $kq = 'Sửa thất bại';                      

            if($product_img['name'] != ''){            
                $arrImg = array("image/png", "image/jpeg", "image/bmp");
                $errFile = $product_img["error"];
                $err = '';         
                echo $errFile;                       
                if ($errFile>0)
                    $err .= 'Lỗi hình</br>';
                else
                {
                    $type = $product_img["type"];
                    if (!in_array($type, $arrImg))
                        $err .= 'Lỗi định dạng</br>';
                    else
                    {    
                     $temp = $product_img["tmp_name"];
                     $name = $product_img["name"];
                     if (!move_uploaded_file($temp, ROOT."/image/".$name))
                         $err .= 'Lỗi copy file</br>';               
                    }
                }                
                        
                if($err == ''){
                                           
                    $kq = $products_ad->update($product_id,addslashes($product_name),$product_price,$product_img["name"],$product_quantity,$product_description,$product_detail,$cat_id,$provider_id);                    
                    if($kq == 1){ 
                        $kq = 'Sửa thành công';
                        unlink(ROOT."/image/$old_img");                       
                    }
                    else  $kq = 'Sửa thất bại';    
                }                        
                else $kq = 'Đã gặp sự cố ở hình';
            }
            else{ 
                $kq = $products_ad->update($product_id,addslashes($product_name),$product_price,'',$product_quantity,$product_description,$product_detail,$cat_id,$provider_id);
                if($kq == 1) $kq = 'Sửa thành công';                                        
                else  $kq = 'Sửa thất bại';   
            }
        }    
    }    
    echo "<script>location.href = 'index.php?mode=$mode&rs=$kq&page=$page'</script>"
?>