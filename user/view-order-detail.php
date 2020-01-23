<?php 
     if(!isset($_SESSION)) session_start();
     if(!isset($_SESSION['user'])){ 
         echo "<script>location.href = '../subpage/login.php'</script>"; exit;
     }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="../img/favicon.png">

    <link rel="stylesheet" href="../admins/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../admins/vendors/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="../admins/assets/css/style.css">
    <link rel="stylesheet" href="css/styles.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    
</head>

<body>
<?php 
        include "../config/config.php";
        include ROOT."/include/function.php";
        spl_autoload_register("loadClass");

        $ma_user = $_SESSION['user']['user_id']; 
        include 'module/order/index.php';
?>

    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="../img/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="../admins/images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li><a href="../index.php"><i class="fa fa-home"></i>&nbsp;&nbsp;Trang chủ</a></li>
                    <li><a href="change-user.php"><i class="fa fa-user"></i>&nbsp;&nbsp;Sửa thông tin cá nhân</a></li>
                    <li><a href="index.php"><i class="fa fa-tablet"></i>&nbsp;&nbsp;Kiểm tra đơn hàng</a></li>
                    <li><a href="../index.php?mode=exit"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Đăng xuất</a></li>    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left" ><i class="fa fa fa-tasks"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xin chào <span style='color:red;font-weight: bold;'><?php echo $ma_user; ?></span>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="../index.php?mode=exit"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-12 check-order" style='background-color:lavender;'>   
                <h2 style='text-align:center; margin:15px 0 15px 0;'>Danh sách đơn hàng</h3>
                <div class="form-group">
                    <form action="index.php" method='get'>
                        <div class="col-sm-2">
                            <label for='from-date'>Từ ngày (</label> )
                        </div>
                        
                        <div class="col-sm-3">
                            <input type="date" class="form-control" name='from-date' id='from-date'>
                        </div>
                        <div class="col-sm-2">
                            <label for='to-date'>Đến ngày (</label> )
                        </div>
                        
                        <div class="col-sm-3">
                        <input type="date" class="form-control" name='to-date' id='to-date'>
                        </div>
                        
                        <div class="col-sm-2">
                        <button class="btn btn-danger" name='search-sm' value='search-order' title='Tìm kiếm'><i class="fa fa-search"></i></button>
                        </div>
                        <input type="hidden" name='ac' value='search'>
                    </form>
                </div>           
            </div>
        </div>  

        <div class="content mt-3">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-12 col-md-offset-1"> 
                        <div class="panel panel-default panel-table"> 
                            <div class="panel-body"> 
                                <table class="table table-striped table-bordered table-list"> 
                                    <thead> 
                                    <tr>                     
                                        <th>Hình sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                    </tr> 
                                    </thead> 
                                    <tbody>
                                    <?php
                                      $total = 0;
                                    if(isset($arr_ordtls)){
                                        foreach ($arr_ordtls as $value) {
                                            echo "<tr> 
                                                    <td><img src='../image/{$value['product_img']}' style='width:100px;height:100px;'></td>
                                                    <td>{$value['product_name']}</td>
                                                    <td>".number_format($value['product_price'],0,'',',')."<sup>đ</sup></td>
                                                    <td>{$value['quantity']}</td>
                                                </tr>";
                                                $total += $value['product_price'] * $value['quantity'];
                                        }
                                    }
                                    ?>  
                                    </tbody>               
                                </table> 
                            </div>

                            <div class="panel-footer">                          
                                <?php
                                    echo "Tổng tiền: ".number_format($total,0,'',',').'<sup>đ</sup>';
                                ?>                
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>

    </div>
    <!-- Right Panel -->

    <script src="../admins/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../admins/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admins/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../admins/assets/js/main.js"></script>
    <script>
        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0,10);
        });
        document.getElementById('to-date').value = new Date().toDateInputValue();
        document.getElementById('from-date').value = new Date().toDateInputValue();
    </script>

</body>

</html>
