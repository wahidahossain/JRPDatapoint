<section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Imported Records Look-up</h3>

            
          </div>            
   
      <div class="card-body">       
                 
      <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right"> --> 
            <ol class="card card-default col-sm-6 card-header">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> -->
              <li class="nav-link"><a href="#">Data Records:</a>
              <a href="#">Stock :</a>
              <?php 
              include ("../model/connect.php");
              include ("../model/bv_connect.php"); 
               $sql = mysqli_query($con, "SELECT COUNT(*) as 'stock_total' FROM `stock`;");
               $row = mysqli_fetch_array($sql);
               echo "MySQL : ".$stock_total = $row['stock_total'];
               
               //======= BV ==========

               $result_wh = mysqli_query($con, "SELECT GROUP_CONCAT(`warehouse`) as 'warehouse' FROM `warehouse` WHERE `flag`='1'; ");
               $row_wh = mysqli_fetch_array($result_wh);
               $warehouse = $row_wh['warehouse'];


               $import = odbc_exec($connection, "SELECT COUNT(*) as 'bv_stock_total'  
               FROM PRICING, INVENTORY
               WHERE PRICING . BVSPECPRICEWHSE  =  INVENTORY . WHSE AND
               PRICING . BVSPECPRICESOURCEID  =  INVENTORY . PRICESOURCECONST AND
               PRICING . BVSPECPRICEPARTNO  =  INVENTORY . CODE AND INVENTORY . HOLD = '0' AND
               INVENTORY . E_COMMERCE = '1' AND PRICING . BVSPECPRICEWHSE IN ($warehouse)");               
                          $row_import = @odbc_fetch_array($import);
                          echo "/ BV : ". $bv_stock_total = $row_import['bv_stock_total'];
               ?>
               </li>
              
               <li class="nav-link"><a href="#">Special Pricing:</a>
              <?php //include ("../model/connect.php"); 
               $sql = mysqli_query($con, "SELECT COUNT(*) as 'special_pricing' FROM `special_pricing` WHERE 1;");
               $row = mysqli_fetch_array($sql);
               echo "MySQL : ".$special_pricing = $row['special_pricing'];
               
               //======= BV ==========
               $import = odbc_exec($connection, "select COUNT(*) as 'bv_special_pricing'  from SPECIAL_PRICING where BVSPECPRICEWHSE = '00'");               
                          $row_import = @odbc_fetch_array($import);
                          echo "/ BV : ". $bv_special_pricing = $row_import['bv_special_pricing'];
               
               ?>
               </li>
               <li class="nav-link"><a href="#">Ware House:</a>
              <?php //include ("../model/connect.php"); 
               $sql = mysqli_query($con, "SELECT COUNT(*) as 'warehouse' FROM `warehouse` WHERE 1;");
               $row = mysqli_fetch_array($sql);
               echo "MySQL : ".$warehouse = $row['warehouse'];
               
               //======= BV ==========
               $import = odbc_exec($connection, "select COUNT(*) as 'bv_warehouse' from WAREHOUSE");               
                          $row_import = @odbc_fetch_array($import);
                          echo "/ BV : ". $bv_warehouse = $row_import['bv_warehouse'];
               
               ?>
               </li>
               <li class="nav-link"><a href="#">Product Code:</a>
              <?php //include ("../model/connect.php"); 
               $sql = mysqli_query($con, "SELECT COUNT(*) as 'product_code' FROM `product_code` WHERE 1;");
               $row = mysqli_fetch_array($sql);
               echo "MySQL : ".$product_code = $row['product_code'];
               
               //======= BV ==========
               $import = odbc_exec($connection, "SELECT COUNT(*) as 'bv_product_code' FROM PRODUCT_CODE Where CODE NOT LIKE '%00'");               
                          $row_import = @odbc_fetch_array($import);
                          echo "/ BV : ". $bv_product_code = $row_import['bv_product_code'];
               
               ?>
               
               </li>
               <li class="nav-link"><a href="#">Customer:</a>
              <?php 
              //======= Mysql ==========
              //include ("../model/connect.php"); 
               $sql = mysqli_query($con, "SELECT COUNT(*) as 'customer' FROM `bv_customer`;");
               $row = mysqli_fetch_array($sql);
               echo "MySQL : ".$customer = $row['customer'];
               
               //======= BV ==========
               $import = odbc_exec($connection, "SELECT COUNT(*) as 'bv_customer' FROM ADDRESS LEFT JOIN CUSTOMER ON ADDRESS.CEV_NO=CUSTOMER.CUS_NO WHERE RECORD_TYPE = 'CUST' AND ADDR_TYPE = 'B'");               
                          $row_import = @odbc_fetch_array($import);
                          echo "/ BV : ". $bv_customer = $row_import['bv_customer'];
               ?>               
               </li>
               

            </ol>
          </div><!-- /.col -->
                </div>

        
    </section>
    
    


