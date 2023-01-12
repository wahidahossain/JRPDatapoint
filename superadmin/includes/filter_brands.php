<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Filter Brands</h3>

            <div class="card-tools">              
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>            
    <form role="form" action="../model/filter_brands.php" >
        <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">                  
                    <label>Select Brands</label>
                    <div class="select2-purple">
                        <select class="select2" multiple="multiple" data-placeholder="Select Brands" name="brand[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                            <?php
                         include ("../model/connect.php");
                            $result = mysqli_query($con, "SELECT `brand` FROM `stock` WHERE `brand`!='' and `brand` NOT IN (SELECT `brand` FROM `filter_brands`) GROUP BY `brand` order by `brand`;");                
                            while ($row = mysqli_fetch_array($result))
                            {                    
                                $brand = $row['brand'];
                            ?> 
                            <option value="<?php echo $brand;?>"><?php echo $brand;?></option>
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
        <h3 class="card-title">Filtered Brand List</h3>
        <?php       
        $result0 = mysqli_query($con, "SELECT COUNT(*)as total FROM filter_brands");
        $row0 = mysqli_fetch_array($result0);    
        $total = $row0['total'];
        if($total=='0') { 
            
            echo "<br><br><br> No filters added yet!!!";
        }
        else{
        ?>
        <form role="form" action="../model/filter_brands_remove.php">
          <table id="example1" class="table table-bordered ">
                <?php                   
                    $sql    = "SELECT * FROM filter_brands";
                    $result = mysqli_query($con, $sql);
                    $i = 0;
                    while ($row = mysqli_fetch_row($result)) {

                        if($i == 0) {
                            echo "<tr><td><input type='checkbox' name='filter_brands_id[]' value=".$row[0]."> " . $row[1] . "</td>";
                            $i++;
                        } elseif ($i == 1) {
                            echo "<td><input type='checkbox' name='filter_brands_id[]' value=".$row[0]."> " . $row[1] ."</td>";
                            $i++;
                        } elseif($i == 2) {
                            echo "<td><input type='checkbox' name='filter_brands_id[]' value=".$row[0]."> " .$row[1] ."</td></td>";
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

    


