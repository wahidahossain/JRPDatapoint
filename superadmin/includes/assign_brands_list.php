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
                <h3 class="card-title">Edit Client Mapping</h3>
              </div>
              <!-- /.card-header -->
                                
                  <div class="card-body">
                <table id="example1" class="table table-bordered ">
                  <thead>
                  <tr>
                  <th>SL</th>                  
                  <th>Client Number</th>
                    <th>Name</th> 
                    <th>Business Name</th>
                    <th>Edit Mapping</th>
                  <th>Del Mapping</th>                     
                    <!-- <th>Operations</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                include ("../model/connect.php");
                $result_assign_template = mysqli_query($con, "SELECT * FROM `assign_template` WHERE `report_indexes_id`='0';");
                $count = 0;
                while ($row_assign_template = mysqli_fetch_array($result_assign_template))
                { $count= $count+1;
                   $jrp_account_no = $row_assign_template['jrp_account_no'];
                // $result = mysqli_query($con, "SELECT jrp_account_no,GROUP_CONCAT(`brandname`) as brandname FROM `assign_brands` GROUP BY jrp_account_no;");
                // $count = 0;
                // while ($row = mysqli_fetch_array($result))
                // { $count= $count+1;
                //     $jrp_account_no = $row['jrp_account_no'];
                //     $brandname = $row['brandname'];
                //------------ User table --------------------
                $result2 = mysqli_query($con, "SELECT * FROM `user` where user_excol2='$jrp_account_no'");                
                $row1 = mysqli_fetch_array($result2);
                    $user_id1 = $row1['user_id'];
                    $first_name = $row1['first_name'];  
                    $last_name = $row1['last_name']; 
                    $user_excol2 = $row1['user_excol2'];  
              //------------ Product code table --------------------  
                                       
                    ?>

                <tr>
                <td><?php echo $count;?></td>
                 <td><a href="assign_brands_list_details.php?jrp_account_no=<?php echo $jrp_account_no;?>"><?php echo $jrp_account_no;?></a> </td>
                <td><?php echo $first_name;?></td>
                <td><?php echo $last_name;?></td>

                  <!-- <td> -->
                  <!-- <a href="../model/delete_assignment.php?user_id1=<?php echo $user_id1;?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-eraser fa-fw"></i>Delete Assignment</a>
                  <a href="../model/ftp_download.php?user_id1=<?php echo $user_id1;?>&user_excol2=<?php echo $user_excol2;?>"><i class="fa fa-eraser fa-fw"></i>FTP Download</a> -->
                  <!-- <a href="../model/send_report_by_email.php?user_id1=<?php echo $user_id1;?>&user_excol2=<?php echo $user_excol2;?>"><i class="fa fa-eraser fa-fw"></i>Send Reports</a> -->
                  <!-- </td> -->
                  <td width="50px"><a href="new_assignment_clients.php?jrp_account_no=<?php echo $jrp_account_no;?>"><i class="nav-icon fas fa-edit"></i></a></td>
                  <td width="50px"><a href="../model/delete_assignment.php?flag=1&user_excol2=<?php echo $jrp_account_no;?>" onclick="return confirm('Are you sure, you want to delete all assignments for this client?')"><i class="material-icons" style="font-size:20px">delete_forever</i></a></td>
               </tr>
                  
                  <?php
                  }
               // }
                  ?>                                 
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>SL</th>                  
                  <th>Client Number</th>
                    <th>Name</th> 
                    <th>Business Name</th>
                    <th>Edit Mapping</th>
                  <th>Del Mapping</th>          
                    <!-- <th>Operations</th> -->
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
   