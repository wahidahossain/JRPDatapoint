
    <div id="check_box">
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
            $result = mysqli_query($con, "SELECT `brand`,`prod` FROM `stock` WHERE `prod`='$from' GROUP BY `brand`");  
            $count_name1 = 0;              
            while ($row = mysqli_fetch_array($result))
            { 
                $count_name1 = $count_name1+1;                  
                $brands = $row['brand'];
                $check_name = "check_".$count_name1;
                ?>                                 
                <input type="checkbox" name="brands[]" value="<?php echo $brands;?>"> <?php echo $brands;?> <br>                                                                                            
            <?php
            }
            ?> 
    </div>
       


