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
                <h3 class="card-title">JRP Datapoint Clients</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>SL</th>
                    <th>Acc No.</th>
                    <th>Client Name</th>
                    <th>Business Name</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>FTP</th>
                    <th>Account Status</th>
                    <th>Logcount</th>
                    <th>Last Login</th>
                    <!-- <th>IP</th> -->
                    <!-- <th>Account Type</th> -->
                    <th>Access</th>
                    <th>Report Type</th>
                    <th>Operations</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  error_reporting(0);
                // Full texts 	user_id 	first_name 	last_name 	username 	password 	email 	account_status 	logcount 	last_login 	ip 	account_type 	user_excol1 	user_excol2 	user_excol3 	user_excol4
                include ("../model/connect.php");

                $result = mysqli_query($con, "SELECT * FROM `user` where account_type='customer'");

                $count = 0;
                while ($row = mysqli_fetch_array($result))
                {
                    $count = $count + 1;
                    $user_id1 = $row['user_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $email = $row['email'];
                    $account_status = $row['account_status'];
                    $logcount = $row['logcount'];
                    $last_login = $row['last_login'];
                    $ip = $row['ip'];
                    $account_type = $row['account_type'];
                    $user_excol1 = $row['user_excol1'];  
                    $user_excol2 = $row['user_excol2'];  
                    $user_excol3 = $row['user_excol3'];
                    $user_excol4 = $row['user_excol4'];

                    //================= Flag ============
                    $result_flag = mysqli_query($con, "SELECT COUNT(*) as 'flag_cnt', `flag_1`, `flag_2`  FROM `flags` WHERE `jrp_account_no`='$user_excol2'");                    
                    $row_flag = mysqli_fetch_array($result_flag);
                    $flag_1 = $row_flag['flag_1'];
                    $flag_2 = $row_flag['flag_2'];
                    $flag_cnt = $row_flag['flag_cnt'];

                    //================= assign_template ============
                    $result_flag = mysqli_query($con, "SELECT `generate_rule`, `report_indexes_id` FROM `assign_template` WHERE `jrp_account_no`='$user_excol2'");                    
                    $row_flag = mysqli_fetch_array($result_flag);
                    $report_indexes_id = $row_flag['report_indexes_id'];
                    if ($report_indexes_id != 0)   //1: qty>0 2: qty=y/n 3: qty=real stock  
                      {
                        $report_indexes_id_set = "<a href='assign_template_list.php'>Static";
                      }
                      if ($report_indexes_id == 0)   //1: qty>0 2: qty=y/n 3: qty=real stock  
                      {
                        $report_indexes_id_set = "<a href='assign_brands_list.php'>Manual";
                      }
                      if($report_indexes_id == '')
                      {
                        $report_indexes_id_set = "<code>Waiting for approval</code>";
                      }

                    
                      $generate_rule = $row_flag['generate_rule'];
                      $assign_rule_type = '0';
                      if ($generate_rule=='1')   //1: qty>0 2: qty=y/n 3: qty=real stock  
                      {
                        $assign_rule_type = 'Qty greater than 0';
                      } 
                      if ($generate_rule=='2')   //1: qty>0 2: qty=y/n 3: qty=real stock  
                      {
                        $assign_rule_type = 'In stock qty: Y/N';
                      } 
                      if ($generate_rule=='3')   //1: qty>0 2: qty=y/n 3: qty=real stock  
                      {
                        $assign_rule_type = 'Qty: Actual Stock';
                      }  
                      $assign_rule_type1=$assign_rule_type;           
                    ?>

<tr>  
<td><?php echo $count;?></td>
<td><?php echo $user_excol2;?></td>
<td><?php echo $first_name;?></td>
<td><?php echo $last_name;?></td>
<td><?php echo $username;?></td>
<td><?php echo $email;?></td>
<td>Username: <?php echo $user_excol3;?><br>Password: <?php echo $user_excol4;?></td>
<td><?php

if($account_status==1){
  echo "Active";
}
else{
  echo "Inactive";
}
//echo $account_status;?></td>
<td><?php echo $logcount;?></td>
<td><?php echo $last_login;?></td>
<!-- <td><?php echo $ip;?></td> -->
<!-- <td><?php //echo $account_type;?></td> -->
<td><?php echo $user_excol1;?></td>
<td>
<?php echo $report_indexes_id_set;?><br />
Rule Set:<?php echo $assign_rule_type1;?>
</td>
<td><a href="change_password.php?user_id1=<?php echo $user_id1;?>"><i class="fa fa-edit fa-fw"></i>Reset Password</a>
<a href="add_new_customer_e.php?tp=<?php echo $user_excol2;?>"><i class="fa fa-edit fa-fw"></i>Edit</a><br />
<a href="../model/active_inactive_acc.php?user_excol2=<?php echo $user_excol2;?>&account_status=<?php echo $account_status;?>"><i class="fa fa-edit fa-fw"></i>In/Active Acc.</a>
  <!-- &nbsp;<a href="../model/delete_user.php?user_id1=<?php //echo $user_id1;?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-eraser fa-fw"></i>Delete</a> -->
  <br><a href="../model/block_user.php?user_id1=<?php echo $user_id1;?>&user_excol1=<?php echo $user_excol1;?>" onclick="return confirm('Are you sure you want to un/block this account?')"><i class="fa fa-window-close fa-fw"></i>Un/Block Acc.</a>
  <br><a href="../model/notify.php?user_id1=<?php echo $user_id1;?>&email=<?php echo $email;?>&type=<?php echo $user_excol2;?>"><i class="fa fa-envelope fa-fw"></i>Send E-mail Activation Link</a>
  <?php  
  if($flag_cnt<='1'){
    if ($flag_1 == '1') {      
      echo "<code><img src='dist/img/select.png' height='20' width='20'></code>";
  } 
  else{
    echo "<code><img src='dist/img/iconx.png' height='20' width='20'></code>";  
  } 
  }
  ?>
    
    <br><a href="../model/notify_ftp_admin.php?user_id1=<?php echo $user_id1;?>&email=<?php echo $email;?>&user_excol2=<?php echo $user_excol2;?>"><i class="fa fa-envelope fa-fw"></i>Send E-mail for FTP Access</a>
    
    <?php  
  if($flag_cnt<='1'){
    if ($flag_2 == '1') {
      echo "<code><img src='dist/img/select.png' height='20' width='20'></code>";        
    }  
    else{
      echo "<code><img src='dist/img/iconx.png' height='20' width='20'></code>";
    }
}
?>
  <!-- &nbsp;&nbsp;<a href="../model/notify.php?email=<?php //echo $email;?>&user_id1=<?php //echo $user_id1;?>"><i class="fa fa-envelope fa-fw"></i>Notify</a> -->
</td>
</tr>
<?php
}
?>                </tbody>
                  <tfoot>
                  <tr>
                  <th>SL</th>
                    <th>Acc No.</th>
                    <th>Client Name</th>
                    <th>Business Name</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>FTP</th>
                    <th>Account Status</th>
                    <th>Logcount</th>
                    <th>Last Login</th>
                    <!-- <th>IP</th> -->
                    <!-- <th>Account Type</th> -->
                    <th>Access</th>
                    <th>Report Type</th>
                    <th>Operations</th>
                  </tr>
                  </tfoot>
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
   