<section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create New Template</h3>

            <div class="card-tools">              
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"> -->
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/new_assignment_clients.php" method="POST">
        <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">                  
                <label>Select Client</label>
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Name</label>             
                    <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter first name" required>
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
                      <option value="<?php echo $warehouse_code;?>"><?php echo $warehouse_code;?></option>
                      <?php
                      }
                    ?>
                    </select>
                  </div>
                <tr>
        <?php
        $sub=mysqli_query($con, "SELECT `brand` FROM `stock` WHERE `brand`!='' GROUP BY `brand` order by `brand`; ");
        $suboption='';
        while($row=  mysqli_fetch_assoc($sub))
        {
            $suboption .='<option value = "'.$row['brand'].'">'.$row['brand'].'</option>';
        }
        ?>
      <td width="15%"><label>Brands List</label></td>
        <td id="add_subject"><div id="add_subject1">
            <!-- <select name="brands" id="subject" onchange="subjectskills(this.value)"> -->
            <select name="brands" id="subject" onchange="subjectskills(this.value)">
                <option selected disabled value="">Select a Brand</option>
                <?php echo $suboption; ?>
            </select>
            </div>
        </td>
    </tr>
    <label>Product Category</label>
    <div id="check_box">
    <?php 
    $from = 0;
    if(isset($_GET['from']))
    {
        $from=$_GET['from'];
       
    }
?>   
        
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
                  <button type="submit" name="add" value="add" class="btn btn-primary">Add New</button> 
                  <!-- <a href="new_assignment_clients_e.php?user_excol2=<?php echo $user_excol2;?>" name="edit" class="btn btn-primary">Edit</a>  -->
                  <button type="submit" name="edit" value="edit" class="btn btn-primary">Edit</button> 
                  </form>

                </div>         
          
          <div class="card-footer">
                  
                </div>
      </div>
    </section>


