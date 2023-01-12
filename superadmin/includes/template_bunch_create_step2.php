<?php
include ("../model/connect.php");
$report_indexes_id = $_REQUEST['report_indexes_id'];
$index_name = $_REQUEST['index_name'];
?>
<section class="content">
      <div class="container-fluid">
                <div class="card card-default">
                            <div class="card-header">
                              <h3 class="card-title">Add Brands In Templates</h3>
                              <div class="card-tools">              
                                  <i class="fas fa-times"></i>
                                </button>
                              </div>
                            </div>
                        <form role="form" action="../model/template_bunch_create_step2.php" method="POST">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-4">                
                                      <a href="template_create_step_edit.php?index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>" class="text-warning"><i class="nav-icon fas fa-edit"></i> Go for Single Category Edit</a>
                                        <div class="position-relative p-3 bg-gray" style="height: 560px; overflow: scroll; min-width: 450px !important;">
                                          <div class="form-group">
                                            <div class="select2-purple">
                                              <h4>Template Name: <b><?php echo $_REQUEST['index_name'];?></b></h4>
                                              <input type="text" value="<?php echo $_REQUEST['report_indexes_id'];?>" name="report_indexes_id" hidden class="form-control">
                                              <input type="text" value="<?php echo $_REQUEST['index_name'];?>" name="index_name" hidden class="form-control">
                                            </div>
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
                                          <td width="15%"><label>Brands List</label></td>
                                          <td><div>
                                            <input type="checkbox" onclick="toggle(this);" />Check all?<br />  
                                              <?php
                                                  $result = mysqli_query($con, "SELECT `brand` FROM `stock` WHERE `brand`!='' and `brand` NOT IN (SELECT `brand` FROM `filter_brands`) GROUP BY `brand` order by `brand`; ");  
                                                  $count_name1 = 0;              
                                                  while ($row = mysqli_fetch_array($result))
                                                    { 
                                                        $count_name1 = $count_name1+1;                  
                                                        $brand = $row['brand'];
                                                        //$check_name = "check_".$count_name1;
                                                        ?>                                 
                                                        <input type="checkbox" name="brand[]" value="<?php echo $brand;?>"> <?php echo $brand;?><br>                                                                                            
                                                    <?php
                                                    }
                                                  ?> 
                                                  </div>
                                                </td>
                                              </tr>      
                                  
                                              <!-- ================================================================================================= -->
                                              <script>
                                                  function toggle(source) {
                                                  var checkboxes = document.querySelectorAll('input[name="brand[]"]');
                                                      for (var i = 0; i < checkboxes.length; i++) 
                                                      {
                                                          if (checkboxes[i] != source)
                                                              checkboxes[i].checked = source.checked;
                                                      }
                                                  }
                                              </script>
                                          <!-- ================================================================================================= -->             
                                          </div><br />
                                          <button type="submit" name="add" value="add" class="btn btn-primary">Add New</button>              
                            </form>
                  </div>
              <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 560px; overflow: scroll; min-width: 50% !important;">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-info">
                          Active List
                        </div>
                      </div>
                    <form role="form" action="../model/delete_bunch_templates.php" method="POST">
                                      <table id="example1" class="">
                                          <thead>
                                                <tr>
                                                <th>SL</th>
                                                  <th>Brands Name</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr><td></td><td><input type="checkbox" onclick="toggle2(this);" />Check all?</td><td></td></tr>
                                              <?php                    
                                            $result = mysqli_query($con, "SELECT `flag`, `brand_name` FROM `template` WHERE `report_indexes_id`= '$report_indexes_id' AND `brand_name` NOT IN (SELECT `brand` FROM `filter_brands`) GROUP BY `brand_name`;");
                                            $count = 0;
                                            while ($row = mysqli_fetch_array($result))
                                              { 
                                                    $count= $count+1;
                                                              $brand_name = $row['brand_name']; 
                                                              $flag = $row['flag'];                                 
                                                      ?>
                                                        <tr>
                                                              <td><?php echo $count;?></td>
                                                              <td>
                                                              <input type="hidden" name="report_indexes_id" value="<?php echo $report_indexes_id;?>"> 
                                                              <input type="hidden" name="index_name" value="<?php echo $index_name;?>"> 
                                                              <?php 
                                                                if($flag=='1'){
                                                                ?> 
                                                              <input type="checkbox" name="brandname[]" value="<?php echo $brand_name;?>"> <?php echo $brand_name;?>
                                                              <?php
                                                                  }
                                                                  else{
                                                                    ?>
                                                              <div class="text-warning"><input type="checkbox" name="brandname[]" value="<?php echo $brand_name;?>"> <?php echo $brand_name;?></div>
                                                              <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>                            
                                          </tbody>
                                      </table>                               
                              </div>
                              <button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button>                  
                      </form>                
              <a href="../model/delete_template_assignment.php?opt=b&index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>" class="text-warning" onclick="return confirm('Are you sure, want to delete all brands assigned to this template?')"><i class="fa fa-eraser fa-fw"></i>Delete All Assignments</a>                
            </div>
        </div>
    </section>
<!-- ================================================================================================= -->
<script>
            function toggle2(source) {
            var checkboxes = document.querySelectorAll('input[name="brandname[]"]');
                for (var i = 0; i < checkboxes.length; i++) 
                {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }
        </script>
    <!-- ================================================================================================= -->            

