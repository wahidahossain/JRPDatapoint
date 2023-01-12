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
$opt = $_REQUEST['opt'];
$assign_brands_id = $_REQUEST['assign_brands_id'];
$jrp_account_no = $_REQUEST['jrp_account_no'];

            $assign_brands_id1=implode(',',$assign_brands_id);
                foreach($_REQUEST['assign_brands_id'] as $assign_brands_id){
                $sql1="DELETE FROM `assign_brands` WHERE `assign_brands_id`='$assign_brands_id'";
                $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
                }   

if($result2){
    if($opt == '1'){
    header("Location: ../superadmin/assign_brands_list_details.php?jrp_account_no=$jrp_account_no");
}
if($opt == '2'){
    header("Location: ../superadmin/waiting_list_details_manual.php?jrp_account_no=$jrp_account_no");
}
if($opt == '3'){
    header("Location: ../superadmin/waiting_list_details.php?jrp_account_no=$jrp_account_no&vl=1&report_indexes_id=0");
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