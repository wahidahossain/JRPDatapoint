<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- form start -->

        <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New JRP Datapoint Client Information & Login Access</h3>
              </div>

              
              <!-- /.card-header -->
              <!-- form start -->

               <!-- <form name=form1 method=post action="../model/add_new_customer.php"> -->
               <form name=form1 method=post action="add_new_customer.php" onSubmit="return validate();" id="myForm1" class="needs-validation" novalidate>
                <div class="card-body">
                <a href="add_new_customer.php" name="Add New" class="btn btn-primary" class="col-md-3">Add New</a>
                <!-- <a href="add_new_customer_e.php" name="edit" class="btn btn-primary" class="col-md-3">Edit</a> -->
                <div class="form-group">
                 
                    <label for="exampleInputEmail1">JRP Account No.</label>
                    <!-- <input type="text" name="user_excol2" class="form-control" id="exampleInputEmail1" placeholder="Enter account number"> -->
                    <div>
                    <select name="type" style="width: 100%;"  tabindex="-1" aria-hidden="true" required onchange="getval(this);">
                    <option selected value="">Select a Client Account</option>

                    <?php
                        //----------------------- Search and fetch from bv---------------------
                        
                        include("../model/bv_connect.php");
                        include("../model/connect.php");
                        //--------------------- BV CUSTOMER Table -----------------------------
                        $tp='0';
                       // $tp=$_REQUEST['tp']; // getting the value from query string
                        //if($tp=='undefined'){                                                   
                       //  $results_customer = mysqli_query($con, "select * from bv_customer jrp_account_no ='$tp' "); 
                       // }
                       // else{
                          //================= in mysql table ============================
                          /*$check_customer_list = mysqli_query($con, "SELECT `user_excol2` FROM `user` where `account_type`='customer'; ");
                          while ($row_check_customer_list = mysqli_fetch_array($check_customer_list)){
                          $user_excol2_check = $row_check_customer_list['user_excol2'];  */                       
                          //================= end of in mysql table ======================
                          //$results_customer = mysqli_query($con, "SELECT `customer_name`, `jrp_account_no` FROM `bv_customer` where jrp_account_no <> '$user_excol2_check' ");
                          $results_customer = mysqli_query($con, "SELECT `customer_name`, `jrp_account_no` FROM `bv_customer`"); 
                                                                                                                         
                        while ($row_customer = mysqli_fetch_array($results_customer))
                    {         $NAME = $row_customer['customer_name'];
                              $CUS_NO = $row_customer['jrp_account_no'];
                    ?> 
                        <!-- <option value="<?php //echo $CUS_NO;?>" onclick="reload()";><?php //echo $CUS_NO;?></option>  -->
                        <option value="<?php echo $CUS_NO;?>" ><?php echo $CUS_NO;?></option> 
                    <?php
                    }
                 // }
                 // }                   
                    ?>
                    </select>
                    
                  </div>

                  </div>
                  <!-- <?php
                      if(strlen($tp) > 1){
                        
                        $results_address = mysqli_query($con, "SELECT * FROM `bv_customer` where jrp_account_no = '$tp'");                      
                        $row_address = mysqli_fetch_array($results_address);
                        $BVCOCONTACT1NAME = $row_address['customer_name'];
                        $BVCOCONTACT1EMAIL = $row_address['email'];
                    ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Client Name</label>             
                    <input type="text" value="<?php echo $BVCOCONTACT1NAME;?>"   name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter first name" required>
                  </div>
                  <div class="form-group">
                    <label>Business Name</label>
                    <input type="text" value="<?php //echo $NAME;?>"  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter last name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" value="<?php echo $BVCOCONTACT1EMAIL;?>" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email address" required>
                  </div>  
<?php
                       } 
                      else{
?>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Client Name</label>             
                    <input type="text" value=""   name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required>
                  </div>
                  <div class="form-group">
                    <label>Business Name</label>
                    <input type="text" value=""  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Business Name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" value="" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email address" required>
                  </div>  
                  <?php 
                  }                
                  ?>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Report Rule Set</label>  
                    <select class="form-control" required name="report_rule_set_no">
                          <option selected value="">Select an option</option>
                          <option value="nontemp|1">Individual Option 1 (Qty>0)</option>
                          <option value="nontemp|2">Individual Option 2 (In stock: y/n)</option>
                          <option value="nontemp|3">Individual Option 3 (Qty: All Real Numbers)</option>
                          <?php                      
                              // $results_template_list = mysqli_query($con, "SELECT * FROM `report_indexes` where flag='1'");
                              // while($row_template_list = mysqli_fetch_array($results_template_list)){ 
                              // $report_indexes_id = $row_template_list['report_indexes_id']; 
                              // $index_name = $row_template_list['index_name'];
                              // $flag = $row_template_list['flag'];  
                              // echo "<option value='".$report_indexes_id."|1'>".$index_name."> (Qty>0) </option>";
                              // echo "<option value='".$report_indexes_id."|2'>".$index_name."> (In stock: y/n) </option>";
                              // echo "<option value='".$report_indexes_id."|3'>".$index_name.">  (Qty: All Real Numbers)</option>";
                              //   }
                            ?>
                        </select>
                   </div>

              <div class="card-header">
                <h3 class="card-title">FTP Access</h3>
              </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">FTP Username</label>             
                    <input type="text" name="user_excol3" value="<?php echo $tp;?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">FTP Password</label>             
                    <input type="text" name="user_excol4" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                  </div>

                 


                  <div class="card-header">
                    <h3 class="card-title">Login Access</h3>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Login Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter login username">
                  </div>
                  <div class="form-group">
                    Password<input type="text" id="pwdId" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback">** at least one number and one uppercase and lowercase letter, and at least 8 or more characters</div>
                  </div>
                  <div class="form-group">
                    Confirm Password<input type="text" id="cPwdId" class="form-control pwds">
                    <div id="cPwdValid" class="valid-feedback">Valid</div>
                    
                  </div>
                  <div class="form-group">
                    <button id="submitBtn" type="submit" class="btn btn-primary submit-button" disabled>Submit</button>
                  </div> -->
              </form>
              <!--<div class="card card-body">
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Import</h3>
              </div>              
              <div class="span6" id="form-login">
              <form action="../model/import_new_customer.php" method="post" enctype="multipart/form-data">
            <input class="form-control" type="file" name="file" /> 
            <input class="btn btn-primary"  type="submit" class="btn btn-primary" name="importSubmit" value="Upload">
        </form>
        </div>
      </div> -->
      </div>
    </div>
  </div>
</div>
     <!-- form ends -->  
      </div><!-- /.container-fluid -->
    </section>
   
   