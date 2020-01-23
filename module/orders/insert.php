<?php 
 if(isset($_GET['order-sm'])){
	if(isset($_SESSION['user'])){		
		//Kiểm tra lại 1 lần nữa về số lượng sản phẩm tồn kho
		$products_clt = new Product();
		$arr_check_quantity = $products_clt->checkOrder($_SESSION['shopping-cart']);
		var_dump($arr_check_quantity);
		if(count($arr_check_quantity) != 0){
			$err = '';
			foreach ($arr_check_quantity as  $value) {
				$err .= 'Sản phẩm: '.$_SESSION['shopping-cart'][$value]['name'].' ko đủ hàng đáp ứng</br>';
				unset($_SESSION['shopping-cart'][$value]);
			}
			echo "<script>alert($err".$err.'Mong quý khách thông cảm!'."); window.location.href='store.php'</script>";
			exit;
		}

		
		$username = $_SESSION['user']['user_id'];
		$date = date('Y-m-d');
		$payment = getIndex('payment');
		$name = getIndex('name');
		$tel = getIndex('tel');
		$address = getIndex('address');
		$status = $payment == 'cast'?0:1;

		//form validate tạm thời cho checkout
		if($name == '' || $tel == '' || $address == '')
		{
			echo "<script>alert('Vui lòng điền đầy đủ thông tin nhận hàng'); window.location.href='checkout.php'</script>";
			exit;

		}


		$kq = $orders_clt->insert($username,$date,addslashes($name),addslashes($tel),addslashes($address),$status);
		if($kq == 1){
			$arr_orders = $orders_clt->getAll();								
			$obj = $arr_orders[count($arr_orders) - 1];
			$madh_cantim = $obj['order_id'];
			//var_dump($obj); echo $macantim;

			//Tiếp tục bước thêm cthd
			//$key là mã sản phẩm
			//trạng thái chưa thanh toán thì ko trừ số lượng sản phẩm
			// if($status == 0){
			// 	foreach ($_SESSION['shopping-cart'] as $key => $value) {
			// 		$kq = $orders_clt->insertOrderDetail($madh_cantim,$key,$value['quantity']);
			// 	}
			// }
			// else{
				foreach ($_SESSION['shopping-cart'] as $key => $value) {
					$kq = $orders_clt->insertOrderDetail($madh_cantim,$key,$value['quantity']);
					$rs = $products_clt->ExportFromOrder($key,$value['quantity']);
				}	
			//}
			echo "<script>alert('Thanh toán thành công');window.location.href='result.php?payment=$payment&name=$name&tel=$tel&address=$address&order-sm=order'</script>";
			exit;
		}
		else{
			echo "<script>alert('Quá trình đặt hàng đã xảy ra sự cố! Mong quý khách thông cảm thực hiện lại việc đặt hàng!'); window.location.href = 'store.php'</script>"; exit;
		}
	}			
	else{ echo "<script>alert('Vui lòng đăng nhập để chúng tôi có thể phục vụ bạn tốt nhất!'); window.location.href = 'store.php'</script>"; exit;}
}
else { echo "<script>alert('Lỗi trang!'); window.location.href = 'store.php'</script>"; exit;}
	
 ?>