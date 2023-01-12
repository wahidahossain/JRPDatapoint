<!-- Main content -->
<?php
include ("../model/connect.php");
error_reporting(0);
$jrp_account_no = $_REQUEST['jrp_account_no'];
?>
    <section class="content">
          <div class="container-fluid">
            <!-- Table start -->            
            <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">                                              
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Manual Assignment to: <?php echo $jrp_account_no;?></h3>&nbsp; &nbsp;<a href="new_bunch_assignment_clients.php?jrp_account_no=<?php echo $jrp_account_no;?>" class="text-warning"><i class="nav-icon fas fa-edit"></i> Go for Manual Brand Edit</a>
                        </div>
                        <!-- /.card-header -->                                          
                        <div class="card-body">
                          <form role="form" action="../model/delete_assign_brands_list_details.php?opt=1" method="POST"> 
                                  <table id="example1" class="table table-bordered ">
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
                                              $result = mysqli_query($con, "SELECT `assign_brands_id`, `brandname`,  `category_code`, `product_desc` , `col_1` FROM `assign_brands` WHERE `jrp_account_no`= '$jrp_account_no' ORDER BY `assign_brands`.`col_1` ASC;");
                                                  $count = 0;
                                                  while ($row = mysqli_fetch_array($result))
                                                  { 
                                                                $count= $count+1;
                                                                $assign_brands_id = $row['assign_brands_id'];
                                                                $brandname = $row['brandname'];
                                                                $category_code = $row['category_code']; 
                                                                $col_1 = $row['col_1'];
                                                            //------------ User table --------------------
                                                            $result2 = mysqli_query($con, "SELECT * FROM `user` where user_excol2='$jrp_account_no'");                
                                                            $row1 = mysqli_fetch_array($result2);
                                                                $user_id1 = $row1['user_id'];
                                                                $first_name = $row1['first_name'];  
                                                                $last_name = $row1['last_name']; 
                                                                $user_excol2 = $row1['user_excol2'];  
                                                          //------------ Product code table --------------------  
                                                          $result_product_desc = mysqli_query($con, "SELECT `product_desc` FROM `product_code` WHERE `category_code`='$category_code' and `category_code`!=''");                
                                                          $row_product_desc = mysqli_fetch_array($result_product_desc);
                                                          $product_desc = $row_product_desc['product_desc'];                 
                                                          ?>
                                                          <tr>
                                                              <td><?php echo $count;?></td>
                                                              <td>
                                                                <input type="hidden" name="jrp_account_no" value="<?php echo $jrp_account_no;?>"> 
                                                                <input type="checkbox" name="assign_brands_id[]" value="<?php echo $assign_brands_id;?>">
                                                              </td>
                                                              <td><?php echo $brandname;?></td>
                                                              <td><?php echo $category_code.">".$product_desc;?></td>
                                                              <td><?php 
                                                              if($col_1=='1')
                                                              {echo "Permitted";}
                                                              if($col_1=='0')
                                                              {echo "<code>On Hold</code>";}
                                                              ?>
                                                              </td>
                                                          </tr>
                                                          <?php
                                                    }
                                                    ?>                            
                                            </tbody>
                                      </table>
                                  <button type="submit" name="add" value="add" class="btn btn-info btn-sm">Delete</button>
                              </form>
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
    <!-- ================================================================================================= -->
            <script>
                function toggle(source) 
                {
                var checkboxes = document.querySelectorAll('input[name="assign_brands_id[]"]');
                for (var i = 0; i < checkboxes.length; i++) 
                  {
                     if (checkboxes[i] != source)
                     checkboxes[i].checked = source.checked;
                  }                          
                }
            </script>
    <!-- ================================================================================================= --> 
   