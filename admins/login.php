<?php
	if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Administrator</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glassy Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<link rel="shortcut icon" href="../img/favicon.png">
<!-- css files -->
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<!-- //css files -->
<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body>
	 <?php
        include "../config/config.php";
        include ROOT."/include/function.php";
        spl_autoload_register("loadClass");
       

       if(isset($_SESSION['admin'])) {
		    echo "<script>location.href = 'index.php'</script>"; exit;
       }
        $ads = new Admin();
        $arr = $ads->getAll();
        //$user = isset($_GET['user'])?$_GET['user']:'';
        $user = getIndex('user');
        //$pwd = isset($_GET['pwd'])?$_GET['pwd']:'';
        $pwd = getIndex('pwd');

        if($user!='' && $pwd!=''){
            foreach ($arr as $value) {
                if($value['ad_user']==$user && $value['ad_pwd']==$pwd){
					$_SESSION['admin'] = $value;
                    echo "<script>location.href = 'index.php'</script>"; exit;
                }
            }      
        }
    ?>
		<!--header-->
		<div class="header-w3l">
			<h1>Administrator</h1>
		</div>
		<!--//header-->
		<!--main-->
		<div class="main-w3layouts-agileinfo">
	           <!--form-stars-here-->
						<div class="wthree-form">
							<!-- <h2>Đăng nhập</h2> -->
							<form action="login.php" method="get">
								<div class="form-sub-w3">
									<input type="text" name="user" placeholder="Username" required="" />
								<div class="icon-w3">
									<i class="fa fa-user" aria-hidden="true"></i>
								</div>
								</div>
								<div class="form-sub-w3">
									<input type="password" name="pwd" placeholder="Password" required="" />
								<div class="icon-w3">
									<i class="fa fa-unlock-alt" aria-hidden="true"></i>
								</div>
								</div>
								<label class="anim">
								
								
								</label> 
								<div class="clear"></div>
								<div class="submit-agileits">
									<input type="submit" name="submit" value="Đăng nhập">
								</div>
							</form>

						</div>
				<!--//form-ends-here-->

		</div>
		<!--//main-->
		<!--footer-->
		<!-- <div class="footer">
			<p>&copy; 2017 Glassy Login Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
		</div> -->
		<!--//footer-->
</body>
</html>