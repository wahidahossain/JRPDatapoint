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

$report_indexes_id = $_REQUEST['report_indexes_id'];
$index_name = $_REQUEST['index_name'];

            $brand_name = $_REQUEST['brandname'];
            $product_code_id = false;
            if (isset($_REQUEST['product_code_id'])) {
                $product_code_id = $_REQUEST['product_code_id'];
            }
            //$product_code_id1=implode(',',$product_code_id);
            $warehouse_code=$_REQUEST['warehouse_code'];
            //$warehouse_code1=implode(',',$warehouse_code);            
                
                
                if($product_code_id=='' || $warehouse_code =='' || $brand_name ==''){
                    print("<script>window.alert('Must Select Warehouse, Brand and Product Categories to update.');</script>");
                    print("<script>window.location='../superadmin/template_create_step_edit.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");
                }
                else
                {

            foreach($_REQUEST['warehouse_code'] as $warehouse){   
            $sql1="DELETE FROM `template` WHERE `report_indexes_id`='$report_indexes_id' AND `brand_name` LIKE '%$brand_name%' AND `warehouse`='$warehouse'";
            $result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
            }
            
            // foreach($_REQUEST['warehouse_code'] as $warehouse){ 
                // foreach($_REQUEST['product_code_id'] as $product_code_id){                       
                //   $update_query =  mysqli_query($con, "DELETE FROM `template` WHERE `product_code_id`='$product_code_id' WHERE `product_code_id`='$product_code_id'");
                //   //$update_result = mysqli_query($con, $update_query);                     
                // }

                //update template name here --------------------
                    $sql_update_index_name = "UPDATE `report_indexes` SET `index_name` = '$index_name' WHERE `report_indexes`.`report_indexes_id` = '$report_indexes_id'; ";
                    $result_update_index_name = mysqli_query($con, $sql_update_index_name) or die( 'Couldnot execute query'. mysql_error());
                //end ----------------------

                foreach($_REQUEST['warehouse_code'] as $warehouse){                   
                    foreach($_REQUEST['product_code_id'] as $product_code_id){                       
                      $insert_query =  mysqli_query($con, "INSERT INTO `template` (`template_id`, `report_indexes_id`, `brand_name`, `product_code_id`, `warehouse`, `col2`, `col3`, `col4`, `flag`, `last_imported`) 
                        VALUES (NULL, '$report_indexes_id', '$brand_name', '$product_code_id', '$warehouse', '', '', '', '0', NOW());") or die( mysqli_error($con));
                    }

                    // Notification code started ====================================================

                    $generate_rule = "0";
                    $result_jrp_account_no = mysqli_query($con, "SELECT GROUP_CONCAT(`jrp_account_no`) as `jrp_account_no` FROM `assign_template` WHERE `report_indexes_id`='$report_indexes_id'");                
                    //if(mysqli_num_rows($result2 > 0)){
                        $row_jrp_account_no = mysqli_fetch_array($result_jrp_account_no);
                        $jrp_account_no = $row_jrp_account_no['jrp_account_no']; 
                    
                    $user_excol2_e = $jrp_account_no;
                    include('notify_approval_waiting.php');

                    // Notification code end ====================================================
                }
                    if($insert_query){
                        //print("<script>window.alert('Product category assigned to client accounts successfully');</script>");
                        print("<script>window.location='../superadmin/template_create_step_edit.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");
                    }

                if($result2){
                    //print("<script>window.alert('Record updated successfully');</script>");
                    print("<script>window.location='../superadmin/template_create_step_edit.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");
                }       
            }            


?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>