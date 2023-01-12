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
include ("connect.php");

//error_reporting(0);
$user_id = $_REQUEST['user_id'];
$first_name = $_REQUEST['first_name']; //client name
$last_name = $_REQUEST['last_name']; //business name
$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$user_excol2_e = $_REQUEST['type'];
//echo $user_excol2;
$user_excol3 = $_REQUEST['user_excol3']; //ftp username
$user_excol4 = $_REQUEST['user_excol4']; //ftp password
$report_rule_set_no = $_REQUEST['report_rule_set_no'];

//$company_name = $_REQUEST['company_name'];
$address1 = trim($_REQUEST['address1']);
$city = trim($_REQUEST['city']);
$postal_code = $_REQUEST['postal_code'];
$state = trim($_REQUEST['state']);
$contact_no = trim($_REQUEST['contact_no']);

$timezone_offset = +6; // BD central time (gmt+6) for me
$create_date = gmdate('d-m-Y', time()+$timezone_offset*60*60);

//type=HCMOT&last_name=H.+C.+Motorsports++--+Not+in+servicenew&first_name=Jon+Sutherlandnew&email=wahida%40jrponline.comnew&
//company_name=10X+Tuning+++***Closed***new&address1=170+West+Beaver+Creek+Rdnew
//&city=Richmond+Hillnew&state=ONnew&contact_no=416841433300
//&user_excol3=HCMOTnew&user_excol4=HCMOTPASSnew&username=HCMOTnew

//------------------------------------------ Update user table-----------------------------------------------

$sql1="UPDATE `user` SET `first_name` = '$first_name', `last_name` = '$last_name', `username` = '$username', `email` = '$email', 
`user_excol3` = '$user_excol3', `user_excol4` = '$user_excol4' WHERE `user`.`user_excol2` = '$user_excol2_e';";
$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysqli_error($con));
//------------------------------------------ End ------------------------------------------------------------

//------------------------------------------ Update assign_template table------------------------------------
            $result_explode = explode('|', $report_rule_set_no);
            $report_indexes_id = $result_explode[0];
            $generate_rule = $result_explode[1];

// $sql_report_rule_set = "UPDATE `assign_template` SET `report_indexes_id`='$report_indexes_id',`generate_rule`='$generate_rule', `create_date`= NOW() WHERE `jrp_account_no`='$user_excol2_e';";
// $result_report_rule_set = mysqli_query($con, $sql_report_rule_set) or die('Couldnot execute query'. mysqli_error($con));


$report_rule_set_check_existing ="SELECT COUNT(*) as 'cnt' FROM `waiting_client_approval_list` WHERE `jrp_account_no`='$user_excol2_e'";
$result_report_rule_set_check_existing=mysqli_query($con, $report_rule_set_check_existing) or die( 'Couldnot execute query'. mysql_error());
$row_cnt = mysqli_fetch_array($result_report_rule_set_check_existing);
$cnt = $row_cnt['cnt'];
if($cnt=='0')
{
    // ================== email notification : waiting for approval ======================================
    include('notify_approval_waiting.php');
    // ================== email notification : waiting for approval ======================================

    $report_rule_set="INSERT INTO `waiting_client_approval_list` (`waiting_client_approval_list_id`, `report_indexes_id`, `generate_rule`, `user_id`, `jrp_account_no`, `category`, `col4`, `col5`, `col6`, `create_date`) 
    VALUES (NULL, '$report_indexes_id', '$generate_rule', '$user_id', '$user_excol2_e', '1', '', '', '', NOW());";
    $result_report_rule_set=mysqli_query($con, $report_rule_set) or die( 'Couldnot execute query'. mysql_error());
}
else
{
    print("<script>window.alert('Rule set for this client waiting for approval.');</script>");
    print("<script>window.location='../superadmin/add_new_customer_e.php?tp=".$user_excol2_e."'</script>");
    
}
//------------------------------------------ End ------------------------------------------------------------

//------------------------------------------ Update Profile Table -------------------------------------------

//include('notify_approval_waiting.php'); // email notification : waiting for approval ======================== 

$sql_profile="UPDATE `profile` SET `company_name` = '$last_name', `address1` = '$address1', `city` = '$city', `postal_code` = '$postal_code', 
`state` = '$state', `contact_no` = '$contact_no' WHERE `profile`.`jrp_account_no` = '$user_excol2_e';";
$result_profile=mysqli_query($con, $sql_profile) or die( 'Couldnot execute query'. mysqli_error($con));

//------------------------------------------ End ------------------------------------------------------------
if($result2 && $result_profile){
    //print("<script>window.alert('Client account edited successfully!!!');</script>");
    print("<script>window.location='../superadmin/add_new_customer_e.php?tp=".$user_excol2_e."'</script>");
}
else{
    print("<script>window.alert('Client account not updated, try again!!!');</script>");
    print("<script>window.location='../superadmin/add_new_customer_e.php?tp=".$user_excol2_e."'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>