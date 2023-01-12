<!-- Main content -->
<section class="content">
 <div class="container-fluid">
    <form role="form" action="../model/request_brand.php" id="myForm1" method="post" class="needs-validation" novalidate>
        <div class="row">    
            <?php
            //profile_id user_id jrp_account_no company_name address1 city postal_code state contact_no col1col2col3col4col5col6col7
            include ("../model/connect.php");
            //========================== check in profile table ===============================
            $user_id=$_SESSION['user_id'];
            $result_profile = mysqli_query($con, "SELECT `request_brands_id`, `brand_name`, `path` FROM `request_brands` WHERE `brand_name` NOT IN (SELECT `brand` FROM `filter_brands`)");                
            while($row_profile = mysqli_fetch_array($result_profile)){ 
                $request_brands_id = $row_profile['request_brands_id'];                  
                $brand_name = $row_profile['brand_name'];
                $path = $row_profile['path'];
            ?>
            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
            <div class="col-md-2 col-sm-4 col-8">
                <div class="info-box">
                <!-- <span class="info-box-icon bg-info"><img src="brand_logo/"></span> -->
                <div class="info-box-content">          
                    <span class="info-box-number"><img src="<?php echo $path;?>" height="180px" width="210px"></span>
                    <span class="info-box-text">            
                        <input type="checkbox" name="brand_name[]" value="<?php echo $brand_name;?>">&nbsp;&nbsp;<?php echo $brand_name;?>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <?php
            }
            ?>
            <!-- /.col -->                   
        </div>
        <button id="submitBtn" type="submit" class="btn btn-info btn-block btn-flat fixed-bottom"><i class="fa fa-envelope-open"></i> &nbsp;Request Brands</button> 
          <!-- table ends -->  
   </div><!-- /.container-fluid -->
  </section>
   