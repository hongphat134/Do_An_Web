<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-3" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-3">
                    <div>
                        <?php
                            if(isset($arr_product_top_selling)){
                                $i = 0;
                                if(count($arr_product_top_selling) == 18){
                                for ($i; $i < count($arr_product_top_selling)/6 ; $i++) { 
                                    //echo $arr[$i]['product_img'];
                                    echo "<div class=\"product-widget\">
                                            <div class=\"product-img\">
                                                <img src=\"./image/".$arr_product_top_selling[$i]['product_img']."\" alt=\"\">
                                            </div>
                                            <div class=\"product-body\">
                                                <p class=\"product-category\">".$arr_product_top_selling[$i]['cat_name']."</p>
                                                <h3 class=\"product-name\"><a href=\"product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}\">".$arr_product_top_selling[$i]['product_name']."</a></h3>
                                                <h4 class=\"product-price\">".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."<sup>đ</sup></h4>
                                            </div>
                                        </div>";
                                }
                    
                        ?>
                      
                    </div>

                    <div>
                        <?php
                                for ($i; $i < count($arr_product_top_selling)/3; $i++) { 
                                    //echo $arr[$i]['product_img'];
                                    echo "<div class=\"product-widget\">
                                            <div class=\"product-img\">
                                                <img src=\"./image/".$arr_product_top_selling[$i]['product_img']."\" alt=\"\">
                                            </div>
                                            <div class=\"product-body\">
                                                <p class=\"product-category\">".$arr_product_top_selling[$i]['cat_name']."</p>
                                                <h3 class=\"product-name\"><a href=\"product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}\">".$arr_product_top_selling[$i]['product_name']."</a></h3>
                                                <h4 class=\"product-price\">".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."<sup>đ</sup></h4>
                                            </div>
                                        </div>";
                                }
                    
                        ?>
                       
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-4" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-4">
                    <div>
                        <?php
                                for ($i; $i < count($arr_product_top_selling)/2 ; $i++) { 
                                    //echo $arr[$i]['product_img'];
                                    echo "<div class=\"product-widget\">
                                            <div class=\"product-img\">
                                                <img src=\"./image/".$arr_product_top_selling[$i]['product_img']."\" alt=\"\">
                                            </div>
                                            <div class=\"product-body\">
                                                <p class=\"product-category\">".$arr_product_top_selling[$i]['cat_name']."</p>
                                                <h3 class=\"product-name\"><a href=\"product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}\">".$arr_product_top_selling[$i]['product_name']."</a></h3>
                                                <h4 class=\"product-price\">".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."<sup>đ</sup></h4>
                                            </div>
                                        </div>";
                                }
                            }
                    
                        ?>
                       
                    </div>

                    <div>
                        <?php
                            for ($i; $i < count($arr_product_top_selling)/6 + count($arr_product_top_selling)/2; $i++) { 
                                //echo $arr[$i]['product_img'];
                                echo "<div class=\"product-widget\">
                                        <div class=\"product-img\">
                                            <img src=\"./image/".$arr_product_top_selling[$i]['product_img']."\" alt=\"\">
                                        </div>
                                        <div class=\"product-body\">
                                            <p class=\"product-category\">".$arr_product_top_selling[$i]['cat_name']."</p>
                                            <h3 class=\"product-name\"><a href=\"product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}\">".$arr_product_top_selling[$i]['product_name']."</a></h3>
                                            <h4 class=\"product-price\">".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."<sup>đ</sup></h4>
                                        </div>
                                    </div>";
                            }
                    
                        ?>
                       
                    </div>
                </div>
            </div>

            <div class="clearfix visible-sm visible-xs"></div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-5" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-5">
                    <div>
                        <?php
                            for ($i; $i < count($arr_product_top_selling)/3 + count($arr_product_top_selling)/2; $i++) { 
                                //echo $arr[$i]['product_img'];
                                echo "<div class=\"product-widget\">
                                        <div class=\"product-img\">
                                            <img src=\"./image/".$arr_product_top_selling[$i]['product_img']."\" alt=\"\">
                                        </div>
                                        <div class=\"product-body\">
                                            <p class=\"product-category\">".$arr_product_top_selling[$i]['cat_name']."</p>
                                            <h3 class=\"product-name\"><a href=\"product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}\">".$arr_product_top_selling[$i]['product_name']."</a></h3>
                                            <h4 class=\"product-price\">".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."<sup>đ</sup></h4>
                                        </div>
                                    </div>";
                            }
                    
                        ?>
                       
                    </div>

                    <div>
                        <?php
                            for ($i; $i < count($arr_product_top_selling) ; $i++) { 
                                //echo $arr[$i]['product_img'];
                                echo "<div class=\"product-widget\">
                                        <div class=\"product-img\">
                                            <img src=\"./image/".$arr_product_top_selling[$i]['product_img']."\" alt=\"\">
                                        </div>
                                        <div class=\"product-body\">
                                            <p class=\"product-category\">".$arr_product_top_selling[$i]['cat_name']."</p>
                                            <h3 class=\"product-name\"><a href=\"product.php?mode=detail&id={$arr_product_top_selling[$i]['product_id']}\">".$arr_product_top_selling[$i]['product_name']."</a></h3>
                                            <h4 class=\"product-price\">".number_format($arr_product_top_selling[$i]['product_price'],0,'',',')."<sup>đ</sup></h4>
                                        </div>
                                    </div>";
                            }
                            }
                    
                        ?>
                        
                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>