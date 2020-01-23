<?php 
	$sm = postIndex('signin-sm');
	if($sm != ''){
		$user = postIndex('user','');
		$pwd = $users_clt->encrypt(postIndex('pwd',''));
		if($user == ''){
			echo "<script>
				alert('Không để trống tài khoản và mật khẩu!');				
				location.href = 'subpage/login.php';
			</script>";
			exit;
		}
		$arrUsers = $users_clt->getAll();
		foreach ($arrUsers as $value) {
			if($user == $value['user_id'] && $pwd == $value['user_pwd'])
			{
				$_SESSION['user'] = $value;					
				echo "<script>location.href = 'index.php'</script>"; 
				exit;
			}
		}
		echo "<script>
				alert('Sai thông tin tài khoản!');				
				location.href = 'subpage/login.php?user=$user';
			</script>";
		exit;
	}
 ?>