<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- Table start -->
        
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
             

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Client Groups (According to Static Templates)</h3>
              </div>
              <!-- /.card-header -->
                                
                  <div class="card-body">
                <table id="example1" class="table table-bordered ">                  
                  <tbody>                 
                  <?php
                include ("../model/connect.php");
                $result = mysqli_query($con, "SELECT * FROM `report_indexes` where `flag`='1';");
                error_reporting(0);
                $count = 0;
                while ($row = mysqli_fetch_array($result))
                { 
                    $index_name = $row['index_name'];
                    $report_indexes_id = $row['report_indexes_id'];
                //------------ assign_template table --------------------
                ?>
               <form name=form1 method=post action="../model/assign_template_list.php">
                
               <tr>
                  <td>
                    <br>
                    <div class="lead">
                  Template Name: <b><a href="assign_template_list_details.php?report_indexes_id=<?php echo $report_indexes_id;?>"><?php echo $index_name;?></a></b> 
                  || <a href="template_create_step_edit.php?index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>"> <i class="nav-icon fas fa-edit"></i> Edit</a>
                  || <a href="../model/delete_template_assignment.php?opt=list&index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>" onclick="return confirm('Are you sure you want to delete?')"> <i class="fa fa-eraser fa-fw"></i>Delete All Assignments</a>
                  || <a href="copy_template.php?index_name=<?php echo $index_name;?>&report_indexes_id=<?php echo $report_indexes_id;?>"> <i class="nav-icon fas fa-edit"></i> Copy</a>
                </div>
                 

                  <div class="small-box bg-info">
                  <div class="inner">
                    Shift Clients to another template:
                  <select name="report_indexes_id">
                  <?php
                  $template_list=mysqli_query($con, "SELECT * FROM `report_indexes` where `flag`='1'");
                  $suboption='';
                  while($row_template_list=  mysqli_fetch_assoc($template_list))
                  {
                    $index_name1 = $row_template_list['index_name'];
                    $report_indexes_id1 = $row_template_list['report_indexes_id'];
                      ?>
                      <option value="<?php echo $report_indexes_id1;?>" required><?php echo $index_name1;?></option>                      
                      <?php } ?>
                      </select>
                      <select name="generate_rule">
                      <!-- 1: qty>0 2: qty=y/n 3: qty=real stock 	 -->
                      <option value="1">Qty > 0</option> 
                      <option value="2">Qty = y/n</option> 
                      <option value="3">Qty = Real Stock</option>  
                      
                  </select>
                      <button type="submit" id="checkBtn" class="btn btn-primary submit-button btn-xs btn-dark">Move To</button>
                      
                      <br>
                    <?php                
                    $result2 = mysqli_query($con, "SELECT `user_id`,`jrp_account_no`,`generate_rule` FROM `assign_template` WHERE `report_indexes_id`='$report_indexes_id'");                
                    //if(mysqli_num_rows($result2 > 0)){
                    while($row1 = mysqli_fetch_array($result2)){
                      $count= $count+1;
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
                  <input type="checkbox" class="checkboxes" name="jrp_account_no[]" value="<?php echo $jrp_account_no;?>"> <?php echo $jrp_account_no;?>: <?php echo $rule;?><br>                                                                                           
                  <?php } ?>
                  
                      </div> 
                      </div>   
              </td>
                </tr>
                
                    </form>
                  <?php } ?>  
                      
                  </tbody>                                
                </table>
                
                </div>
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


      <!-- table ends -->  
      </div><!-- /.container-fluid -->
    </section>
   