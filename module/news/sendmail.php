
<?php
	//sử dụng để load thư viện 
	include ROOT."/lib/PHPMailer/PHPMailerAutoload.php";
	$message = "<p>Giảm giá <b>cực sốc</b> trong mùa No-el</p>
				<p>Rất hân hạnh đươc đón tiếp quý khách</p>";	

	$mail = new PHPMailer();
	$mail->IsSMTP(); // set mailer to use SMTP
	$mail->Host = "smtp.gmail.com"; // specify main and backup server
	$mail->Port = 465; // set the port to use
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->SMTPSecure = 'ssl';
	$mail->Username = "hongphat701@gmail.com"; //Địa chỉ gmail sử dụng để gửi email
	$mail->Password = "Lw653803"; // your SMTP password or your gmail password
	$from = "hongphat701@gmail.com"; // Khi người sử dụng bấm reply sẽ gửi đến email này
	$to=$_REQUEST["email"]; // Email người nhận (email thực)
	$name="Hi, Mr.!"; // Tên người nhận
	$mail->From = $from;
	$mail->FromName = "Computer store HTP"; // Tên người gửi 
	$mail->AddAddress($to,$name);
	$mail->AddReplyTo($from,"CSKH");
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML(true); // send as HTML
	$mail->Subject = "Newsletter!";
	$mail->Body = "<p><b>Khuyến mãi</b></p>". $message ."<hr> Chi tiết xem tại: <a href='". BASE_URL."'>".BASE_URL."</a>";
	//$mail->Body = "Khuyến mãi .". $_REQUEST["message"] ."<hr> Chi tiết xem tại: <a href='". BASE_URL."'>".BASE_URL."</a>";
	$mail->SMTPDebug = 0;//Hiện debug lỗi. Mặc định sẽ tắt lỗi này . thường set = 2 để xem lỗi
	if(!$mail->Send())
	{
		echo "<script>alert('<h3>Err: " . $mail->ErrorInfo . "</h3>');</script>";
	}
	else
	{
		echo "<script>alert('<h3>Send mail thành công</h3>');</script>";
	}
?>
