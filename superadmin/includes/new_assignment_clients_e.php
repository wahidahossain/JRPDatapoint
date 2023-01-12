<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Assign Brands to Client Accounts</h3>

            <div class="card-tools">              
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div> 
          <?php
          $jrp_account_no = $_REQUEST['user_excol2'];
          ?>           
    <form role="form" action="../model/new_assignment_clients.php" method="POST">
        <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">                  
                <label>Select Client</label>
                  <div class="select2-purple">
                    <select class="form-control select2bs4 select2-hidden-accessible" name="user_excol2" data-placeholder="Select a client" style="width: 100%;" data-select2-id="21" tabindex="-1" aria-hidden="true" required>
                    <option selected value="<?php echo $jrp_account_no;?>"><?php echo $jrp_account_no;?></option>
                    <?php
                    include ("../model/connect.php");                    
                    $result = mysqli_query($con, "SELECT user_id, user_excol2 FROM `user` WHERE account_type != 'superadmin' AND user_excol2!='$jrp_account_no' AND `user_id` IN (SELECT `user_id` FROM `assign_template` WHERE `report_indexes_id`='0');");                
                    while ($row_user = mysqli_fetch_array($result))
                   {                    
                    $user_excol2 = $row_user['user_excol2'];
                    $user_id1 = $row_user['user_id'];
                    ?> 
                    <option value="<?php echo $user_excol2;?>"><?php echo $user_excol2;?></option>
                    <?php
                    }
                    ?>
                    </select>
                  </div>
                </div>
                <label>Warehouse List</label>
                  <div class="select2-purple">
                  <select class="select2" multiple="multiple" data-placeholder="Select Warehouse" name="warehouse_code[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    <?php
                   // include ("../model/connect.php");
                    $result = mysqli_query($con, "SELECT `col_1` FROM `stock` group by `col_1`; ");                
                      while ($row = mysqli_fetch_array($result))
                      {                    
                      $warehouse_code = $row['col_1'];
                      ?> 
                      <option value="<?php echo $warehouse_code;?>" selected><?php echo $warehouse_code;?></option>
                      <?php
                      }
                    ?>
                    </select>
                  </div>
                <tr>
        <?php
        $sub=mysqli_query($con, "SELECT `brand` FROM `stock` WHERE `brand`!='' GROUP BY `brand`; ");
        $suboption='';
        while($row=  mysqli_fetch_assoc($sub))
        {
            $suboption .='<option value = "'.$row['brand'].'">'.$row['brand'].'</option>';
        }
        ?>
      <td width="15%"><label>Brands List</label></td>
        <td id="add_subject"><div id="add_subject1">
            <select name="brands" id="subject" onchange="subjectskills0(this.value)">
                <option value="">Select A Brand</option>
                <?php echo $suboption; ?>
            </select>
            </div>
        </td>
    </tr>
    <label>Product Category</label>
    <div id="check_box0">
    <?php 
    $from = 0;
    if(isset($_GET['from']))
    {
        $from=$_GET['from'];
    }
?>
    
        
    </div>

    <script>
        function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) 
            {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>

                </div>
              </div>
            </div>
          </div> 
          <div class="card-footer">
          <button type="submit" name="add" value="add" class="btn btn-primary">Add New</button> 
                  <!-- <a href="new_assignment_clients_e.php?user_excol2=<?php //echo $user_excol2;?>" name="edit" class="btn btn-primary">Edit</a>  -->
                  <!-- <button type="submit" name="edit" value="edit" class="btn btn-primary">Edit</button>  -->
                  </form>
                </div>         
          
          
<!--------------------- EDIT PART ------------------------->
<form role="form" action="../model/new_assignment_clients_edit.php" >
<div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Update Assigned Product Categories For The JRP Acc. No: <?php $jrp_account_no = $_REQUEST['user_excol2']; echo $jrp_account_no;?></h3>
    </div>
<div class="card-body">
<input type="hidden" name="jrp_account_no" value="<?php echo $jrp_account_no;?>">
        <?php        
        $sub=mysqli_query($con, "SELECT `brandname`, GROUP_CONCAT(`category_code`) as `category_code`,
        GROUP_CONCAT(`product_desc`) as `product_desc` FROM `assign_brands` WHERE `jrp_account_no`= '$jrp_account_no' GROUP BY brandname;");
        $suboption='';
        while($row=  mysqli_fetch_assoc($sub))
        {
            $suboption .='<option value = "'.$row['brandname'].'">'.$row['brandname'].'</option>';
        }
        ?>
      <label>Brands List</label>
      <tr>
        <td id="add_subject"><div id="add_subject1">
            <select name="brandname" id="subject" onchange="subjectskills(this.value)">
                <option value="">Select A Brand</option>
                <?php echo $suboption; ?>
            </select>
            </div>
        </td>
    </tr>
    <label>Product Category</label>
    <div id="check_box1">
    <?php 
    $from = 0;
    if(isset($_GET['from']))
    {
        $from=$_GET['from'];       
    }
?>       
    </div>
    <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Delete Product Category</button> </form>
                </div>    
          
    <script>
        function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) 
            {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
    </form>
<!--------------------- EDIT PART ------------------------->
      </div>    
      </div>
      </div>    
      </div>
    </section>


