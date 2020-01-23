<?php
    //echo 'Change user';
    $sm = postIndex('changeinfo-sm');
    $user_id = isset($_SESSION['user'])?$_SESSION['user']['user_id']:'';
    if($sm == 'change-user'){
        $name = postIndex('name');
        $address = postIndex('address');
        $phone = postIndex('phone');
        $email = postIndex('email');
        
        if($email == '' || $phone == ''){
            echo "<script>
                alert('Không để trống mục Phone và Email vì sự bảo mật!');
                location.href = './change-user.php';
            </script>";   
            exit;
        }
        $kq = $users_clt->edit($user_id,$name,$address,$email,$phone);
        
        if($kq > 0){
            if($kq == 1){
                $_SESSION['user']['user_name'] = $name;
                $_SESSION['user']['user_phone'] = $phone;
                $_SESSION['user']['user_address'] = $address;
                $_SESSION['user']['user_email'] = $email;        
            }
            echo "<script>
                alert('Cập nhật thành công');
                location.href = './change-user.php';
            </script>";
            exit;
        }      
        else{
            echo "<script>
                alert('Cập nhật thất bại do $kq');
                location.href = './change-user.php';
            </script>";  
            exit;  
        }      
    }
    else{
        $type = postIndex('type');
        $old_pwd = postIndex('old-pwd');
        $encode_old_pwd = $users_clt->encrypt($old_pwd);
        $new_pwd = postIndex('new-pwd');
        if($old_pwd == ''){
            echo "<script> alert('Không để rỗng mật khẩu cũ!');
                  location.href = './change-user.php';</script>";
            exit;
        } 
        if($new_pwd == ''){
            echo "<script> alert('Không để rỗng mật khẩu mới!');
                  location.href = './change-user.php';</script>";
            exit;
        } 
        $arr_users = $users_clt->getAll();
        
        if($type == ''){
            if($old_pwd != ''){
                foreach ($arr_users as $value) {
                    if($value['user_id'] == $user_id && $value['user_pwd'] == $encode_old_pwd){
                        //Thực hiện việc thay đổi
                        $users_clt->edit_pwd($user_id,$new_pwd);
                        echo "<script>        
                                location.href = '../index.php';
                                alert('Đổi mật khẩu thành công');
                            </script>"; 
                        exit;
                    }
                }
            }
            echo "<script>alert('mật khẩu cũ nhập sai');</script>";
        }
        else if(strcasecmp($type,'forgot') == 0){
               $users_clt->edit_pwd($user_id,$new_pwd);
               echo "<script>        
                        location.href = '../index.php';
                        alert('Đổi mật khẩu thành công');
                    </script>"; 
                exit;
        }        
    }

?>