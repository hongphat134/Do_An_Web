<?php
	

	if(isset($_POST['forgot-sm'])){
		$email = isset($_POST['email'])?$_POST['email']:'';
		//echo $email;
		//Kiểm tra email này của tài khoản nào? Nếu ko tồn tại tài khoản nào thì sao?
		$result = $users_clt->getUserByEmail($email);
		if($result == '') echo "<script>alert('Email Không tồn tại!');window.location = 'subpage/login.php'</script>";
		else{ 
			//sử dụng để load thư viện 
			include ROOT."/lib/PHPMailer/PHPMailerAutoload.php";
			$message = "Chúng tôi đã nhận được yêu cầu lấy lại mật khẩu từ <strong>bạn</strong>";	

			$mail = new PHPMailer();
			$mail->IsSMTP(); // set mailer to use SMTP
			$mail->Host = "smtp.gmail.com"; // specify main and backup server
			$mail->Port = 465; // set the port to use
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->SMTPSecure = 'ssl';
			$mail->Username = "hongphat701@gmail.com"; //Địa chỉ gmail sử dụng để gửi email
			$mail->Password = "Lw653803"; // your SMTP password or your gmail password
			$from = "hongphat701@gmail.com"; // Khi người sử dụng bấm reply sẽ gửi đến email này
			$to=$result["user_email"]; // Email người nhận (email thực)
			$name="Hi, Mr.!"; // Tên người nhận
			$mail->From = $from;
			$mail->FromName = "Computer store HTP"; // Tên người gửi 
			$mail->AddAddress($to,$name);
			$mail->AddReplyTo($from,"CSKH");
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = "Letter from Computer store HTP!";
			$mail->Body = "<p><b>Thông báo</b></p>". $message ."<hr> Mời bạn nhấp vào link này để thực hiện việc đổi mật khẩu <a href='".BASE_URL."/abcdef.php?a={$result['user_id']}&b={$result['user_name']}&c={$result['user_pwd']}&d={$result['user_email']}&e={$result['user_phone']}&f={$result['user_address']}'>Đổi mật khẩu</a>";
			$mail->SMTPDebug = 0;//Hiện debug lỗi. Mặc định sẽ tắt lỗi này . thường set = 2 để xem lỗi
			if(!$mail->Send())
			{
				echo "<script>alert('<h3>Err: " . $mail->ErrorInfo . "</h3>');</script>";
			}
			else
			{
				echo "<script>alert('<h3>Send mail thành công</h3>');</script>";
			}
			echo "<script>alert('Đã gửi thư đến email của bạn! bạn hãy kiểm tra email để hoàn thành tác vụ này!')</script>";
		}
	}
	
?>