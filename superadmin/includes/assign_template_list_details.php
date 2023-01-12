<?php 
include ("../model/connect.php");
$report_indexes_id = $_REQUEST['report_indexes_id'];
$result_index_name = mysqli_query($con, "SELECT * FROM `report_indexes` where `report_indexes_id`='$report_indexes_id';");
$row_index_name = mysqli_fetch_array($result_index_name);
$index_name = $row_index_name['index_name'];

?>
<!-- Main content -->       
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Static List View of: <?php echo $index_name;?></h3>
              </div>
              <!-- /.card-header -->                                
                  <div class="card-body">
                  <form role="form" action="../model/delete_assign_template_list_details.php?opt=2" method="POST">   
                <table id="example1" class="table">
                  <thead>
                  <tr>
                  <th>SL</th>
                  <th width="130px"><input type="checkbox" onclick="toggle(this);" /> Check all? Del</th>
                    <th>Brands Name</th>
                    <th>Product Categories</th>                    
                    <th>Status</th>
                  </tr>
                  </thead>                  
                  <tbody>                  
                  <?php                               
                    $result = mysqli_query($con, "SELECT `template_id`, `brand_name`, `product_code_id`, `warehouse`, `flag` FROM `template` WHERE 
                                                  `report_indexes_id`= '$report_indexes_id' ORDER BY `template`.`flag` ASC;");
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
                  ?>                            
                  </tbody>                                 
                </table> 
                <tr>
                  <th></th>
                  <th><button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button></form> </th> 
                     
                  <th></th> 
                    <th></th>                                       
                  </tr>    
                               
              <!-- /.card-body -->
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
                          function toggle(source) {
                          var checkboxes = document.querySelectorAll('input[name="template_id[]"]');
                              for (var i = 0; i < checkboxes.length; i++) 
                              {
                                  if (checkboxes[i] != source)
                                      checkboxes[i].checked = source.checked;
                              }
                          }
                      </script>
                      <!-- ================================================================================================= --> 
                 

      
   