<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- form start -->

      <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reset Password</h3>
              </div>
              <?php
                include ("../model/connect.php");
                $jrp_account_no = $user_excol2; 
                $email=$_SESSION['email'];                  
                    ?>
               <form role="form" action="../model/reset_password.php" id="myForm1" class="needs-validation" novalidate>
               <input name = "jrp_account_no" type="hidden" value=<?php echo $jrp_account_no;?> >
                <input name = "email" type="hidden" value=<?php echo $email;?> >
                    <div class="card-body">
                    <div class="form-group">
                    Password<input type="text" id="pwdId" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*?[~`!@#$%\^&*()\-_=+[\]{};:\x27.,\x22\\|/?><])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback">** at least one number and one uppercase and lowercase letter, one special character, and at least 8 or more characters</div>
                  </div>
                  <div class="form-group">
                    Confirm Password<input type="text" id="cPwdId" class="form-control pwds">
                    <div id="cPwdValid" class="valid-feedback">Valid</div>
                    <!-- <div id="cPwdInvalid" class="invalid-feedback">a to z only (2 to 4 long)</div> -->
                  </div>
                  <div class="form-group">
                    <button id="submitBtn" type="submit" class="btn btn-primary submit-button" disabled>Submit</button>
                  </div>

                    </div>
              </form>            
        </div>
      </div><!-- /.container-fluid -->
  </section>
   