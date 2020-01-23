<?php
	if(isset($_GET['contact-sm'])){
		$email = isset($_GET['email'])?$_GET['email']:'';
		$content = isset($_GET['opinition'])?$_GET['opinition']:'';
		//echo $email;
		//Kiểm tra email này của tài khoản nào? Nếu ko tồn tại tài khoản nào thì sao?
		//sử dụng để load thư viện 
		if($email != '' && $content != ''){
			include ROOT."/lib/PHPMailer/PHPMailerAutoload.php";
			$message = "<p>Chúng tôi đã nhận được thông tin liên hệ từ <strong>bạn</strong> có nội dung là:</p><strong>".$content."</strong>";	

			$mail = new PHPMailer();
			$mail->IsSMTP(); // set mailer to use SMTP
			$mail->Host = "smtp.gmail.com"; // specify main and backup server
			$mail->Port = 465; // set the port to use
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->SMTPSecure = 'ssl';
			$mail->Username = "hongphat701@gmail.com"; //Địa chỉ gmail sử dụng để gửi email
			$mail->Password = "Lw653803"; // your SMTP password or your gmail password
			$from = "hongphat701@gmail.com"; // Khi người sử dụng bấm reply sẽ gửi đến email này
			$to=$email; // Email người nhận (email thực)
			$name="Hi, Mr.!"; // Tên người nhận
			$mail->From = $from;
			$mail->FromName = "Computer store HTP"; // Tên người gửi 
			$mail->AddAddress($to,$name);
			$mail->AddReplyTo($from,"CSKH");
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = "Letter from Computer store HTP!";
			$mail->Body = "<p><b>Thông báo</b></p>". $message ."<hr>Hãy xác lại đây là thông tin được gửi từ bạn bằng cách trả lời!";
			$mail->SMTPDebug = 0;//Hiện debug lỗi. Mặc định sẽ tắt lỗi này . thường set = 2 để xem lỗi
			if(!$mail->Send())
			{
				echo "<script>alert('<h3>Err: " . $mail->ErrorInfo . "</h3>');</script>";
			}
			else
			{
				echo "<script>alert('<h3>Đã gửi Mail! Bạn hãy vào email để xác nhận để chúng tôi phục vụ bạn 1 cách tốt nhất!</h3>');</script>";
			}
		}
		else echo "<script>alert('Hãy điền email và nội dung để chúng tôi hỗ trợ bạn tốt nhất!');window.location = '".BASE_URL."/contact.php'</script>";
	}
?>