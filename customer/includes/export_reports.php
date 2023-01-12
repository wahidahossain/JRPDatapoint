<?php
include_once ('../model/connect.php');
$jrp_account_no = $user_excol2;
$result_assign_brand = mysqli_query($con, "SELECT * FROM `assign_template` WHERE `jrp_account_no`='$user_excol2' ");
$row_assign_brand = mysqli_fetch_array($result_assign_brand);
$report_indexes_id = $row_assign_brand['report_indexes_id'];
$generate_rule = $row_assign_brand['generate_rule'];
if($report_indexes_id=='0'){
?>
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- form start -->

        <div class="col-md-12">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">JRP Datapoint Reports</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="col-md-12 head">
    <div class="float-right">
        <!-- <a href="export.php" class="btn btn-success"><i class="dwn"></i> Export</a> -->
        <!-- <a href="export_sub.php?user_id=<?php //echo $user_id;?>" class="btn btn-success"><i class="dwn"></i>Export Report</a> -->
        <a href="export_new.php?jrp_account_no=<?php echo $jrp_account_no;?>" class="btn btn-success"><i class="dwn"></i>Export Report</a>
        
    </div>
</div>
<div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>BRAND</th>
                    <th>JRPSKU</th>
                    <th>OEMSKU</th>
                    <th>DESCRIPTION</th>
                    <th>QTY</th>
                    <th>COST</th>
                    <th>MAP</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                include_once '../model/connect.php';
    
                $result_assign_brand1 = mysqli_query($con, "SELECT `category_code`,`brandname` FROM `assign_brands` WHERE `jrp_account_no`='$jrp_account_no'");
                while ($row_assign_brand1 = mysqli_fetch_array($result_assign_brand1))
                {
                  $category_code = $row_assign_brand1['category_code'];
                  $brandname = $row_assign_brand1['brandname'];
                  $query = "SELECT `brand`,`jrpsku`,`description`, SUM(`onhand`) as onhand, SUM(`commited`) as commited,`cost`,`map`,`col_1`, `oemsku` FROM `stock` 
                            WHERE `brand` = '$brandname' AND `prod` = '$category_code' GROUP BY `jrpsku`;";
                            $result_stock = mysqli_query($con, $query);            
                        
                        while($row_stock = mysqli_fetch_array($result_stock))
                        {
                                    $brand = ($row_stock['brand']);
                                    $jrpsku = ($row_stock['jrpsku']);
                                    $oemsku = ($row_stock['oemsku']);
                                    $onhand = ($row_stock['onhand']);
                                    $commited = ($row_stock['commited']);
                                    $cost = ($row_stock['cost']);
                                    $map = ($row_stock['map']);
                                    $wh = ($row_stock['col_1']);

                                    $description1 = str_replace("||||","'",$row_stock['description']);
                                    $description2 = str_replace(","," ",$description1);
                                    $qty = $onhand - $commited;
                                          // OPTION 1        
                                          if($generate_rule=='1'){                                      
                                            if($qty>'0') // Print only rows got more than 0
                                            {                                        
                                                ?>
                                                <tr>
                                                    <td><?php echo $brand;?></td>
                                                    <td><?php echo $jrpsku;?></td>
                                                    <td><?php echo $oemsku;?></td>
                                                    <td><?php echo $description2;?></td>
                                                    <td><?php //echo $qty;?></td>
                                                    <td><?php echo $cost;?></td>
                                                    <td><?php echo $map;?>
                                                  </td>
                                                </tr>
                                                <?php
                                                }
                                              }                                              
                                          // OPTION 2
                                          if($generate_rule=='2'){
                                          if($qty>0){
                                          $qty_message = "Yes";
                                          }
                                          else{
                                            $qty_message = "No";
                                          }
                                          ?>
                                          <tr>
                                            <td><?php echo $brand;?></td>
                                            <td><?php echo $jrpsku;?></td>
                                            <td><?php echo $oemsku;?></td>
                                            <td><?php echo $description2;?></td>
                                            <td><?php echo $qty_message;?></td>
                                            <td><?php echo $cost;?></td>
                                            <td><?php echo $map;?></td>
                                          </tr>
                                          <?php
                                          }
                                          // OPTION 3
                                          if($generate_rule=='3'){
                                            ?>
                                            <tr>
                                              <td><?php echo $brand;?></td>
                                                <td><?php echo $jrpsku;?></td>
                                                <td><?php echo $oemsku;?></td>
                                                <td><?php echo $description2;?></td>
                                                <td><?php echo $qty;?></td>
                                                <td><?php echo $cost;?></td>
                                                <td><?php echo $map;?></td>
                                              </tr>
                                            <?php
                                            }
                                          }
                                        }
                                          ?>                                 
                  </tbody>
                  <tfoot>
                        <tr>
                          <th>BRAND</th>
                          <th>JRPSKU</th>
                          <th>OEMSKU</th>
                          <th>DESCRIPTION</th>
                          <th>QTY</th>
                          <th>COST</th>
                          <th>MAP</th>
                        </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        


      <!-- form ends -->  
      </div><!-- /.container-fluid -->
    </section>
    <?php
}
//------------------------------------- Static Template ---------------------------------------------
if($report_indexes_id != '0'){
    ?>
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- form start -->

        <div class="col-md-12">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">JRP Reports</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="col-md-12 head">
    <div class="float-right">
        <!-- <a href="export.php" class="btn btn-success"><i class="dwn"></i> Export</a> -->
        <a href="export_new.php?jrp_account_no=<?php echo $jrp_account_no;?>" class="btn btn-success"><i class="dwn"></i>Export Report</a>
    </div>
</div>
<div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>BRAND</th>
                    <th>JRPSKU</th>
                    <th>OEMSKU</th>
                    <th>DESCRIPTION</th>
                    <th>QTY</th>
                    <th>COST</th>
                    <th>MAP</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                include_once '../model/connect.php';    
                $result_template = mysqli_query($con, "SELECT `brand_name`,`product_code_id`,`warehouse` FROM `template` WHERE `flag`='1' AND `report_indexes_id`='$report_indexes_id' GROUP BY `brand_name`; ");
                While($row_template = mysqli_fetch_array($result_template))
                {             

                            $brand_name = $row_template['brand_name'];
                            $product_code_id = $row_template['product_code_id'];
                            $warehouse = $row_template['warehouse'];
                            //============

                            //===================== product_code 
                            $result_product_code = mysqli_query($con, "SELECT `category_code` FROM `product_code` WHERE `product_code_id`='$product_code_id' AND `flag`='0'");
                            $row_product_code = mysqli_fetch_array($result_product_code);
                            $category_code = $row_product_code['category_code'];                            
                            
                            $result_stock = mysqli_query($con, "SELECT SUM(`onhand`) as onhand,SUM(`commited`) as commited, `brand`,`jrpsku`,`description`,`cost`,`map`,`prod`,`col_1`,`oemsku` 
                                                                FROM `stock` WHERE `brand`= '$brand_name' AND `prod`='$category_code' GROUP BY `jrpsku`;");
                            while ($row_stock = mysqli_fetch_array($result_stock))              
                            {                                               
                                                  $brand = ($row_stock['brand']);
                                                  $jrpsku = ($row_stock['jrpsku']);
                                                  $oemsku = ($row_stock['oemsku']);
                                                  $onhand = ($row_stock['onhand']);
                                                  $commited = ($row_stock['commited']);
                                                  $cost = ($row_stock['cost']);
                                                  $map = ($row_stock['map']);
                                                  $wh = ($row_stock['col_1']);

                                                  $description1 = str_replace("||||","'",$row_stock['description']);
                                                  $description2 = str_replace(","," ",$description1);
                                                  $qty = $onhand - $commited;                                
                                                  if($generate_rule=='1'){
                                                    if($qty>'0')
                                                      { 
                                                                      ?>
                                                  <tr>
                                                  <td><?php echo $brand;?></td>
                                                  <td><?php echo $jrpsku;?></td>
                                                  <td><?php echo $oemsku;?></td>
                                                  <td><?php echo $description2;?></td>
                                                  <td><?php //echo $qty;?></td>
                                                  <td><?php echo $cost;?></td>
                                                  <td><?php echo $map;?>                                                      
                                                  </td>
                                                  </tr>

                                                <?php
                                                    }
                                                    
                                                  
                                                     }//end of template option 1: qty>'0'

                                                     if($generate_rule=='2'){
                                                      if($qty>0){
                                                        $qty_message = "Yes";
                                                        }
                                                        else{
                                                          $qty_message = "No";
                                                        } 
                                                                        ?>
                                                    <tr>
                                                    <td><?php echo $brand;?></td>
                                                    <td><?php echo $jrpsku;?></td>
                                                    <td><?php echo $oemsku;?></td>
                                                    <td><?php echo $description2;?></td>
                                                    <td><?php echo $qty_message;?></td>
                                                    <td><?php echo $cost;?></td>
                                                    <td><?php echo $map;?>                                                      
                                                    </td>
                                                    </tr>
  
                                                  <?php
                                                      
                                                      
                                                    
                                                       }//end of template option 2: Y/N

                                                       if($generate_rule=='3'){
                                                        
                                                                          ?>
                                                      <tr>
                                                      <td><?php echo $brand;?></td>
                                                      <td><?php echo $jrpsku;?></td>
                                                      <td><?php echo $oemsku;?></td>
                                                      <td><?php echo $description2;?></td>
                                                      <td><?php echo $qty;?></td>
                                                      <td><?php echo $cost;?></td>
                                                      <td><?php echo $map;?>                                                      
                                                      </td>
                                                      </tr>
    
                                                    <?php
                                                        
                                                        
                                                      
                                                         }//end of template option 3: Real Stock
                }
                                                                  
              }
                                                  ?>                                 
                  </tbody>                  
                </table>
              </div>
            </div>
          </div>      
      <!-- form ends -->  
      </div><!-- /.container-fluid -->
    </section>
    <?php
}
    ?>
   