<section class="content">
      <div class="container-fluid">
        <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Admin Information & Login Access</h3>
              </div>

               <form name=form1 method=post action="../model/add_new_admin.php" id="myForm1" class="needs-validation" novalidate>
                <div class="card-body">
                
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>             
                    <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name" required>
                  </div> 
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name" required>
                  </div>

                  <div class="form-group">
                      <label>User Type</label>
                      <?php
                      if($account_type=='superadmin'){
                      ?>
                      <select class="form-control" required name="account_type">
                      <option selected value="">Select an Account Type</option>
                            <option value="superadmin">Superadmin</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>

                          </select>
                          <?php } ?>
                          <?php
                      if($account_type=='admin'){
                      ?>
                      <select class="form-control" required name="account_type">
                      <!-- <option selected value="">Select an Account Type</option> -->
                            <!-- <option value="superadmin">Superadmin</option>
                            <option value="admin">Admin</option> -->
                            <option value="staff" selected>Staff</option>

                          </select>
                          <?php } ?>
                    </div>                                                 
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail Address" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Login Username (JRP Account No.)</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter JRP Account No." required />
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

          <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">JRP Datapoint Internal User List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>SL</th>                    
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Account Status</th>
                    <th>Logcount</th>
                    <th>Last Login</th>
                    <th>Account Type</th>
                    <th>Access</th>
                    <th>Operations</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                include ("../model/connect.php");
                if($account_type=='superadmin'){
                  $result = mysqli_query($con, "SELECT * FROM `user` where account_type!='customer'");
                }
                else{
                  $result = mysqli_query($con, "SELECT * FROM `user` where account_type!='customer' AND account_type!='superadmin'");

                }
                $count = 0;
                while ($row = mysqli_fetch_array($result))
                {
                    $count = $count + 1;
                    $user_id1 = $row['user_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $email_new = $row['email'];
                    $account_status = $row['account_status'];
                    $logcount = $row['logcount'];
                    $last_login = $row['last_login'];
                    $ip = $row['ip'];
                    $account_type0 = $row['account_type'];
                    $user_excol1_new = $row['user_excol1'];  
                    $user_excol2_new = $row['user_excol2'];  
                    //================= Flag ============
                    $result_flag = mysqli_query($con, "SELECT COUNT(*) as 'flag_cnt', `flag_1` FROM `flags` WHERE `jrp_account_no`='$user_excol2_new'");                    
                    $row_flag = mysqli_fetch_array($result_flag);
                    $flag_1 = $row_flag['flag_1'];
                    $flag_cnt = $row_flag['flag_cnt'];                    
                    ?>
                    <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $first_name;?></td>
                    <td><?php echo $last_name;?></td>
                    <td><?php echo $username;?></td>
                    <td><?php echo $email_new;?></td>
                    <td><?php
                    if($account_status==1)
                    {
                      echo "Active";
                    }
                    else
                    {
                      echo "Inactive";
                    }
                    ?></td>
                    <td><?php echo $logcount;?></td>
                    <td><?php echo $last_login;?></td>
                    <td><?php echo $account_type0;?></td>
                    <td><?php echo $user_excol1_new;?></td>
                    <td>
                    <?php 
                    if($account_type=='superadmin')
                    {
                      ?> 
                        <a href="change_password.php?user_id1=<?php echo $user_id1;?>"><i class="fa fa-edit fa-fw"></i>Reset Password</a>
                      <?php
                    }
                    ?>
                      <br><a href="../model/block_user.php?user_id1=<?php echo $user_id1;?>&user_excol1=<?php echo $user_excol1_new;?>" onclick="return confirm('Are you sure you want to un/block this account?')"><i class="fa fa-window-close fa-fw"></i>Un/Block</a>
                      <a href="../model/active_inactive_acc.php?user_excol2=<?php echo $user_excol2_new;?>&account_status=<?php echo $account_status;?>&tmp=1"><i class="fa fa-edit fa-fw"></i>In/Active Acc.</a>
                    
                      <br><a href="../model/notify_admin.php?user_id1=<?php echo $user_id1;?>&email=<?php echo $email_new;?>&type=<?php echo $user_excol2_new;?>"><i class="fa fa-envelope fa-fw"></i>Send E-mail Activation Link</a>
                      <?php   
                      if($flag_cnt<'1')
                      {
                        if ($flag_1 != '1') 
                        {      
                        echo "<code>Not Sent</code>";
                      } 
                      }
                    else
                    {
                      echo "<code><img src='dist/img/select.png' alt='AdminLTELogo' height='20' width='20'></code>";
                    }
                    ?>     
                    </td>
                    </tr>
                    <?php
                    }
                    ?>                </tbody>
                  <tfoot>
                  <tr>
                  <th>SL</th>                    
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Account Status</th>
                    <th>Logcount</th>
                    <th>Last Login</th>
                    <th>Account Type</th>
                    <th>Access</th>
                    <th>Operations</th>
                  </tr>
                  </tfoot>
                </table>              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
        </div>
      </div>  
    </section>


   

  
   