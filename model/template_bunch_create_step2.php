<?php
session_start();
include('session.php'); 
//$login=$_SESSION['login'];
        $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];

 if($login=="superadmin"){
 $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];
    ?>
<?php
include ("../model/connect.php");
error_reporting(0);
$report_indexes_id = $_REQUEST['report_indexes_id'];
$index_name = $_REQUEST['index_name'];
if($_POST['add'])
{
                //===================== checking if product category available ===================
                $warehouse_code=$_REQUEST['warehouse_code'];
                $brands=$_REQUEST['brand'];
                
                if($warehouse_code =='' || $brands ==''){
                    print("<script>window.alert('Must Select Warehouse and Brands.');</script>");
                    print("<script>window.location='../superadmin/template_bunch_create_step2.php'</script>");
                }
                else
                { 
                    
                    $brands1=implode(',',$brands);                                  
                        foreach($_REQUEST['brand'] as $brands){

                            $result_prod = mysqli_query($con, "SELECT `prod` FROM `stock` where `brand`='$brands' group by `prod`");
                            while ($row_product_code = mysqli_fetch_array($result_prod)){                                  
                            $prod = $row_product_code['prod'];
                            //SELECT `product_code_id` FROM `product_code` WHERE `category_code`
                            $result_product_code = mysqli_query($con, "SELECT `product_code_id` FROM `product_code` WHERE `category_code`='$prod'");
                            $row_product_code = mysqli_fetch_array($result_product_code);
                            $product_code_id = $row_product_code['product_code_id'];



    
                            //$warehouse_code1=implode(',',$warehouse_code);
                            foreach($_REQUEST['warehouse_code'] as $warehouse_code){                     

                    //=========================== WAREHOUSE TABLE ===========================
                    // $warehouse_code=$_REQUEST['warehouse_code'];
                    // $warehouse_code1=implode(',',$warehouse_code);
                    //==============================END==========================

                    //===========================BRAND TABLE===========================
                    // foreach($_REQUEST['warehouse_code'] as $warehouse){                   
                    // foreach($_REQUEST['category_code'] as $category_code){ 
                        
                        $result_match = mysqli_query($con, "SELECT COUNT(`template_id`) as 'match' FROM `template` WHERE `report_indexes_id`='$report_indexes_id' AND `brand_name`='$brands' AND `product_code_id`='$product_code_id' AND `warehouse`='$warehouse_code'");
                            while ($row_match = mysqli_fetch_array($result_match)){                                  
                            $match = $row_match['match'];

                    if($match== 0)
                    {
                        $insert_query =  mysqli_query($con, "INSERT INTO `template` (`template_id`, `report_indexes_id`, `brand_name`, `product_code_id`, `warehouse`, `col2`, `col3`, `col4`, `flag`, `last_imported`) 
                            VALUES (NULL, '$report_indexes_id', '$brands', '$product_code_id', '$warehouse_code', '', '', '', '0', NOW());") or die( mysqli_error($con));                  
                        
                        if($insert_query)
                        {
                            //print("<script>window.alert('Product category assigned to client accounts successfully');</script>");
                            
                            // Notification code started ====================================================

                                $generate_rule = "0";
                                $result_jrp_account_no = mysqli_query($con, "SELECT GROUP_CONCAT(`jrp_account_no`) as `jrp_account_no` FROM `assign_template` WHERE `report_indexes_id`='$report_indexes_id'");                
                                //if(mysqli_num_rows($result2 > 0)){
                                    $row_jrp_account_no = mysqli_fetch_array($result_jrp_account_no);
                                    $jrp_account_no = $row_jrp_account_no['jrp_account_no']; 
                                
                                $user_excol2_e = $jrp_account_no;
                                include('notify_approval_waiting.php');

                            // Notification code end ====================================================
                            print("<script>window.location='../superadmin/template_bunch_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");
                        }
                    }

                else
                    {
                        print("<script>window.alert('Sorry, Selected Brand already exists in this template.');</script>");
                        print("<script>window.location='../superadmin/template_bunch_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");

                    }

                
            }
            }
        }
                    
                    
            } //end of checking if product category available
 //add condition
        }
    }
 else
{
    print("<script>window.location='../superadmin/template_bunch_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");

}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>