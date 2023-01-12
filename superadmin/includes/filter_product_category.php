<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Filter Product Category</h3>

            <div class="card-tools">              
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/filter_product_category.php" >
        <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">                  
                    <label>Select Product Category</label>
                    <div class="select2-purple">
                        <select class="select2" multiple="multiple" data-placeholder="Select Product Categories" name="product_code_id[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                            <?php
                         include ("../model/connect.php");
                            $result = mysqli_query($con, "SELECT `product_code_id`,`category_code`,`product_desc` FROM `product_code` WHERE `flag`='0'");                
                            while ($row = mysqli_fetch_array($result))
                            {                    
                                $product_code_id = $row['product_code_id'];
                                $category_code = $row['category_code'];
                                $product_desc = $row['product_desc'];
                            ?> 
                            <option value="<?php echo $product_code_id;?>"><?php echo $category_code;?> > <?php echo $product_desc;?></option>
                            <?php
                            }
                            ?>
                            </select> 
                    </div>           
                </div>
              </div>           
          </div> 
          <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Filter</button>
                </div>         
          </form>
      </div>


      <div class="card-body">
      <h3 class="card-title">Filtered Product Category List</h3>
      <?php

       
    $result0 = mysqli_query($con, "SELECT COUNT(*)as total FROM product_code where `flag`='1'");
    $row0 = mysqli_fetch_array($result0);    
    $total = $row0['total'];
    if($total=='0') { 
            
            echo "<br><br><br> No filters added yet!!!";
        }
        else{
        ?>


      <form role="form" action="../model/filter_product_category_remove.php" >          
      <table id="example1" class="table table-bordered ">
                <?php                   
                    $sql    = "SELECT * FROM product_code where `flag`='1'";
                    $result = mysqli_query($con, $sql);
                    $i = 0;
                    while ($row = mysqli_fetch_row($result)) {

                        if($i == 0) {
                            echo "<tr><td><input type='checkbox' name='product_code_id[]' value=".$row[1]."> " . $row[1] ." > ". $row[2] . "</td>";
                            $i++;
                        } elseif ($i == 1) {
                            echo "<td><input type='checkbox' name='product_code_id[]' value=".$row[1]."> " . $row[1] ." > ". $row[2] . "</td>";
                            $i++;
                        } elseif($i == 2) {
                            echo "<td><input type='checkbox' name='product_code_id[]' value=".$row[1]."> " .$row[1] ." > ". $row[2]. "</td></td>";
                            $i = 0;
                        }

                    }
                    ?>
                </table>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Remove Filter</button>
                </div>         
          </form>
                </div>

            <?php
                    }
            ?>
    </section>

    


