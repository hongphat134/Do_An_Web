<?php 
	//echo "this is sign up";

	$sm = postIndex('signup-sm');
	if($sm != ''){

		//echo "Okay";
		$user = postIndex('user');
		$pwd = postIndex('pwd');
		$email = postIndex('email');
		$phone = postIndex('phone');
		if($user == '' || $pwd == '' || $email == '' || $phone == ''){
			echo "<script>alert('Vui lòng điền thông tin đầy đủ để đăng ký!'); window.location.href='subpage/login.php?user-rg=$user&email-rg=$email&phone-rg=$phone'</script>";
			exit;
		}
		$result = $users_clt->insert($user,$pwd,$email,$phone);
		//setcookie('user_email',$email,time()+3600); 
		if($result > 0){
			$_SESSION['user']['user_id'] =  $user;
			$_SESSION['user']['user_pwd'] =  $pwd;
			$_SESSION['user']['user_email'] =  $email;
			$_SESSION['user']['user_phone'] =  $phone;
			$_SESSION['user']['user_name'] =  '';
			$_SESSION['user']['user_address'] =  '';
			echo "<script>location.href ='index.php'</script>";
		}
		else if($result == -1) echo "<script>alert('Email này đã được sử dụng!');window.location.href='subpage/login.php?user-rg=$user&phone-rg=$phone';</script>";
		else if($result == -2) echo "<script>alert('tài khoản này đã tồn tại!');window.location.href='subpage/login.php?email-rg=$email&phone-rg=$phone'</script>";
		else if($result == -3) echo "<script>alert('số điện thoại này đã tồn tại!');window.location.href='subpage/login.php?user-rg=$user&email-rg=$email';</script>";
		exit;
	}
 ?>