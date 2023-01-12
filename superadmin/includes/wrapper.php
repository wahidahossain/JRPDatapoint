<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <?php
                $page_title = 0;
                if($account_type=='superadmin'){
                  $page_title ="Super Admin Panel";
                }
                if($account_type=='admin'){
                  $page_title ="Admin Panel";
                }
                if($account_type=='staff'){
                  $page_title ="Staff Panel";
                }
                $page_title_new =  $page_title;
                ?> 

                  <h1 class="m-0"><?php echo $page_title_new;?></h1>
                  <table padding="7px" width="500px" height="80px">
                        <tr>
                        <!-- <th scope="col"><div align="center"><a href="add_new_customer.php"><img src="dist/img/a (3).png"  width="64px" height="64px"></a></div></th>
                          <th scope="col"><div align="center"><a href="dashboard.php"><img src="dist/img/b (2).png"  width="64px" height="64px"></a></div></th> -->
                          <th scope="col"><div align="center"><a href="new_bunch_assignment_clients.php"><img src="dist/img/a (1).png"  width="64px" height="64px"></a></div></th>
                          <th scope="col"><div align="center"><a href="new_assignment_clients.php"><img src="dist/img/a (2).png" class="" alt="User Image" width="64px" height="64px"></a></div></th>    
                          <th scope="col"><div align="center"><a href="assign_brands_list.php"><img src="dist/img/c (1).png" class="" alt="User Image" width="64px" height="64px"></a></div></th>
                          <th scope="col"><div align="center"><a href="template_bunch_create_step1.php"><img src="dist/img/c (2).png" class="" alt="User Image" width="64px" height="64px"></a></div></th>
                          <th scope="col"><div align="center"><a href="template_create_step1.php"><img src="dist/img/a (6).png" class="" alt="User Image" width="64px" height="64px"></a></div></th>
                          <th scope="col"><div align="center"><a href="assign_template_list.php"><img src="dist/img/c (3).png" class="" alt="User Image" width="64px" height="64px"></a></div></th>
                          <th scope="col"><div align="center"><a href="waiting_list_ov.php"><img src="dist/img/a (5).png" class="" alt="User Image" width="64px" height="64px"></a></div></th>
                        </tr>
                        <tr>
                        <!-- <th scope="col"><div align="center"><a href="add_new_customer.php">Add Clients</a></div></th>
                        <th scope="col"><div align="center"><a href="dashboard.php">Clients List</a></div></th> -->
                          <th scope="col"><div align="center"><a href="new_bunch_assignment_clients.php">Manual Brands</a></div></th>
                          <th scope="col"><div align="center"><a href="new_assignment_clients.php">Manual Category</a></div></th>
                          <th scope="col"><div align="center"><a href="assign_brands_list.php">Manual List</a></div></th>    
                          <th scope="col"><div align="center"><a href="template_bunch_create_step1.php">Static Brands</a></div></th>
                          <th scope="col"><div align="center"><a href="template_create_step1.php">Static Category</a></div></th>    
                          <th scope="col"><div align="center"><a href="assign_template_list.php">Static List</a></div></th>
                          <th scope="col"><div align="center"><a href="waiting_list_ov.php">Check approval status</a></div></th>
                        </tr>
                    </table>               
              </div><!-- /.col -->          
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>