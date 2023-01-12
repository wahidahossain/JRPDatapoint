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
error_reporting(E_ERROR);
$jrp_account_no = $_REQUEST['user_excol2'];
if($_POST['add'])
{
                //===================== checking if product category available ===================
                $warehouse_code=$_REQUEST['warehouse_code'];
                $brands=$_REQUEST['brands'];
                $category_code=$_REQUEST['category_code'];
                if($category_code=='' || $warehouse_code =='' || $brands ==''){
                    print("<script>window.alert('Must insert Warehouse, Brand and Product Category value.');</script>");
                    print("<script>window.location='../superadmin/new_assignment_clients.php'</script>");
                }
                else
                {
                    // ==================== checking if product category available ============
                    $category_code1=implode(',',$category_code);                                        
                    //===========================USER TABLE===========================
                    $jrp_account_no = $_REQUEST['user_excol2'];
                    $result2 = mysqli_query($con, "SELECT * FROM `user` where user_excol2='$jrp_account_no'");                
                    $row1 = mysqli_fetch_array($result2);
                    $user_id1 = $row1['user_id'];
                    //==============================END==========================

                    

                    //===========================BRAND TABLE===========================
                                       
                    foreach($_REQUEST['category_code'] as $category_code){                       
                        $result_product_code = mysqli_query($con, "SELECT `product_desc` FROM `product_code` WHERE `category_code`= '$category_code'");                
                        $row_product_code = mysqli_fetch_array($result_product_code);
                        $product_desc = $row_product_code['product_desc'];

                        //=========================== WAREHOUSE TABLE ===========================                    
                        $warehouse_code1=implode(',',$warehouse_code);
                        foreach($_REQUEST['warehouse_code'] as $warehouse_code){
                            //mysqli_query($con, "INSERT INTO `assign_warehouse` VALUES (NULL, '$jrp_account_no', '$warehouse_code', '$user_id1', NOW()); ");
                                                    
                            mysqli_query($con, "INSERT INTO  assign_warehouse  (`brand`,`jrp_account_no`, `warehouse_code`, `user_id`, `date`)
                                SELECT '$brands','$jrp_account_no','$warehouse_code','$user_id1', NOW() WHERE NOT EXISTS
                                (SELECT `jrp_account_no`, `warehouse_code` FROM  assign_warehouse  WHERE `jrp_account_no` = '$jrp_account_no' 
                                AND `warehouse_code` = '$warehouse_code' AND `brand` = '$brands');");                                
                        }
                        //==============================END==========================

                        //mysqli_query($con, "INSERT INTO `assign_brands` VALUES (NULL, '$user_id1', '$jrp_account_no', '$brands', '$category_code', '$product_desc', '$user_id');") or die( mysqli_error($con));
                        $assign_brands_query = mysqli_query($con, 
                            
                            "INSERT INTO `assign_brands`(`user_id`, `jrp_account_no`, `brandname`, `category_code`, `product_desc`, `assigned_by`, `date`, `col_1`, `col_2`, `col_3`, `col_4`)
                            SELECT '$user_id1', '$jrp_account_no', '$brands', '$category_code', '$product_desc', '$user_id', NOW(), '0', '', '', '' WHERE NOT EXISTS
                            (SELECT `jrp_account_no`, `brandname`, `category_code` FROM  `assign_brands`  
                            WHERE `jrp_account_no` = '$jrp_account_no' AND `user_id` = '$user_id1' AND `brandname` = '$brands' AND `category_code` = '$category_code');")
                            or die( mysqli_error($con));
                    }
                    if($assign_brands_query){
                        //print("<script>window.alert('Product category assigned to client accounts successfully');</script>");
                        print("<script>window.location='../superadmin/new_assignment_clients.php?jrp_account_no=$jrp_account_no'</script>");
                    }
            } //end of checking if product category available
} //add condition
else
{
    print("<script>window.location='../superadmin/new_assignment_clients_e.php?user_excol2=".$jrp_account_no."'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>