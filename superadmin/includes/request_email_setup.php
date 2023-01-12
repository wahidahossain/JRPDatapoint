<section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Client Requested e-mail Setup</h3>

            <div class="card-tools">              
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"> -->
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/request_email_setup.php" method="POST">
                <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="position-relative p-3 bg-gray-dark" >
                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Set e-mail ID:</label>
                                                <?php
                                                include ("../model/connect.php");
                                                $result_request_email = mysqli_query($con, "SELECT `request_email` FROM `request_email` where `request_email_id`='1';");                    
                                                $row_request_email = mysqli_fetch_array($result_request_email);
                                                $request_email = $row_request_email['request_email'];                                                
                                                ?>
                                                <input type="email" name="request_email" value="<?php echo $request_email;?>" class="form-control" placeholder="Enter e-mail address" required>
                                                </div>
                                        </div>
                                    </div>
                                    
                                </div>
                              </div>
                            <div class="card-footer">
                                <button type="submit" name="add" value="add" class="btn btn-primary">Change Requested e-mail ID</button>              
                    </form>
                </div>         
          <div class="card-footer"></div>
      </div>
    </section>


