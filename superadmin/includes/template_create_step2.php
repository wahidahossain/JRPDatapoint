<section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Modify Warehouse, Brands & Product Codes to Templates</h3>

            <div class="card-tools">              
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"> -->
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/template_create_step2.php" method="POST">
        <div class="card-body">
            <div class="row">   
            <div class="col-sm-4"> 
                <div class="position-relative p-3 bg-gray" style="height: 600px; overflow: scroll; min-width: 450px !important;">                               
                  <div class="select2-purple">
                   <h4>Template Name: <b><?php echo $_REQUEST['index_name'];?></b></h4>
                   <input type="text" value="<?php echo $_REQUEST['report_indexes_id'];?>" name="report_indexes_id" hidden class="form-control"> 
                   <input type="text" value="<?php echo $_REQUEST['index_name'];?>" name="index_name" hidden class="form-control"> 
                  </div>
                
                <label>Warehouse List</label>
                <div class="select2-purple">
                  <select class="select2" multiple="multiple" data-placeholder="Select Warehouse" name="warehouse_code[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    <?php
                    include ("../model/connect.php");
                    $result = mysqli_query($con, "SELECT `col_1` FROM `stock` group by `col_1`; ");                
                      while ($row = mysqli_fetch_array($result))
                      {                    
                      $warehouse_code = $row['col_1'];
                      ?> 
                      <option value="<?php echo $warehouse_code;?>" selected><?php echo $warehouse_code;?></option>
                      <?php
                      }
                    ?>
                    </select>
                  </div>
                <tr>
                  <?php
                  $sub=mysqli_query($con, "SELECT `brand` FROM `stock` WHERE `brand`!='' GROUP BY `brand` order by `brand`; ");
                  $suboption='';
                  while($row=  mysqli_fetch_assoc($sub))
                  {
                    $suboption .='<option value = "'.$row['brand'].'">'.$row['brand'].'</option>';
                  }
                  ?>
                  <td width="15%"><label>Brands List</label></td>
                  <td id="add_subject"><div id="add_subject1">
                    <!-- <select name="brands" id="subject" onchange="subjectskills(this.value)"> -->
                      <select name="brands" id="subject" onchange="subjectskills(this.value)">
                      <option selected disabled value="">Select a Brand</option>
                      <?php echo $suboption; ?>
                    </select>
                  </div>
                </td>
              </tr>
              <label>Product Category</label>
              <div id="check_box">
                  <?php 
                  $from = 0;
                  if(isset($_GET['from']))
                  {
                      $from=$_GET['from'];
                    
                  }
                  ?>
                  </div>            
                  <!-- ================================================================================================= -->
                      <script>
                          function toggle(source) {
                          var checkboxes = document.querySelectorAll('input[name="category_code[]"]');
                              for (var i = 0; i < checkboxes.length; i++) 
                              {
                                  if (checkboxes[i] != source)
                                      checkboxes[i].checked = source.checked;
                              }
                          }
                      </script>
                  <!-- ================================================================================================= -->               
                </div>
                <button type="submit" name="add" value="add" class="btn btn-primary">Add New</button>
            </form>
              </div>
              <div class="col-sm-4">
      <div class="position-relative p-3 bg-gray" style="height: 600px; overflow: scroll; min-width: 750px !important;">
                    <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-info">
                          Added List
                        </div>
                      </div>
                      <form role="form" action="../model/delete_template_create_step_edit.php" method="GET">                        
                        <table id="example1" class="">
                            <thead>
                                <tr>
                                    <th>SL</th>                                    
                                    <th style="min-width: 130px !important;">Brands Name</th>
                                    <th>Product Categories</th>
                                </thead>
                                <!-- <tr><td></td><td><input type="checkbox" onclick="toggle(this);" />Check all?</td><td></td></tr> -->
                                <tbody>
                                <?php
                    include ("../model/connect.php");
                    $report_indexes_id = $_REQUEST['report_indexes_id'];
                    $index_name = $_REQUEST['index_name'];
                    //$result = mysqli_query($con, "SELECT `template_id`, `brand_name`, GROUP_CONCAT(`product_code_id`) as `product_code_id`, `warehouse` FROM `template` WHERE `report_indexes_id`= '$report_indexes_id' GROUP BY `brand_name`;");
                    $result = mysqli_query($con, "SELECT `template_id`, `brand_name`, `product_code_id`, `warehouse` FROM `template` WHERE `report_indexes_id`= '$report_indexes_id' GROUP BY `product_code_id` ORDER BY `brand_name`;");
                    $count = 0;
                    while ($row = mysqli_fetch_array($result))
                    { 
                            $count= $count+1;
                                  $template_id = $row['template_id'];
                                  $brand_name = $row['brand_name'];
                                  $product_code_id = $row['product_code_id'];
                                  // print_r( explode(',', $product_code_id) );                                 
                                  //$warehouse = $row['warehouse'];
                              //------------ User table --------------------
                              $result2 = mysqli_query($con, "SELECT * FROM `product_code` where `product_code_id` = '$product_code_id'");                
                              while($row1 = mysqli_fetch_array($result2)){                                
                                  $category_code = $row1['category_code'];
                                  $product_desc = $row1['product_desc']; 
                            //------------ Product code table --------------------   
                                                    
                    ?>
                <tr>
                                <td><?php echo $count;?></td>
                                <td>
                                <!-- report_indexes_id  brand_name  product_code_id -->
                                <!-- <input type="hidden" name="report_indexes_id" value="<?php //echo $report_indexes_id;?>"> 
                                <input type="hidden" name="index_name" value="<?php //echo $index_name;?>">
                                <input type="hidden" name="brand_name" value="<?php //echo $brand_name;?>">   -->
                                <input type="hidden" name="index_name" value="<?php echo $index_name;?>">
                                <input type="checkbox" name="template_id[]" value="<?php echo $template_id;?>"> <?php echo $brand_name;?></td>
                                <td><?php echo $category_code." : ".$product_desc;?></td>
                          </tr>
                <?php
                }
              }
                ?>                            
                  </tbody>
                </table>
                <button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button>                
                </form>                
              </div>
              <a href="../model/delete_template_assignment.php?opt=s&index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>" class="text-warning" onclick="return confirm('Are you sure, want to delete all brands assigned to this template?')"><i class="fa fa-eraser fa-fw"></i>Delete All Assignments</a>                

            </div>
          </div>
        </div>
      </div>
    </section>


