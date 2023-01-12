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
                        <h3 class="card-title">Static Template Approval List</h3>
                     </div>             
                                
                        <div class="card-body">
                        <?php
                        include ("../model/connect.php");
                        $result = mysqli_query($con, "SELECT * FROM `report_indexes` where `report_indexes_id` IN (SELECT `report_indexes_id` FROM `template` WHERE `flag`='0');");
                       
                        if (mysqli_num_rows($result) == '0')
                                                  {
                                                  echo "No Waiting Template Approval List Found!";
                                                  }
                                                  ?>
                          <table id="example1" class="table table-bordered ">
                              <tbody>                 
                                        <?php
                                       //error_reporting(0);
                                      
                                      while ($row = mysqli_fetch_array($result))
                                      { 
                                          $index_name = $row['index_name'];
                                          $report_indexes_id = $row['report_indexes_id'];
                                          
                                      //------------ assign_template table --------------------
                                      ?>  
                                  <tr>
                                    <td>
                                      <br>
                                      <div class="lead">
                                          Template Name: <b><a href="waiting_list_details.php?report_indexes_id=<?php       
                                          echo $report_indexes_id;?>"><?php echo $index_name;?></a></b> 
                                                     
                                      </div>
                                      <?php 
                                      } 
                                      ?>
                                      </td>
                                      </tr>                       
                                </tbody>
                            </table>
                          </div>             
                      </div>            

                    <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Client Approval List</h3>
                          </div>
                          <!-- /.card-header -->                                
                          <div class="card-body">
                            <?php
                            include ("../model/connect.php");
                            $result1 = mysqli_query($con, "SELECT * FROM `waiting_client_approval_list` ");
                            if (mysqli_num_rows($result1) == '0')
                                                  {
                                                  echo "No Waiting Client Approval List Found!";
                                                  }
                            ?>
                            <table id="example1" class="table table-bordered ">                  
                              <tbody>                 
                                    <?php
                                  
                                  //error_reporting(0);                                  
                                  while ($row1 = mysqli_fetch_array($result1))
                                  { 
                                      $jrp_account_no = $row1['jrp_account_no'];
                                      $report_indexes_id1 = $row1['report_indexes_id'];
                                      $generate_rule = $row1['generate_rule'];

                                      if($generate_rule=='1'){
                                        $index_name_filename = "Rule Set: Quantity 0.";
                                    }
                                    if($generate_rule=='2'){
                                        $index_name_filename = "Rule Set: Instock Y/N.";
                                    }
                                    if($generate_rule=='3'){
                                        $index_name_filename = "Rule Set: Actual Stock.";
                                    }


                                      if($report_indexes_id1!='0'){
                                      $result2 = mysqli_query($con, "SELECT `index_name` FROM `report_indexes` WHERE `report_indexes_id`='$report_indexes_id1'");
                                      $row2 = mysqli_fetch_array($result2);
                                      $index_name2 = $row2['index_name'];
                                      }
                                      else{
                                        $index_name2 = "Manual Template";
                                      }
                                  //------------ assign_template table --------------------
                                  ?>              
                              <tr>
                                  <td>
                                    <br>
                                    <?php
                                    if($report_indexes_id1!='0'){
                                    ?>
                                        <div class="lead">
                                          JRP Account No.: <b><a href="waiting_list_details.php?report_indexes_id=<?php echo $report_indexes_id1;?>"><strong><?php echo $jrp_account_no;?> </strong></a> <?php echo $index_name_filename;?>
                                        </div>(Template: <?php echo $index_name2;?>)</b> 
                                    <?php
                                    }
                                    if($report_indexes_id1=='0'){
                                    
                                    ?>
                                        <div class="lead">
                                          JRP Account No.: <b><a href="waiting_list_details.php?jrp_account_no=<?php echo $jrp_account_no;?>&vl=1&report_indexes_id=<?php echo $report_indexes_id1;?>"><strong><?php echo $jrp_account_no;?> </strong></a> <?php echo $index_name_filename;?>
                                        </div>(Template: <?php echo $index_name2;?>)</b> 

                                    <?php } ?>
                                    </td>
                                </tr>
                                  <?php } ?> 
                                  
                                  </td>
                                      </tr>                       
                                </tbody>
                            </table>
                          </div>             
                      </div>


                                  <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Manual Template Approval List</h3>
                          </div>
                          <!-- /.card-header -->                                
                          <div class="card-body">
                          <?php
                        include ("../model/connect.php");
                        $result2 = mysqli_query($con, "SELECT * FROM `assign_brands` WHERE `col_1`='0' GROUP BY `jrp_account_no`; ");
                       
                        if (mysqli_num_rows($result2) == '0')
                                                  {
                                                  echo "No Waiting Template Approval List Found!";
                                                  }
                                                  ?>
                          <table id="example1" class="table table-bordered ">
                              <tbody>                 
                                        <?php
                                       //error_reporting(0);
                                      
                                      while ($row1 = mysqli_fetch_array($result2))
                                      { 
                                          $jrp_account_no = $row1['jrp_account_no'];                                         
                                          
                                      //------------ assign_template table --------------------
                                      ?>  
                                  <tr>
                                    <td>
                                      <br>
                                      <div class="lead">
                                          JRP Account No.: <b><a href="waiting_list_details_manual.php??vl=2&jrp_account_no=<?php echo $jrp_account_no;?>"><strong><?php echo $jrp_account_no;?> </strong></a>
                                        </div></b>
                                      <?php 
                                      } 
                                      ?>
                              </tbody>
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
          </div>
        </section>


              <!-- table ends -->  
              </div><!-- /.container-fluid -->
    </section>
   