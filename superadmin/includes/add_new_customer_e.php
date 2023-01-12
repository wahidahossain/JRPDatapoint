<section class="content">
      <div class="container-fluid">
        <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Client Information & Login Access</h3>
              </div>               
                <div class="card-body">
                <a href="add_new_customer.php" name="Add New" class="btn btn-primary" class="col-md-3">Add New</a>
                <a href="add_new_customer_e.php" name="edit" class="btn btn-primary" class="col-md-3">Edit</a>
                <form name=form1 method=get action="../model/add_new_customer_e.php" id="myForm1" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="exampleInputEmail1">JRP Account No.</label>                    
                    <div>
                    <select name="type" style="width: 100%;"  tabindex="-1" aria-hidden="true" onchange="getval(this);">
                    <option selected value="">Select a Client Account</option>                   
                    <?php                    
                         //?type=0 &last_name=10X+Tuning+&first_name=Gary+Wong&email=wahida%40jrponline.com&user_excol3=&user_excol4=&username=10XTUN                   
                        include("../model/connect.php");
                        error_reporting(0);
                        $tp=$_REQUEST['tp']; 
                        $results_customer = mysqli_query($con, "SELECT * FROM `user` WHERE `account_type`='customer' AND user_excol2 !='$tp'");                                                
                        while ($row_customer = mysqli_fetch_array($results_customer))                        
                    {         
                              $user_excol2 = $row_customer['user_excol2'];                              
                    ?> 
                        <!-- <option value="<?php echo $user_excol2;?>" onclick="reload()"; ><?php echo $user_excol2;?></option> -->
                        <option value="<?php echo $user_excol2;?>"><?php echo $user_excol2;?></option>
                    <?php  }                     
                      $results_customer1 = mysqli_query($con, "SELECT * FROM `user` where user_excol2 ='$tp' ");
                      $row_address = mysqli_fetch_array($results_customer1);
                      $user_id = trim($row_address['user_id']);  
                      $first_name1 = trim($row_address['first_name']);
                      $last_name1 = trim($row_address['last_name']);
                      $username = trim($row_address['username']);
                      $email1 = trim($row_address['email']);
                      $user_excol3 = trim($row_address['user_excol3']);
                      $user_excol4 = trim($row_address['user_excol4']);                
                    ?>
                    <?php if($tp==TRUE) {?>
                    <!-- <option value="<?php //echo $tp;?>" onclick="reload()"; selected="selected"><?php //echo $tp;?></option> -->
                    <option value="<?php echo $tp;?>" selected="selected"><?php echo $tp;?></option>
                    <?php } ?>
                    </select>
                  </div>
                  </div>

                  <div class="form-group">
                    <label>Company / Business Name</label>
                    <input type="text" value="<?php echo $last_name1;?>"  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Business Name" required>
                    <input type="hidden" value="<?php echo $user_id;?>"  name="user_id" >
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Client Name</label>             
                    <input type="text" value="<?php echo $first_name1;?>"   name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" value="<?php echo $email1;?>" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail Address" required>
                  </div>

                  <?php                       
                    $results_customer_profile = mysqli_query($con, "SELECT * FROM `profile` WHERE `jrp_account_no` ='$tp' ");
                    //`company_name` `address1` `city` `postal_code` `state` `contact_no` 
                    $row_address_profile = mysqli_fetch_array($results_customer_profile);  
                    //$company_name = trim($row_address_profile['company_name']);
                        $address1 = trim($row_address_profile['address1']);
                        $city = trim($row_address_profile['city']);
                        $postal_code = trim($row_address_profile['postal_code']);
                        $state = trim($row_address_profile['state']);
                        $contact_no = trim($row_address_profile['contact_no']);             
                    ?>
                  <div class="card-header">
                <h3 class="card-title">Client Profile</h3>
              </div>
              
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>             
                    <input type="text" value="<?php echo $address1;?>" name="address1" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">City</label>             
                    <input type="text" value="<?php echo $city;?>" name="city" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Postal Code</label>             
                    <input type="text" value="<?php echo $postal_code;?>" name="postal_code" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">State</label>             
                    <input type="text" value="<?php echo $state;?>" name="state" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact No # </label>             
                    <input type="text" value="<?php echo $contact_no;?>" name="contact_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                  </div>
                  <?php                       
                    $results_report_rule_set_no = mysqli_query($con, "SELECT `report_rule_set_no` FROM `report_rule_set` WHERE `jrp_acc_no`='$tp' ");
                    $row_report_rule_set_no = mysqli_fetch_array($results_report_rule_set_no);  
                        $report_rule_set_no = $row_report_rule_set_no['report_rule_set_no']; 
                       
                    ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Report Rule Set</label> 
                    <code> Currently Assigned :  <?php
                    $results_template_list1 = mysqli_query($con, "SELECT `report_indexes_id`, `generate_rule` FROM `assign_template` WHERE  `jrp_account_no`='$tp';");
                    $row_template_list1 = mysqli_fetch_array($results_template_list1);
                    
                    $index_name1 = $row_template_list1['index_name']; 
                    $generate_rule = $row_template_list1['generate_rule']; 
                    $report_indexes_id2 = $row_template_list1['report_indexes_id'];


                    $results_template_name = mysqli_query($con, "SELECT * FROM `report_indexes` where `report_indexes_id`='$report_indexes_id2'");
                    $row_template_name = mysqli_fetch_array($results_template_name); 
                    $index_name1 = $row_template_name['index_name']; 

                    //1: qty>0 2: qty=y/n 3: qty=real stock 
                    if($generate_rule=='1')	{$set_rule = "qty>0";}
                    if($generate_rule=='2')	{$set_rule = "qty=y/n";}
                    if($generate_rule=='3')	{$set_rule = "qty=real stock";}
                    // Manual Template ============
                    if($row_template_list1['report_indexes_id']!='0') {
                    echo "$index_name1"." : $set_rule";
                    }
                    else
                    {                      
                      echo "Manual Report Assignment > "."$set_rule";
                    }
                    // Static Template ============
                    if($report_indexes_id2!='0'){
                    ?>


                        <select class="form-control" required name="report_rule_set_no">
                        <option selected value="">Select an option</option>
                          <?php                      
                              $results_template_list = mysqli_query($con, "SELECT * FROM `report_indexes` where flag='1'");
                              while($row_template_list = mysqli_fetch_array($results_template_list)){ 
                              $report_indexes_id = $row_template_list['report_indexes_id']; 
                              $index_name = $row_template_list['index_name'];
                              $flag = $row_template_list['flag'];  
                              echo "<option value='".$report_indexes_id."|1'>".$index_name."> (Qty>0) </option>";
                              echo "<option value='".$report_indexes_id."|2'>".$index_name."> (In stock: y/n) </option>";
                              echo "<option value='".$report_indexes_id."|3'>".$index_name.">  (Qty: All Real Numbers)</option>";
                                }
                              }
                              
                            ?>
                        </select>
                        <?php
                        if($report_indexes_id2=='0'){
                        ?>
                        <select class="form-control" required name="report_rule_set_no">
                          <option selected value="">Select an option</option>
                          <option value="0|1">Manual Option 1 (Qty>0)</option>
                          <option value="0|2">Manual Option 2 (In stock: y/n)</option>
                          <option value="0|3">Manual Option 3 (Qty: All Real Numbers)</option>
                          
                        </select>
                        <?php } ?>
                        </code></div>
                  <div class="card-header">
                <h3 class="card-title">FTP Access</h3>
              </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">FTP Username</label>             
                    <input type="text" value="<?php echo $user_excol3;?>" readonly name="user_excol3" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
                  </div>
                 
                  <div class="form-group">
                  <label for="exampleInputEmail1">FTP Password</label> 
                    <input type="text" id="pwdId" value="<?php echo $user_excol4;?>" name="user_excol4" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*?[~`!@#$%\^&*()\-_=+[\]{};:\x27.,\x22\\|/?><])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback">** at least one number and one uppercase and lowercase letter, one special character, and at least 8 or more characters</div>
                  </div>

                  <div class="card-header">
                    <h3 class="card-title">Login Access</h3>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Login Username</label>
                    <input type="text" value="<?php echo $username;?>" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter login username" required />
                  </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary submit-button">Update</button>
                </div>
                </form>             
            </div>
            <div class="card-body">
          </div>
          </div>
          </div>
        </div>
      </div>
    </section>

  
   