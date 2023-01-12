
    <div id="check_box1">
    <?php 
    include ("../../model/connect.php");
    $from = 0;
    if(isset($_GET['from']))
    {
        $from=$_GET['from'];
        //echo"<input type='checkbox' value='$from'>$from";
    }
?>
    <input type="checkbox" onclick="toggle(this);" />Check all?<br />  
        <?php
            $result = mysqli_query($con, "SELECT `product_desc`,`category_code`,`product_code_id` FROM `product_code` WHERE `product_code_id` IN (SELECT `product_code_id` FROM `template` WHERE `brand_name` LIKE '%$from%') AND `flag`='0' GROUP BY `category_code`");  
            $count_name1 = 0;              
            while ($row = mysqli_fetch_array($result))
            { 
                $count_name1 = $count_name1+1;
                $product_code_id = $row['product_code_id'];                  
                $product_desc = $row['product_desc'];
                $category_code = $row['category_code'];
                $check_name = "check_".$count_name1;
                ?>                                 
                <input type="checkbox" name="category_code[]" value="<?php echo $product_code_id;?>"> <?php echo $category_code;?> > <?php echo $product_desc;?> <br>                                                                                            
            <?php
            }
            ?> 
            <?php
            $result = mysqli_query($con, "SELECT `product_desc`,`category_code`,`product_code_id` FROM `product_code` WHERE `product_code_id` IN (SELECT `prod` FROM `stock` WHERE `brand_name` LIKE '%$from%') AND `flag`='0' GROUP BY `category_code`");  
            $count_name1 = 0;              
            while ($row = mysqli_fetch_array($result))
            { 
                $count_name1 = $count_name1+1;
                $product_code_id = $row['product_code_id'];                  
                $product_desc = $row['product_desc'];
                $category_code = $row['category_code'];
                $check_name = "check_".$count_name1;
                ?>                                 
                <input type="checkbox" name="category_code[]" value="<?php echo $product_code_id;?>"> <?php echo $category_code;?> > <?php echo $product_desc;?> <br>                                                                                            
            <?php
            }
            ?>
            

    </div>
       


