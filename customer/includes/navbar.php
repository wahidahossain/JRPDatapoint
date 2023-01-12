<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-header"></li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reports                
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                My profile
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <!-- <a href="export_reports.php" class="nav-link"> -->
            <a href="export_new.php?jrp_account_no=<?php echo $user_excol2;?>" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Download Feed
              </p>
            </a>
          </li>
          <li class="nav-item">            
            <a href="request_brand.php?jrp_account_no=<?php echo $user_excol2;?>" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Request a Brand
                
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