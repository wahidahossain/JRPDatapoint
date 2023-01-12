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
//error_reporting(0);
$report_indexes_id = $_REQUEST['report_indexes_id'];
$index_name = $_REQUEST['index_name'];
//$template_id = $_REQUEST['template_id'];
$brand_name = $_REQUEST['brand_name'];
$product_code_id = $_REQUEST['product_code_id'];
//$password = MD5($_REQUEST['password']);
// <!-- report_indexes_id  brand_name  product_code_id -->
            $brand_name1=implode(',',$brand_name);
                foreach($_REQUEST['brand_name'] as $brand_name){
                    //DELETE FROM `template` WHERE `report_indexes_id`='7' AND `brand_name`='AIRAID' AND `product_code_id`='27'; 
                $sql1="DELETE FROM `template` WHERE `report_indexes_id`='$report_indexes_id' AND `brand_name`='$brand_name' AND `product_code_id`='$product_code_id'";
                $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
                }
                if($result2){
                    print("<script>window.alert('Record deleted successfully');</script>");
                    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='.$user_excol2.'</script>");
                    header("Location: ../superadmin/assign_template_list_details.php?report_indexes_id=$report_indexes_id");
                }
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>