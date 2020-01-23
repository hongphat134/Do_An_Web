<?php
    if(!isset($_SESSION)) session_start();
    include "config/config.php";
    include ROOT."/include/function.php";
    spl_autoload_register("loadClass");  

    $comments_clt = new Comment();
    $ac = $_GET['ac'];
    if($ac == 'add'){
        if(isset($_SESSION['user'])){
            $user_id = $_SESSION['user']['user_id'];
            $content = $_GET['content'];
            $rate = $_GET['rate'];
            $product_id = $_GET['product_id'];
            
            $date = date('Y-m-d H:i:s');
            //echo "$content + $rate + $date + $product_id + $user_id";
            
            $kq = $comments_clt->insert(addslashes($content),$date,$rate,$product_id,$user_id);
            // echo html_entity_decode($content);
            if($kq == 1){
                $str_rate = '';
                for ($i=0; $i < 5; $i++) { 
                    if($i <  $rate) $str_rate .= '<i class="fa fa-star"></i>';
                    else $str_rate .= '<i class="fa fa-star-o empty"></i>';
                }           
                $date_mix = explode(' ',$date);
                $date_int= explode('-',$date_mix[0]);
                $date = mktime(0,0,0,$date_int[1],$date_int[2],$date_int[0]);
                $true_date = date('d-m-Y',$date);     
                echo "<li>
                        <div class=\"review-heading\">
                            <h5 class=\"name\">".(strlen($user_id)<14?$user_id:substr($user_id,0,13).'...')."</h5>
                            <p class=\"date\">$true_date {$date_mix[1]}</p>
                            <div class=\"review-rating\">
                                ".$str_rate."
                            </div>
                        </div>
                        <div class=\"review-body\">
                            <p>$content</p>
                        </div>
                    </li>";
            }
        }    
    }
    else if($ac == 'switch-page'){
        $page = isset($_GET['page'])?$_GET['page']:1;
        $product_id = isset($_GET['product_id'])?$_GET['product_id']:'';
        //echo "$page - $product_id";
        if($product_id != ''){
            $arr = $comments_clt->getCommentByProductId($page,$product_id);
            echo '<ul class="reviews">';
            //var_dump($arr);
            foreach ($arr as $value) {
                $str_rate = '';
                for ($i=0; $i < 5; $i++) { 
                    if($i <  $value['comment_rate']) $str_rate .= '<i class="fa fa-star"></i>';
                    else $str_rate .= '<i class="fa fa-star-o empty"></i>';
                }
                $date_mix = explode(' ',$value['comment_date']);
                $date_int= explode('-',$date_mix[0]);
                $date = mktime(0,0,0,$date_int[1],$date_int[2],$date_int[0]);
                $true_date = date('d-m-Y',$date);
                echo "<li>
                    <div class=\"review-heading\">
                        <h5 class=\"name\">".(strlen($value['user_id'])<14?$value['user_id']:substr($value['user_id'],0,13).'...')."</h5>
                        <p class=\"date\">$true_date {$date_mix[1]}</p>
                        <div class=\"review-rating\">
                            ".$str_rate."
                        </div>
                    </div>
                    <div class=\"review-body\">
                        <p>{$value['comment_content']}</p>
                    </div>
                </li>";
            }
            echo '</ul>';
            echo '<ul class="reviews-pagination">';
												
            for($i=1; $i<=$comments_clt->getPageCount(); $i++)
            {
                if($i == $page) echo "<li id='$i' class='active'>$i</li>";
                else echo "<li id='$i' onClick='SwitchPageComment($i,$product_id)'>$i</li>";                
            }
			echo '</ul>';								
        }
    }
?>