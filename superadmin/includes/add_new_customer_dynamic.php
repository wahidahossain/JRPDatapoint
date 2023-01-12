<section class="content">
    <div class="container-fluid">
        <div class="col-md-6">
               <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">New JRP Datapoint Client Information & Login Access</h3>
                          </div>
                          <form name=form1 method=post action="../model/add_new_customer.php" id="myForm1" class="needs-validation" novalidate>
                            <div class="card-body">
                                <a href="add_new_customer.php" name="Add New" class="btn btn-primary" class="col-md-3">Add New</a>
                                <div class="form-group">
                                      <label for="exampleInputEmail1">JRP Account No.</label>                    
                                          <div>
                                                  <select name="type" style="width: 100%;"  tabindex="-1" aria-hidden="true" onchange="getval(this);">                   
                                                        <?php                                            
                                                            include("../model/connect.php");
                                                            $tp=$_REQUEST['tp']; 
                                                            $results_customer = mysqli_query($con, "SELECT * FROM `bv_customer`");                                                
                                                            while ($row_customer = mysqli_fetch_array($results_customer))                       
                                                        {         
                                                                $jrp_account_no = $row_customer['jrp_account_no'];                                      
                                                                ?>                         
                                                                <option value="<?php echo $jrp_account_no;?>"><?php echo $jrp_account_no;?></option>
                                                                <?php  
                                                        }                     
                                                                  $results_customer1 = mysqli_query($con, "SELECT * FROM `bv_customer` where jrp_account_no ='$tp' ");
                                                                  $row_customer1 = mysqli_fetch_array($results_customer1); 
                                                                      $jrp_account_no = $row_customer1['jrp_account_no']; 
                                                                      $customer_name = $row_customer1['customer_name'];
                                                                      $company_name = $row_customer1['company_name'];
                                                                      $address1 = $row_customer1['address1'];
                                                                      $address2 = $row_customer1['address2'];
                                                                      $city = $row_customer1['city'];
                                                                      $state = $row_customer1['state'];
                                                                      $postal_code = $row_customer1['postal_code'];
                                                                      $customer_name = $row_customer1['customer_name'];
                                                                      $email = $row_customer1['email'];
                                                                      $contact_no = $row_customer1['contact_no'];  
                                                                      $jrp_account_no_renamed = preg_replace('/[^A-Za-z0-9\-]/', '', $jrp_account_no);             
                                                                ?>                    
                                                        <option value="<?php echo $tp;?>" selected="selected"><?php echo $tp;?></option> 
                                                  </select>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                      <label>Business Name</label>
                                      <input type="text" value="<?php echo $company_name;?>"  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Business Name" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Client Name</label>             
                                      <input type="text" value="<?php echo $customer_name;?>" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required>
                                    </div>
                              
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="email" value="<?php echo $email;?>" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail Address" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Report Rule Set</label>  
                                        <select class="form-control" required name="report_rule_set_no">
                                                  <option selected value="">Select an option</option>
                                                  <option value="0|1">Manual Option 1 (Qty more than 0)</option>
                                                  <option value="0|2">Manual Option 2 (In stock: y/n)</option>
                                                  <option value="0|3">Manual Option 3 (Qty: Actual Quantity)</option>
                                                  <?php                      
                                                      $results_template_list = mysqli_query($con, "SELECT * FROM `report_indexes` where flag='1'");
                                                      while($row_template_list = mysqli_fetch_array($results_template_list)){ 
                                                      $report_indexes_id = $row_template_list['report_indexes_id']; 
                                                      $index_name = $row_template_list['index_name'];
                                                      $flag = $row_template_list['flag'];  
                                                      echo "<option value='".$report_indexes_id."|1'>".$index_name."> (Qty more than 0) </option>";
                                                      echo "<option value='".$report_indexes_id."|2'>".$index_name."> (In stock: y/n) </option>";
                                                      echo "<option value='".$report_indexes_id."|3'>".$index_name.">  (Qty: Actual Quantity)</option>";
                                                        }
                                                    ?>
                                          </select>
                                  </div>

                                  <div class="card-header">
                                    <h3 class="card-title">FTP Access</h3>
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">FTP Username</label>             
                                    <input type="text" name="user_excol3" readonly value="<?php echo $jrp_account_no_renamed;?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
                                  </div>

                                  <div class="form-group">
                                  <label for="exampleInputEmail1">FTP Password</label> 
                                    <input type="text" id="pwdId2" name="user_excol4" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*?[~`!@#$%\^&*()\-_=+[\]{};:\x27.,\x22\\|/?><])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <div class="valid-feedback">Valid</div>
                                    <div class="invalid-feedback">** at least one number and one uppercase and lowercase letter, one special character, and at least 8 or more characters</div>
                                  </div>  

                                  <div class="card-header">
                                    <h3 class="card-title">Login Access</h3>
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Login Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $tp;?>" readonly placeholder="Enter login username" required />
                                  </div>

                                  <div class="form-group">
                                    Password<input type="text" id="pwdId" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*?[~`!@#$%\^&*()\-_=+[\]{};:\x27.,\x22\\|/?><])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <div class="valid-feedback">Valid</div>
                                    <div class="invalid-feedback">** at least one number and one uppercase and lowercase letter, one special character, and at least 8 or more characters</div>
                                  </div>

                                  <div class="form-group">
                                    Confirm Password<input type="text" id="cPwdId" class="form-control pwds">
                                    <div id="cPwdValid" class="valid-feedback">Valid</div>
                                  </div>

                                  <div class="form-group">
                                    <button id="submitBtn" type="submit" class="btn btn-primary submit-button" disabled>Submit</button>
                                  </div>
                            </form>             
               </div>           
          </div>
      </div>        
  </section>

  
   