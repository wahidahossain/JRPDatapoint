
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
            
            $jrp_account_no = $_GET['jrp_account_no'];
            $result = mysqli_query($con, "SELECT `category_code`, `product_desc` FROM `assign_brands` WHERE `jrp_account_no`= '$jrp_account_no' AND `brandname` LIKE '%$from%' ORDER BY `category_code`;");  
            $count_name1 = 0;              
            while ($row = mysqli_fetch_array($result))
            { 
                $count_name1 = $count_name1+1;                  
                $product_desc = $row['product_desc'];
                $category_code = $row['category_code'];
                $check_name = "check_".$count_name1;
                ?>                                 
                <input type="checkbox" name="category_code[]" value="<?php echo $category_code;?>"><?php echo $category_code;?> > <?php echo $product_desc;?> <br>                                                                                            
            <?php
            }
            ?> 
    </div>
       


