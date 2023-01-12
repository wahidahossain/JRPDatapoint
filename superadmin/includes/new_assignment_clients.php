<section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Assign Brands to Client Accounts</h3>
                            <div class="card-tools">                         
                                <i class="fas fa-times"></i>             
                            </div>
                          </div> 
                              <?php
                                $jrp_account_no = false;
                                if(isset($_REQUEST['jrp_account_no']))
                                {
                                $jrp_account_no = $_REQUEST['jrp_account_no'];
                                }
                              ?>           
                        <form role="form" action="../model/new_assignment_clients.php" method="POST">
                                                <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    <a href="new_bunch_assignment_clients.php?jrp_account_no=<?php echo $jrp_account_no;?>" class="text-warning"><i class="nav-icon fas fa-edit"></i> Go for Manual Brand Edit</a>
                                                      <div class="position-relative p-3 bg-gray" style="height: 600px; overflow: scroll; min-width: 450px !important;">
                                                        <div class="form-group">                  
                                                        <label>Select Client</label>
                                                        <div class="select2-purple">
                                                        <select  class="form-control select2bs4 select2-hidden-accessible" name="user_excol2" data-placeholder="Select a client" style="width: 100%;" data-select2-id="21" tabindex="-1" aria-hidden="true" required>
                                                                <option selected disabled value="">Select a Client Account</option>
                                                                    <?php
                                                                    include ("../model/connect.php");
                                                                    if(!isset($_REQUEST['jrp_account_no']))
                                                                    {                    
                                                                          $result = mysqli_query($con, "SELECT user_id, user_excol2 FROM `user` WHERE account_type != 'superadmin' AND user_excol2!='' AND `user_id` IN (SELECT `user_id` FROM `assign_template` WHERE `report_indexes_id`='0');");                
                                                                          while ($row_user = mysqli_fetch_array($result))
                                                                          {                    
                                                                              $user_excol2 = $row_user['user_excol2'];
                                                                              $user_id1 = $row_user['user_id'];
                                                                              ?>
                                                                              
                                                                              <option value="<?php echo $user_excol2;?>"><?php echo $user_excol2;?></option>
                                                                              <?php
                                                                              }
                                                                      }
                                                                  else{

                                                                              $result2 = mysqli_query($con, "SELECT user_id, user_excol2 FROM `user` WHERE account_type != 'superadmin' AND user_excol2!='$jrp_account_no' AND `user_id` IN (SELECT `user_id` FROM `assign_template` WHERE `report_indexes_id`='0');");                
                                                                              while($row_user2 = mysqli_fetch_array($result2)){
                                                                                  $user_excol22 = $row_user2['user_excol2'];
                                                                                  $jrp_account_no = $_REQUEST['jrp_account_no'];
                                                                              ?>                                                                              
                                                                              <option value="<?php echo $user_excol22;?>"><?php echo $user_excol22;?></option>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                              <option value="<?php echo $jrp_account_no;?>" selected><?php echo $jrp_account_no;?></option>
                                                                              <?php
                                                                        }
                                                                
                                                                    ?>
                                                                </select>
                                                        </div>
                                                          </div>
                                                        <label>Warehouse List</label>
                                                        <div class="select2-purple">
                                                              <select class="select2" multiple="multiple" data-placeholder="Select Warehouse" name="warehouse_code[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                                    <?php
                                                                  // include ("../model/connect.php");
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
                                                          $sub=mysqli_query($con, "SELECT `brand` FROM `stock` WHERE `brand`!='' and `brand` NOT IN (SELECT `brand` FROM `filter_brands`) GROUP BY `brand` order by `brand`; ");
                                                          $suboption='';
                                                          while($row=  mysqli_fetch_assoc($sub))
                                                          {
                                                              $suboption .='<option value = "'.$row['brand'].'">'.$row['brand'].'</option>';
                                                          }
                                                          ?>
                                                    <td width="15%"><label>Brands List</label></td>
                                                      <td id="add_subject"><div id="add_subject1">
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
                    <div class="position-relative p-3 bg-gray" style="height: 600px; overflow: scroll; min-width: 790px !important;">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-info">
                          Added List
                        </div>
                      </div>                      
                    <?php 
                    error_reporting(0);
                    include ("../model/connect.php");
                    $jrp_account_no = $_REQUEST['jrp_account_no'];
                        if($jrp_account_no==''){
                            echo "No Records Added."; 
                        }
                        else{
                              ?>
                              <form role="form" action="../model/delete_new_assignment_clients.php" method="POST">                        
                                  <table id="example1" class="">
                                        <thead>
                                              <tr>
                                                  <th>SL</th>
                                                  <th></th>
                                                  <th style="min-width: 130px !important;">Brands Name</th>
                                                  <th>Product Categories</th>
                                                </tr>
                                            </thead>
                                            <tr><td></td><td><input type="checkbox" onclick="toggle2(this);" /></td><td>Check all?</td></tr>
                                          <tbody>
                                                <?php               

                                                      $result = mysqli_query($con, "SELECT `col_1`, `brandname`,`assign_brands_id`, `category_code`, `product_desc` FROM `assign_brands` 
                                                                                        WHERE `jrp_account_no`= '$jrp_account_no' AND `brandname` NOT IN (SELECT `brand` FROM `filter_brands`)  ORDER BY `assign_brands`.`brandname` ASC;");
                                                      $count = 0;
                                                      while ($row = mysqli_fetch_array($result))
                                                      { $count= $count+1;
                                                          $col_1 = $row['col_1'];
                                                          $assign_brands_id = $row['assign_brands_id'];
                                                          $brandname = $row['brandname'];
                                                          $category_code = $row['category_code']; 
                                                          $product_desc = $row['product_desc'];                                                    
                                                        ?>
                                                  <tr>
                                                        <td><?php echo $count;?></td>
                                                        <td><input type="hidden" name="jrp_account_no" value="<?php echo $jrp_account_no;?>">
                                                            <input type="checkbox" name="assign_brands_id[]" value="<?php echo $assign_brands_id;?>">
                                                          <br> </td>
                                                        <td><?php echo $brandname;?></td>
                                                        <td>
                                                        <?php 
                                                          if($col_1=='1')
                                                          {echo $category_code;}
                                                          if($col_1=='0')
                                                          {echo "<div class='text-warning'>".$category_code."</div>";}
                                                          ?>    
                                                      </td>
                                                    </tr>
                                                  <?php
                                                  }
                                                  ?>                            
                                              </tbody>
                                    </table>
                
                                  <?php 
                                }
                                ?>
                  </div>
                  <button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button>
                 </form>
                  <br />
                    <a href="../model/delete_assignment.php?flag=3&user_excol2=<?php echo $jrp_account_no;?>" class="text-warning" onclick="return confirm('Are you sure you want to delete all assign brands?')"><i class="fa fa-eraser fa-fw"></i>Delete All Assignments</a>
          </div>
      </div>
  </section>
                                                    <!-- ================================================================================================= -->
                                                    <script>
                                                            function toggle2(source) {
                                                            var checkboxes = document.querySelectorAll('input[name="assign_brands_id[]"]');
                                                                for (var i = 0; i < checkboxes.length; i++) 
                                                                {
                                                                    if (checkboxes[i] != source)
                                                                        checkboxes[i].checked = source.checked;
                                                                }
                                                            }
                                                        </script>
                                                  <!-- ================================================================================================= -->


