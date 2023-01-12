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
                $brand_name=$_REQUEST['brands'];
                $product_code_id=$_REQUEST['category_code'];
                if($product_code_id=='' || $warehouse_code =='' || $brand_name ==''){
                    print("<script>window.alert('Must Select Warehouse, Brand and Product Category value.');</script>");
                    print("<script>window.location='../superadmin/new_assignment_clients.php'</script>");
                }
                else
                {
                    // ==================== checking if product category available ============
                    $product_code_id1=implode(',',$product_code_id);                                        
                    //===========================USER TABLE===========================
                    // $jrp_account_no = $_REQUEST['user_excol2'];
                    // $result2 = mysqli_query($con, "SELECT * FROM `user` where user_excol2='$jrp_account_no'");                
                    // $row1 = mysqli_fetch_array($result2);
                    // $user_id1 = $row1['user_id'];
                    //==============================END==========================

                    //=========================== WAREHOUSE TABLE ===========================
                    $warehouse_code=$_REQUEST['warehouse_code'];
                    //$warehouse_code1=implode(',',$warehouse_code);
                    // foreach($_REQUEST['warehouse_code'] as $warehouse_code){
                    //     mysqli_query($con, "INSERT INTO `assign_warehouse` VALUES (NULL, '$jrp_account_no', '$warehouse_code', '$user_id', NOW()); ");
                    // }
                    //==============================END==========================

                    //===========================BRAND TABLE===========================
                    foreach($_REQUEST['warehouse_code'] as $warehouse){                   
                    foreach($_REQUEST['category_code'] as $category_code){                       
                      $insert_query =  mysqli_query($con, "INSERT INTO `template` (`template_id`, `report_indexes_id`, `brand_name`, `product_code_id`, `warehouse`, `col2`, `col3`, `col4`, `flag`, `last_imported`) 
                        VALUES (NULL, '$report_indexes_id', '$brand_name', '$category_code', '$warehouse', '', '', '', '0', NOW());") or die( mysqli_error($con));
                    }
                }
                    if($insert_query){
                        //print("<script>window.alert('Product category assigned to client accounts successfully');</script>");
                        print("<script>window.location='../superadmin/template_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");
                    }
            } //end of checking if product category available
} //add condition
else
{
    print("<script>window.location='../superadmin/template_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");

}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>