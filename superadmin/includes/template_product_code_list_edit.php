
    <div id="check_box1">
    <?php 
    include ("../../model/connect.php");
    $from = 0;
    if(isset($_GET['from']))
    {
        $from=$_GET['from'];
    }

    $report_indexes_id=$_GET['report_indexes_id'];
?>
    <input type="checkbox" onclick="toggle1(this);" />Check all?<br />  
        <?php
//===================
$result2 = mysqli_query($con, "SELECT `product_desc`,`category_code`,`product_code_id` FROM `product_code` WHERE `product_code_id` IN (SELECT `product_code_id` FROM `template` WHERE `brand_name` LIKE '%$from%' AND `report_indexes_id`='$report_indexes_id') AND `flag`='0' GROUP BY `category_code`");  
                $count_name12 = 0;              
               
                while ($row2 = mysqli_fetch_array($result2)){
                    $count_name12 = $count_name12+1;
                    $product_code_id2 = $row2['product_code_id'];                  
                    $product_desc2 = $row2['product_desc'];
                    $category_code2 = $row2['category_code'];
                       
//===================
?>
            <input type="checkbox" checked="checked" name="product_code_id[]" value="<?php echo $product_code_id2;?>"> <?php echo $category_code2;?>  > <?php echo $product_desc2;?> <br>                                          
<?php
                        }
            $result = mysqli_query($con, "SELECT `product_code_id`,`category_code`,`product_desc` FROM `product_code` WHERE `category_code` 
                                    IN (SELECT `prod` FROM `stock` WHERE `brand` LIKE '%$from%') 
                                    AND `product_code_id` NOT IN (SELECT `product_code_id` FROM `template` WHERE `brand_name` LIKE '%$from%' AND `report_indexes_id`='$report_indexes_id') AND `flag`='0' GROUP BY `category_code`"); 
        

            $count_name1 = 0;              
            while ($row = mysqli_fetch_array($result))
            { 
                $count_name1 = $count_name1+1;
                $product_code_id = $row['product_code_id'];                  
                $product_desc = $row['product_desc'];
                $category_code = $row['category_code'];
                $check_name = "check_".$count_name1;
                ?>                                            
                <input type="checkbox" class="checkboxSelection" name="product_code_id[]" value="<?php echo $product_code_id;?>"> <?php echo $category_code;?>  > <?php echo $product_desc;?> <br>                                
  </div>                                                                                      
            <?php
        }
            ?>
    </div>