
<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add new brands</h3>

            <div class="card-tools">              
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/assign_brands.php" >
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                
                <label>Select Client</label>
                  <div class="select2-purple">
                    <select class="form-control select2bs4 select2-hidden-accessible" name="user_id" data-placeholder="Select a client" style="width: 100%;" data-select2-id="21" tabindex="-1" aria-hidden="true">
                    <?php
                    include ("../model/connect.php");
                    $result = mysqli_query($con, "SELECT user_id, user_excol2 FROM `user` WHERE account_type != 'superadmin' AND user_excol2!='';");                
                    while ($row_user = mysqli_fetch_array($result))
                    {                    
                    $user_excol2 = $row_user['user_excol2'];
                    $user_id1 = $row_user['user_id'];
                    ?> 
                    <option value="<?php echo $user_id1;?>"><?php echo $user_excol2;?></option>
                    <?php
                    }
                    ?>
                    </select>
                  </div>
                </div>
                  <label>Brand List</label>
                  <div class="select2-purple">
                  <select class="select2" multiple="multiple" data-placeholder="Select Brands" name="brands[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    <?php
                    include ("../model/connect.php");
                    $result = mysqli_query($con, "SELECT brand FROM `stock` WHERE brand != '' AND brand IS NOT NULL group by (brand); ");                
                    while ($row = mysqli_fetch_array($result))
                {                    
                    $brands = $row['brand'];
                    ?> 
                    <option value="<?php echo $brands;?>"><?php echo $brands;?></option>
                    <?php
                }
                    ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div> 
          <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>         
          </form>
      </div>
    </section>