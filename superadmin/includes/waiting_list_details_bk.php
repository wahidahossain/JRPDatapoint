<?php 
include ("../model/connect.php");
$report_indexes_id = $_REQUEST['report_indexes_id'];
if($report_indexes_id != '0'){
$result_index_name = mysqli_query($con, "SELECT * FROM `report_indexes` where `report_indexes_id`='$report_indexes_id';");
$row_index_name = mysqli_fetch_array($result_index_name);
$index_name = $row_index_name['index_name'];
}
else{
  $index_name = "Manual Template";
}
?>
<!-- Main content -->       
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Static List View of: <?php echo $index_name;?></h3>                
              </div>
              
              <!-- /.card-header -->                                
                  <div class="card-body">
                  <a href="assign_template_list_details.php?report_indexes_id=<?php echo $report_indexes_id;?>" target="_blank" class="text-warning"><i class="nav-icon fas fa-edit"></i> Go To Full Listing View</a>                 
                  <a href="../model/waiting_list_details.php?report_indexes_id=<?php echo $report_indexes_id;?>" class="btn btn-warning btn-sm">Approve Template</a>
                  <form role="form" action="../model/delete_assign_template_list_details.php?opt=1&report_indexes_id=<?php echo $report_indexes_id;?>" method="POST">   
                <table id="example1" class="table">
                  <thead>
                  <tr>
                  <th>SL</th>
                  <th width="130px"><input type="checkbox" onclick="toggle(this);" />Check all? Del</th>
                    <th>Brands Name</th>
                    <th>Product Categories</th>                    
                    <!-- <th>Operations</th> -->
                    <th>Status</th>
                  </tr>
                  </thead>                  
                  <tbody>                  
                  <?php
                if($report_indexes_id != '0'){
                // Static template ========================================================================================= 
                $result = mysqli_query($con, "SELECT `template_id`, `brand_name`, `product_code_id`, `warehouse`, `flag` FROM `template` WHERE 
                                              `report_indexes_id`= '$report_indexes_id' AND `flag`='0' ORDER BY `template`.`brand_name` ASC;");
                $count = 0;
                while ($row = mysqli_fetch_array($result))
                { 
                    $template_id = $row['template_id'];
                    $brand_name = $row['brand_name'];
                    $product_code_id = $row['product_code_id']; 
                    $warehouse = $row['warehouse'];
                    $flag = $row['flag'];

                  //------------ Product code table --------------------                                        

                $result2 = mysqli_query($con, "SELECT * FROM `product_code` where product_code_id = '$product_code_id'");                
                while($row1 = mysqli_fetch_array($result2)){
                  $count= $count+1;
                    $category_code = $row1['category_code'];
                    $product_desc = $row1['product_desc']; 
                  ?>
                  <tr>
                  <td><?php echo $count;?></td>
                  <td>
                  <input type="hidden" name="report_indexes_id" value="<?php echo $report_indexes_id;?>">  
                  <input type="checkbox" name="template_id[]" value="<?php echo $template_id;?>"></td>
                  <td><?php echo $brand_name;?></td>
                  <td><?php echo $category_code." : ".$product_desc;?></td>
                  <td><?php 
                  if($flag=='0'){
                    echo "<code>On Hold</code>";
                  }
                  if($flag=='1'){
                    echo "Permitted";
                  }
                  
                  ?></td>
                      
                     </tr>
                  <?php
                        }
                  }
                  $report_indexes_id1 = $report_indexes_id;
                  ?>                            
                  </tbody>
                                 
                </table> 
                <tr>
                  <th></th>
                  <th><button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button></form></th>                     
                  <th></th>
                  <th></th>
                </tr>
                <br>
                <form role="form" action="../model/delete_waiting_client_approval_list.php" method="POST">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Assigned Client List</h3>
                    </div>
                    <div class="card-body">
                      <?php                
                            $result2 = mysqli_query($con, "SELECT `waiting_client_approval_list_id`, `user_id`,`jrp_account_no`,`generate_rule` FROM `waiting_client_approval_list` WHERE `report_indexes_id`='$report_indexes_id'");                
                            //if(mysqli_num_rows($result2 > 0)){
                            while($row1 = mysqli_fetch_array($result2)){
                            
                                $waiting_client_approval_list_id = $row1['waiting_client_approval_list_id'];
                                $user_id1 = $row1['user_id'];
                                $jrp_account_no = $row1['jrp_account_no'];  
                                $generate_rule = $row1['generate_rule'];
                                if($generate_rule=='1'){
                                $rule = "Qty > 0";
                                }
                                if($generate_rule=='2'){
                                $rule = "Qty = y/n";
                                }
                                if($generate_rule=='3'){
                                $rule = "Qty = Real Stock";
                                }
                            ?>
                  <input type="hidden" name="report_indexes_id" value="<?php echo $report_indexes_id;?>">
                  <input type="checkbox" class="checkboxes" name="waiting_client_approval_list_id[]" value="<?php echo $waiting_client_approval_list_id;?>"> <?php echo $jrp_account_no;?>: <?php echo $rule;?><br>                                                                                           
                  <?php } ?>
                  <th>
                  <br />
                    <button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button>
                  </form>
                  </th>

                    <?php 
                     } // END OF STATIC TEMPLATE VIEW ============================
                     else
                     {  // START OF MANUAL TEMPLATE VIEW ============================
                     
                            // Static template ========================================================================================= 
                            //$result = mysqli_query($con, "SELECT `brand_name`, GROUP_CONCAT(`product_code_id`) as `product_code_id`, `warehouse` FROM `template` WHERE `report_indexes_id`= '$report_indexes_id' GROUP BY `brand_name`;");
                            $result = mysqli_query($con, "SELECT `template_id`, `brand_name`, `product_code_id`, `warehouse`, `flag` FROM `template` WHERE 
                            `report_indexes_id`= '$report_indexes_id' AND `flag`='0' ORDER BY `template`.`brand_name` ASC;");
                              $count = 0;
                              while ($row = mysqli_fetch_array($result))
                              { 
                                    $template_id = $row['template_id'];
                                    $brand_name = $row['brand_name'];
                                    $product_code_id = $row['product_code_id']; 
                                    $warehouse = $row['warehouse'];
                                    $flag = $row['flag'];
                                    //------------ User table --------------------
                                    $result2 = mysqli_query($con, "SELECT * FROM `product_code` where product_code_id = '$product_code_id'");                
                                    while($row1 = mysqli_fetch_array($result2))
                                    {
                                                    $count= $count+1;
                                                    $category_code = $row1['category_code'];
                                                    $product_desc = $row1['product_desc']; 
                                                    //------------ Product code table --------------------     
                                                    ?>           
                                                <!-- /.card-body -->

                                                        <tr>
                                                        <td><?php echo $count;?></td>
                                                        <td>
                                                        <input type="hidden" name="report_indexes_id" value="<?php echo $report_indexes_id;?>">  
                                                        <input type="checkbox" name="template_id[]" value="<?php echo $template_id;?>"></td>
                                                        <td><?php echo $brand_name;?></td>
                                                        <td><?php echo $category_code." : ".$product_desc;?></td>
                                                        <td>
                                                              <?php 
                                                            if($flag=='0')
                                                            {
                                                              echo "<code>On Hold</code>";
                                                            }
                                                            if($flag=='1')
                                                            {
                                                              echo "Permitted";
                                                            }                  
                                                            ?>
                                                        </td>
                                                      </tr>
                                                      <?php
                                     }
                              }
                              $report_indexes_id1 = $report_indexes_id;
                              ?>                            
                              </tbody>
                            </table>
                            <tr>
                              <th></th>
                              <th><button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button></form></th>
                              <th></th>
                              <th></th>
                              </tr>
                            </div>
                            <br>
                            
                            <form role="form" action="../model/delete_waiting_client_approval_list.php" method="POST">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">Assigned Client List</h3>
                                </div>
                                <div class="card-body">
                                  <?php                
                                        $result2 = mysqli_query($con, "SELECT `waiting_client_approval_list_id`, `user_id`,`jrp_account_no`,`generate_rule` FROM `waiting_client_approval_list` WHERE `report_indexes_id`='$report_indexes_id'");                
                                        //if(mysqli_num_rows($result2 > 0)){
                                        while($row1 = mysqli_fetch_array($result2))
                                        {                            
                                            $waiting_client_approval_list_id = $row1['waiting_client_approval_list_id'];
                                            $user_id1 = $row1['user_id'];
                                            $jrp_account_no = $row1['jrp_account_no'];  
                                            $generate_rule = $row1['generate_rule'];
                                            if($generate_rule=='1'){
                                              $rule = "Qty > 0";
                                            }
                                            if($generate_rule=='2'){
                                              $rule = "Qty = y/n";
                                            }
                                            if($generate_rule=='3'){
                                              $rule = "Qty = Real Stock";
                                            }
                                            ?>
                                            <input type="hidden" name="report_indexes_id" value="<?php echo $report_indexes_id;?>">
                                            <input type="checkbox" class="checkboxes" name="waiting_client_approval_list_id[]" value="<?php echo $waiting_client_approval_list_id;?>"> <?php echo $jrp_account_no;?>: <?php echo $rule;?><br>                                                                                           
                                  <?php 
                                      } 
                                      ?>
                                      <th>
                                        <br />
                                        <button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button>
                                        </form>
                                        </th>
                     <?php 
                      }
                    ?>
                    </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
 <!-- ================================================================================================= -->
 <script>
    function toggle(source) 
    {
      var checkboxes = document.querySelectorAll('input[name="template_id[]"]');
      for (var i = 0; i < checkboxes.length; i++) 
        {
         if (checkboxes[i] != source)
         checkboxes[i].checked = source.checked;
        }
    }
 </script>
                      <!-- ================================================================================================= --> 
                 

      
   