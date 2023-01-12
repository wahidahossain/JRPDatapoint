<?php
session_start();
include('session.php'); 
$account_type=$_SESSION['account_type'];
$first_name=$_SESSION['first_name'];
$user_id=$_SESSION['user_id'];
$email=$_SESSION['email'];
$user_excol2=$_SESSION['user_excol2'];



if($login=="superadmin"){
        $login=$_SESSION['login'];
        $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];
    ?>
<?php
include ("../model/connect.php");
error_reporting(E_ALL);
$jrp_account_no = $_REQUEST['jrp_account_no'];

//sending approved record list to email address==============================================================
// $email = "wahida@jrponline.com";
// $result_user_id = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `user_excol2` = '$jrp_account_no' ");
//     $row_user_id = mysqli_fetch_array($result_user_id); 
//     $user_id = $row_user_id['user_id']; 
//sending approved record list to email address==============================================================


    $results_waiting_client_approval_list = mysqli_query($con, "UPDATE `assign_brands` SET `col_1`='1' WHERE `jrp_account_no` = '$jrp_account_no' ");
    include('notify_approval_clients.php');
    //$row_waiting_client_approval_list = mysqli_fetch_array($results_waiting_client_approval_list);
 // chaging template flags to 1 after approval ===================================

if($results_waiting_client_approval_list){   
    print("<script>window.alert('Successfully Approved!!');</script>");
    // print("<script>window.location='../superadmin/waiting_list_details_manual.php?jrp_account_no=$jrp_account_no'</script>");
    print("<script>window.location='../superadmin/waiting_list.php'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>
