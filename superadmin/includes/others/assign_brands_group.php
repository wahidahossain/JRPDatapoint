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
    <form role="form" action="../model/assign_brands_group.php" >
        <div class="card-body">
            <div class="row">
              <div class="col-md-4">
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
                <tr>
        <?php
        $sub=mysqli_query($con, "SELECT * FROM `product_code` WHERE `category_code` != '' AND `product_desc` NOT REGEXP BINARY '^[A-Z]+$'");
        $suboption='';
        while($row=  mysqli_fetch_assoc($sub))
        {
            $suboption .='<option value = "'.$row['category_code'].'">'.$row['product_desc'].'</option>';
        }
        ?>
      <td width="15%">Product Category :</td>
        <td id="add_subject"><div id="add_subject1">
            <select name="subject" id="subject" onchange="subjectskills(this.value)">
                <option value="">Select Category</option>
                <?php echo $suboption; ?>
            </select>
            </div>
        </td>
    </tr>
    <div id="check_box">
    <?php 
    $from = 0;
    if(isset($_GET['from']))
    {
        $from=$_GET['from'];
        //echo"<input type='checkbox' value='$from'>$from";
    }
?>
    <!-- <input type="checkbox" onclick="toggle(this);" />Check all?..<br />   -->
        
    </div>
        <!-- ================================================================================================= -->
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
    <!-- ================================================================================================= -->
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


