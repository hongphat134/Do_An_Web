<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="../img/favicon.png">
	 <link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>  -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<script src="../js/bootstrap.min.js"></script>
	<title>Login</title>
</head>
<body>
	<style>
		body{
			background-color: black;
		}
		#box1,#box2,#box3{  
		border: 1px solid rgb(200, 200, 200);   
		box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 5px 2px; 
		background: rgba(200, 200, 200, 0.1);   
		border-radius: 4px; top:50px;
		}
		 
		h2 {    
		text-align:center;  
		color:#fff;
		}

		#form-signup:hover,#form-signin:hover,#form-forgot:hover{
			cursor: pointer;
		}
		#box2,#box3{
			display: none;
		}
	</style>
	<div class="container-fluid"> 
		 <div class="row-fluid"> 

		 <!-- FORM SIGN IN -->
		  <div class="col-md-offset-4 col-md-4" id="box1"> 
		   <h2>Thành viên</h2> 
		   <hr> 
		   <form class="form-horizontal" action="../index.php?mode=user&ac=sign_in" method="post"> 
		    <fieldset> 
		     <div class="form-group"> 
			      <div class="col-md-12"> 
			       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> <input name="user" placeholder="Username" class="form-control" type="text" value="<?php echo isset($_GET['user'])?$_GET['user']:''; ?>" > 
			       </div> 
			      </div> 
			  </div> 
		     <div class="form-group"> 
			      <div class="col-md-12"> 
			       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> <input name="pwd" placeholder="Password" class="form-control" type="Password"> 
			       </div> 
			      </div> 
		     </div> 
		     <div class="form-group"> 
			      <div class="col-md-12"> 		
			      	<div><a><i id='form-signup'>Bạn chưa có tài khoản?</i></a></div>
			      	<div><a><i id='form-forgot'>Bạn quên mật khẩu?</i></a></div>
			       <button type="submit" class="btn btn-md btn-danger pull-right" name="signin-sm" value="SignIn">Đăng nhập </button> 
			      </div> 
		     </div> 
		    </fieldset> 
		   </form> 
		  </div> 


			<!-- FORM SIGN UP  -->
		  <div class="col-md-offset-4 col-md-4" id="box2"> 
		   <h2>Thành viên</h2> 
		   <hr> 
		   <form class="form-horizontal" action="../index.php?mode=user&ac=sign_up" method="post" > 
		    <fieldset> 
		     <div class="form-group"> 
			      <div class="col-md-12"> 
			       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> <input name="user" placeholder="Username" class="form-control" type="text" value="<?php echo isset($_GET['user-rg'])?$_GET['user-rg']:''; ?>"> 
			       </div> 
			      </div> 
			  </div> 
		     <div class="form-group"> 
			      <div class="col-md-12"> 
			       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> <input name="pwd" placeholder="Password" class="form-control" type="Password" > 
			       </div> 
			      </div> 
		     </div> 
		       <div class="form-group"> 
			      <div class="col-md-12"> 
			       <div class="input-group"> <span class="input-group-addon"><i class="gglyphicon glyphicon-envelope"></i></span> <input name="email" placeholder="Email" class="form-control" type="email" value="<?php echo isset($_GET['email-rg'])?$_GET['email-rg']:''; ?>"> 
			       </div> 
			      </div> 
		     </div> 
		       <div class="form-group"> 
			      <div class="col-md-12"> 
			       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span> <input name="phone" pattern="[0-9]{9,11}" placeholder="Phone" class="form-control" type="text" value="<?php echo isset($_GET['phone-rg'])?$_GET['phone-rg']:''; ?>"> 
			       </div> 
			      </div> 
		     </div> 
		     <div class="form-group"> 
			      <div class="col-md-12"> 	
			      <div><a><i id="form-signin">Bạn có tài khoản rồi?</i></a></div>
			       <button type="submit" class="btn btn-md btn-danger pull-right" name="signup-sm" value="SignUp">Đăng ký </button> 
			      </div> 
		     </div> 
		    </fieldset> 
		   </form> 
		  </div> 
		 </div>

		 <!-- FORM FORGOT -->
		   <div class="col-md-offset-4 col-md-4" id="box3"> 
		   <h2>Thành viên</h2> 
		   <hr> 
		   <form class="form-horizontal" action="../index.php?mode=user&ac=forgot" method="post" > 
		    <fieldset> 
		       <div class="form-group"> 
			      <div class="col-md-12"> 
			       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> <input name="email" placeholder="Nhập email" class="form-control" type="email"> 
			       </div> 			       
			      </div> 
		     </div> 
		     <div class="form-group"> 
			      <div class="col-md-12"> 	
			      <div><a><i id="form-signin">Bạn có tài khoản rồi?</i></a></div>
			       <button type="submit" class="btn btn-md btn-danger pull-right" name="forgot-sm" value="Forgot">Xác nhận </button> 
			      </div> 
		     </div> 
		    </fieldset> 
		   </form> 
		  </div> 
		 </div>

	</div>	
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.min.js"></script> 
	<script type="text/javascript">
		$("#form-signup").click(function(){
			$('#box1').css({
				display:'none'
			});
			$('#box3').css({
				display:'none'
			});
			$('#box2').css({
				display:'block'
			});
			
		});

		$("#form-signin").click(function(){	
			$('#box2').css({
				display:'none'
			});
			$('#box3').css({
				display:'none'
			});
			$('#box1').css({
				display:'block'
			});
		});
		$("#form-forgot").click(function(){
			$('#box1').css({
				display:'none'
			});
			$('#box2').css({
				display:'none'
			});
			$('#box3').css({
				display:'block'
			});
		});
	</script>
	<?php
		if(isset($_GET['user-rg']) || isset($_GET['email-rg']) || isset($_GET['phone-rg'])) {
			echo "<script>
						$('#box1,#box3').css({display:'none'});
						$('#box2').css({display:'block'});
				</script>";
		}
	?>
</body>
</html>