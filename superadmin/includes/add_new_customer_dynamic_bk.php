<section class="content">
      <div class="container-fluid">
        <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Client Information & Login Access</h3>
              </div>
               <form name=form1 method=post action="../model/add_new_customer.php" class="needs-validation">
                <div class="card-body">
                <a href="add_new_customer.php" name="Add New" class="btn btn-primary" class="col-md-3">Add New</a>
                <a href="add_new_customer_e.php" name="edit" class="btn btn-primary" class="col-md-3">Edit</a>
                <div class="form-group">
                    <label for="exampleInputEmail1">JRP Account No.</label>                    
                    <div>
                    <select name="type" style="width: 100%;"  tabindex="-1" aria-hidden="true" >                   
                    <?php
                                            
                        include("../model/bv_connect.php");
                        $tp=$_REQUEST['tp']; 
                        $results_customer = odbc_exec($connection, "select NAME, CUS_NO from CUSTOMER CUS_NO");                                                
                        while ($row_customer = @odbc_fetch_array($results_customer))
                        
                    {         
                              $CUS_NO = $row_customer['CUS_NO'];
                              
                    ?> 
                        <option value="<?php echo $CUS_NO;?>" onclick="reload()";><?php echo $CUS_NO;?></option>
                    <?php  } 
                    
                    $results_customer1 = odbc_exec($connection, "select NAME from CUSTOMER where CUS_NO ='$tp' ");
                    $row_customer1 = @odbc_fetch_array($results_customer1);  
                    $NAME = $row_customer1['NAME'];                
                    ?>
                    <option value="<?php echo $tp;?>" onclick="reload()"; selected="selected"><?php echo $tp;?></option>
                    </select>
                  </div>
                  </div>

                  <div class="form-group">
                    <label>Business Name</label>
                    <input type="text" value="<?php echo $NAME;?>"  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Business Name" required>
                  </div>

                  <?php                        
                        $results_address = odbc_exec($connection, "select BVCOCONTACT1NAME, BVCOCONTACT1EMAIL from ADDRESS where CEV_NO = '$tp'");                      
                        $row_address = @odbc_fetch_array($results_address);
                        $BVCOCONTACT1NAME = $row_address['BVCOCONTACT1NAME'];
                        $BVCOCONTACT1EMAIL = $row_address['BVCOCONTACT1EMAIL'];
                    ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Client Name</label>             
                    <input type="text" value="<?php echo $BVCOCONTACT1NAME;?>"   name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" value="<?php echo $BVCOCONTACT1EMAIL;?>" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail Address" required>
                  </div>

                  <div class="card-header">
                <h3 class="card-title">FTP Access</h3>
              </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">FTP Username</label>             
                    <input type="text" name="user_excol3" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
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
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter login username" required />
                  </div>


                  <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                    <input type="text" name="password" class="form-control" id="pwdId" placeholder="Enter login Password" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback">a to z only (2 to 6 long)</div>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1"> Re-enter Password:</label>
                    <input type="text" id="cPwdId" name="confirm_password" class="form-control myCpwdClass">
                    <div id="cPwdValid" class="valid-feedback">Passwords Match</div>
                    <div id="cPwdInvalid" class="invalid-feedback">a to z only (2 to 6 long)</div>
                  </div>
                </div>
                <div class="card-footer">
                <button id="submitBtn" type="submit" class="btn btn-primary submit-button" disabled>Submit</button>
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

  
   