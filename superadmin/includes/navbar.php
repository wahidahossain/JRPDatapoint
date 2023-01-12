
<?php
if($account_type=='superadmin'){
?> 
<!-- start admin navbar -->

<nav class="mt-2"> 
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          <li class="nav-header">

          </li>


            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Global Settings
                  <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">              
                    <li class="nav-item">
                      <a href="filter_product_category.php" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                        Filter Product Category                
                        </p>
                      </a>
                    </li>
                  <li class="nav-item">
                    <a href="filter_brands.php" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                      Filter Brands Category                
                      </p>
                    </a>
                  </li>              
                  <li class="nav-item">
                    <a href="filter_warehouse.php" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                      Warehouse Settings                
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="request_email_setup.php" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                      Request e-mail Setup                
                      </p>
                    </a>
                  </li>            
                </ul>
            </li>
          

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                User Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="add_new_admin.php" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    Internal Admin/Staff                
                  </p>
                </a>
              </li>
                  
                <li class="nav-item">
                <a href="add_new_customer.php" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    Add/Edit Clients                
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    Client List                
                  </p>
                </a>
              </li>
            </ul>
          </li>          
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Filters
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">              
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Assign Brands
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                          <li class="nav-item">
                          <a href="new_assignment_clients.php" class="nav-link" target="blank">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                              New Assignment              
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="new_bunch_assignment_clients.php" class="nav-link" target="blank">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                            Bunch Brand Assignment              
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="assign_brands_list.php" class="nav-link" target="blank">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                              Assignment List                
                            </p>
                          </a>
                      </li>           
                    </ul>
                  </li>              
              </ul>
            <ul class="nav nav-treeview" style="display: none;">              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Static Templates
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="template_create_step1.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Create</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="template_bunch_create_step1.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Create (Bunch Brands)</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="assign_template_list.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Client Group</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="../model/generate_template.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Generate Reports</p>
                        </a>
                      </li>          
                  </ul>
              </li>              
            </ul>
           </li>

           <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Manual Process
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Imports
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                  <a href="../model/import_bv_data_stock_table.php" class="nav-link" target="blank">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Import Stock                
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../model/import_bv_customer.php" class="nav-link" target="blank">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Import Customer                
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../model/import_bv_product_code_table.php" class="nav-link" target="blank">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Import Product Code                
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../model/import_bv_data_special_price.php" class="nav-link" target="blank">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Import Special Pricing                
                    </p>
                  </a>
                </li>
                  
                </ul>

              </li>
              <li class="nav-item">
            <!-- <a href="../model/general_ftp_export.php" class="nav-link" target="blank"> -->
            <a href="batch_export.php" class="nav-link" target="blank">
              <i class="nav-icon fas fa-circle"></i>
              <p>Batch FTP Export</p>
            </a>
           </li> 
            </ul>
          </li>

          <li class="nav-item">
            <a href="waiting_list.php" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                template Approval List
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
            </li>
          
          <li class="nav-item">
            <a href="../model/logout.php" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
          
        </ul>
        </nav>
<?php } ?>

<?php
if($account_type=='admin'){
?> 
<!-- start admin navbar -->

<nav class="mt-2"> 
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          <li class="nav-header">
          </li>         
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                User Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="add_new_admin.php" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    Add Staff                
                  </p>
                </a>
              </li>   
                <li class="nav-item">
                <a href="add_new_customer.php" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    Add/Edit Clients                
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    Client List                
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Filters
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">              
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Assign Brands
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                          <li class="nav-item">
                          <a href="new_assignment_clients.php" class="nav-link" target="blank">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                              New Assignment              
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="new_bunch_assignment_clients.php" class="nav-link" target="blank">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                            Bunch Brand Assignment              
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="assign_brands_list.php" class="nav-link" target="blank">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                              Assignment List                
                            </p>
                          </a>
                      </li>           
                    </ul>
                  </li>              
              </ul>
            <ul class="nav nav-treeview" style="display: none;">              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Static Templates
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="template_create_step1.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Create (Individual Category)</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="template_bunch_create_step1.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Create (Brands)</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="assign_template_list.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Client Group</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="../model/generate_template.php" class="nav-link" target="blank">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>Generate Reports</p>
                        </a>
                      </li>          
                  </ul>
              </li>              
            </ul>
           </li>

        
          
          <li class="nav-item">
            <a href="../model/logout.php" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
          
        </ul>
        </nav>
<?php } ?>



<!-- start staff navbar -->

<?php
if($account_type=='staff'){
?>
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
<li class="nav-header"></li>
          
       

        <li class="nav-item">
          <a href="reset_password.php" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Reset Password</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../model/logout.php" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
        
      </ul>
      </nav>
      <?php } ?>





     