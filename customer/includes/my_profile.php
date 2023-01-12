<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Table start -->
        
                 <?php
               //profile_id user_id jrp_account_no company_name address1 city postal_code state contact_no col1col2col3col4col5col6col7
                include ("../model/connect.php");

                //========================== check in profile table ===============================
                $user_id=$_SESSION['user_id'];
                $result_profile = mysqli_query($con, "SELECT * FROM `profile` where jrp_account_no = '$user_excol2'");                
                $row_profile = mysqli_fetch_array($result_profile);                   
                    $jrp_account_no = $row_profile['jrp_account_no'];
                    $company_name = $row_profile['company_name'];
                    $address1 = $row_profile['address1'];
                    $city = $row_profile['city'];
                    $postal_code = $row_profile['postal_code'];
                    $state = $row_profile['state'];
                    $contact_no = $row_profile['contact_no'];                     
                    //========================== check in user table ===============================
                    $result_user = mysqli_query($con, "SELECT * FROM `user` where user_excol2 = '$user_excol2'");                
                    $row_user = mysqli_fetch_array($result_user);                   
                    $customer_name = $row_user['first_name'];
                    $business_name = $row_user['last_name'];
                    $email = $row_user['email'];
                    $user_excol3 = $row_user['user_excol3'];
                    $user_excol4 = $row_user['user_excol4'];
                    ?>
                    <div class="card card-primary card-outline">
                              <div class="card-body box-profile">                
                                      <h3 class="profile-username text-center">Name: <?php echo $customer_name;?></h3>
                                        <p class="text-muted text-center">JRP Account Number: <?php echo $jrp_account_no;?></p>
                                          <ul class="list-group list-group-unbordered mb-3">
                                          <li class="list-group-item">
                                            <b>Business Name: <?php echo $business_name;?></b>
                                          </li>
                                          <li class="list-group-item">
                                            Address: <?php echo $address1;?>
                                          <br>
                                            City: <?php echo $city;?>, Postal Code: <?php echo $postal_code;?>, State: <?php echo $state;?>
                                          </li>
                                          <li class="list-group-item">
                                            Contact No. <?php echo $contact_no;?>
                                          </li>
                                          <li class="list-group-item">
                                            e-mail: <?php echo $email;?>
                                          </li>
                                          <li class="list-group-item">
                                            <b>FTP Username: <?php echo $user_excol3;?></b><br>                  
                                            <b>FTP Password: <?php echo $user_excol4;?></b>
                                          </li>
                                        </ul>
                                        <a href="change_password.php?jrp_account_no=<?php echo $jrp_account_no;?>&email=<?php echo $email;?>"><i class="fa fa-edit fa-fw"></i>Reset Password</a> &nbsp;&nbsp;   
                                        <a href="request_ftp_password_reset.php?jrp_account_no=<?php echo $jrp_account_no;?>&email=<?php echo $email;?>"><i class="fa fa-edit fa-fw"></i>FTP Reset Password Request</a>
                                  </div>
                            </div>
        </div>
    </section>
   