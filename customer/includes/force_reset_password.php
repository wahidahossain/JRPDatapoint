<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- form start -->



        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                  Launch Default Modal
                </button>


      <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reset Password</h3>
              </div>
              <?php
                include ("../model/connect.php");
                //$user_id1 = $_REQUEST['user_id1'];                       
                    ?>
               <form role="form" action="../model/change_password_customer.php" class="needs-validation">
                <div class="card-body">
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1">New Password</label>
                    <input name = "user_id1" type="hidden" value=<?php //echo $user_id1;?> >
                    <input type="text" name ="password" id="password" placeholder="Enter login Password" class="form-control">
                    <span id = "message" style="color:red">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1"> Re-enter Password:</label>
                    <input type="text" id="confirm_password" name="confirm_password" class="form-control">
                  </div> 
                </div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->



                <div class="form-group">
                <input name = "user_id1" type="hidden" value=<?php echo $user_id1;?> >
                  <label for="exampleInputPassword1">New Password</label>
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
        </div>
      </div><!-- /.container-fluid -->
    </section>
   