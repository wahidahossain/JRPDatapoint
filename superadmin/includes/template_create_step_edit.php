<?php 
  include('../model/connect.php');
  $report_indexes_id = $_REQUEST['report_indexes_id'];
  $index_name = $_REQUEST['index_name'];
?>

<section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Set Brands & Product Codes to Templates</h3>            
          </div>            
              <form role="form" action="../model/template_create_step_edit.php" method="POST">
                          <div class="card-body">
                              <div class="row">   
                                <div class="col-sm-4">    
                                <a href="template_bunch_create_step2.php?index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>" class="text-warning"><i class="nav-icon fas fa-edit"></i> Go for Batch Brand Edit</a>
                                  <div class="position-relative p-3 bg-gray" style="overflow: scroll; min-width: 450px !important;">                              
                                    <div class="select2-purple">
                                    <h4>Template Name: </h4>                
                                    <input type="text" value="<?php echo $report_indexes_id;?>" name="report_indexes_id" hidden class="form-control"> 
                                    <input type="text" value="<?php echo $index_name;?>" name="index_name" class="form-control" onkeypress="return /[0-9. a-zA-Z]/i.test(event.key)">
                                    <?php //var_dump($index_name)  ?> 
                                    </div>                                  
                                  <label>Warehouse List</label>
                                    <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Select Warehouse" name="warehouse_code[]" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
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
                          <div class="container-fluid">
                            <div class="card card-default bg-gray">
                              <div class="card-body">
                                <?php                      
                                  $sub=mysqli_query($con, "SELECT `brand` FROM `stock` WHERE `brand`!='' and `brand` NOT IN (SELECT `brand` FROM `filter_brands`) GROUP BY `brand` order by `brand`; ");
                                  $suboption='';
                                  while($row=  mysqli_fetch_assoc($sub))
                                  {
                                    $suboption .='<option value = "'.$row['brand'].'">'.$row['brand'].'</option>';
                                  }
                              ?>
                        <label>Brands List</label>
                        <tr>
                          <td id="add_subject"><div id="add_subject1">
                            <select name="brandname" id="subject" onchange="subjectskills(this.value)">
                            <option value="">Select A Brand</option>
                                  <?php echo $suboption; ?>
                                </select>
                              </div>
                            </td>
                          </tr>
                      <label>Product Category</label>
                      <div id="check_box1">
                      <?php 
                          $from = 0;
                          if(isset($_GET['from']))
                          {
                              $from=$_GET['from'];       
                          }
                      ?>       
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Template</button> 
                      </div>
              </form>            
              <script>
                  function toggle1(source) {
                  var checkboxes = document.querySelectorAll('input[class="checkboxSelection"]');
                      for (var i = 0; i < checkboxes.length; i++) 
                      {
                          if (checkboxes[i] != source)
                              checkboxes[i].checked = source.checked;
                      }
                  }
                
              </script>            
            </div>
          </div>
        </div>       
      </div>
    </div>
      <div class="col-sm-4">
          <div class="position-relative p-3 bg-gray" style="height: 600px; overflow: scroll; min-width: 50% !important;">
                        <div class="ribbon-wrapper ribbon-lg">
                            <div class="ribbon bg-info">
                              Active List
                            </div>
                          </div>
                          <form role="form" action="../model/delete_template_create_step_edit.php" method="POST">                        
                                <table id="example1" class="">
                                    <thead>
                                        <tr>
                                          <th>SL</th>                                    
                                          <th style="min-width: 130px !important;">Brands Name</th>
                                          <th>Product Categories</th>
                                          <th>Warehouse</th>
                                        </tr>
                                      </thead>
                                      <tr><td></td><td><input type="checkbox" onclick="toggle(this);" />Check all?</td><td></td></tr>
                                      <tbody>
                                                  <?php
                                                      include ("../model/connect.php");
                                                      $report_indexes_id = $_REQUEST['report_indexes_id'];
                                                      $index_name = $_REQUEST['index_name'];
                                                      $result = mysqli_query($con, "SELECT `template_id`, `flag`, `brand_name`, `product_code_id`, `warehouse` FROM `template` WHERE `report_indexes_id`= '$report_indexes_id' AND `brand_name` NOT IN (SELECT `brand` FROM `filter_brands`) ORDER BY `brand_name`;");
                                                      $count = 0;
                                                      while ($row = mysqli_fetch_array($result))
                                                      { 
                                                              $count= $count+1;
                                                                    $template_id = $row['template_id'];
                                                                    $brand_name = $row['brand_name'];
                                                                    $product_code_id = $row['product_code_id'];
                                                                    $flag = $row['flag'];                                
                                                                    $warehouse = $row['warehouse'];
                                                                //------------ User table --------------------
                                                                $result2 = mysqli_query($con, "SELECT * FROM `product_code` where `product_code_id` = '$product_code_id'");                
                                                                while($row1 = mysqli_fetch_array($result2))
                                                                {                                
                                                                            $category_code = $row1['category_code'];
                                                                            $product_desc = $row1['product_desc']; 
                                                                      //------------ Product code table --------------------   
                                                                              
                                                                  ?>
                                                                  <tr>
                                                                    <td><?php echo $count;?></td>
                                                                    <td>                                
                                                                    <input type="hidden" name="index_name" value="<?php echo $index_name;?>">
                                                                    <?php 
                                                                    if($flag=='1'){
                                                                    ?>
                                                                    <input type="checkbox" name="template_id[]" value="<?php echo $template_id;?>"> <?php echo $brand_name;?>
                                                                    <?php
                                                                    }
                                                                    else{

                                                                    ?>
                                                                    <div class="text-warning"><input type="checkbox" name="template_id[]" value="<?php echo $template_id;?>"> <?php echo $brand_name;?></div>
                                                                    <?php } ?>
                                                                  </td>
                                                                    <td><?php echo $category_code." : ".$product_desc;?></td>
                                                                    <td><?php echo $warehouse;?></td>
                                                                  </tr>
                                                                <?php
                                                          }
                                                        }
                                                        ?>                            
                                        </tbody>
                                  </table>                                                                                  
                        </div>
                          <button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button>
                          </form>
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
                      <br />
              <a href="../model/delete_template_assignment.php?opt=s&index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>" class="text-warning" onclick="return confirm('Are you sure, want to delete all brands assigned to this template?')"><i class="fa fa-eraser fa-fw"></i>Delete All Assignments</a>                

    </div>
  </section>

  


