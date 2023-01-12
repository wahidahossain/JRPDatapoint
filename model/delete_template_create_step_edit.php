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
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//error_reporting(0);

$template_id1 = $_REQUEST['template_id'];
$index_name = $_REQUEST['index_name'];
                    foreach($template_id1 as $template_id){
                        $result_del = mysqli_query($con, "SELECT `report_indexes_id`,`brand_name`,`product_code_id` FROM `template` WHERE `template_id`='$template_id';");
                        while($row_del = mysqli_fetch_array($result_del)){
                            $report_indexes_id = $row_del['report_indexes_id'];
                            $brand_name = $row_del['brand_name'];
                            $product_code_id = $row_del['product_code_id'];

                $sql1="DELETE FROM `template` WHERE `report_indexes_id`='$report_indexes_id' AND `brand_name`='$brand_name' AND `product_code_id`='$product_code_id'";
                $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
                } 
            }   

if($result2){
    print("<script>window.alert('Record deleted successfully');</script>");
    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='.$user_excol2.'</script>");
    header("Location: ../superadmin/template_create_step_edit.php?index_name=$index_name&report_indexes_id=$report_indexes_id");
}
else{
    print("<script>window.alert('Record can't delete now, try again!!!');</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>