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

$first_name = TRIM($_REQUEST['first_name']);
$last_name = TRIM($_REQUEST['last_name']);
$username = $_REQUEST['username'];
$password = MD5($_REQUEST['password']);
$email = TRIM($_REQUEST['email']);
$account_status = '0';
$logcount = '0';
$ip = $_SERVER['REMOTE_ADDR'];
$account_type = "customer";
$user_excol1 = 'unblock';
$user_excol2 = TRIM($_REQUEST['type']);
$user_excol3 = $_REQUEST['user_excol3'];
$user_excol4 = $_REQUEST['user_excol4'];
$report_rule_set_no = $_REQUEST['report_rule_set_no'];

$timezone_offset = +6; // BD central time (gmt+6) for me
$create_date = gmdate('d-m-Y', time()+$timezone_offset*60*60);

//================= in mysql table checking for duplicate customer ============================
$check_admin_list = mysqli_query($con, "SELECT COUNT(*) as `username` FROM `user` WHERE `username`='$username'; ");
$row_check_admin_list = mysqli_fetch_array($check_admin_list);
$username_count = $row_check_admin_list['username'];

$check_acc_number = mysqli_query($con, "SELECT COUNT(*) as `acc_number` FROM `user` WHERE `user_excol2`='$user_excol2'; ");
$row_acc_number = mysqli_fetch_array($check_acc_number);
$acc_number = $row_acc_number['acc_number'];




if($acc_number>0){    
    print("<script>window.alert('Sorry Client Account No. Already exists, Try another JRP Account No.!!');</script>");
    print("<script>window.location='../superadmin/add_new_customer_dynamic.php?tp=".$user_excol2."'</script>"); 
}
elseif ($username_count>0){
    print("<script>window.alert('Sorry Username already in use, Try another username!!');</script>");
    print("<script>window.location='../superadmin/add_new_customer_dynamic.php?tp=".$user_excol2."'</script>");
}

else{
//=========================== end of in mysql table ================================



//------------------------------------------ COUNT max user id for profile table------------------------------------------

$result = mysqli_query($con, "SELECT MAX(`user_id`) as 'user_id' FROM `user` ");
$row = mysqli_fetch_array($result);
$user_id_profile = $row['user_id']+1;

//------------------------------------------ COUNT max user id for profile table------------------------------------------


//------------------------------------------ Insert Into Mysql------------------------------------------------------------

$sql1="INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `email`, `account_status`, `logcount`, 
        `last_login`, `ip`, `account_type`, `user_excol1`, `user_excol2`, `user_excol3`, `user_excol4`) 
        VALUES (NULL, '$first_name', '$last_name', '$username', '$password', '$email', '$account_status', '$logcount', 
        CURRENT_TIMESTAMP, '$ip', '$account_type', '$user_excol1', '$user_excol2', '$user_excol3', '$user_excol4');";
        $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
        $last_id = mysqli_insert_id($con);
//------------------------------------------ Insert Into User Table Mysql---------------------------------------------------





//================= insert into assign_template table ================================
// $report_rule_set="INSERT INTO `report_rule_set` (`report_rule_set_id`, `jrp_acc_no`, `report_rule_set_no`, `create_date`, `col1`, `col2`, `col3`, `col4`) 
//                   VALUES (NULL, '$user_excol2', '$report_rule_set_no', NOW(), '$col1', '$col2', '$col3', '$col4');";
// $result_report_rule_set=mysqli_query($con, $report_rule_set) or die( 'Couldnot execute query'. mysql_error());            
            $result_explode = explode('|', $report_rule_set_no);
            $report_indexes_id = $result_explode[0];
            $generate_rule = $result_explode[1];
            //last_insert_id()

 // ================== email notification : waiting for approval ======================================
 $user_excol2_e = $user_excol2;
 include('notify_approval_waiting.php');
 // ================== email notification : waiting for approval ======================================

$report_rule_set="INSERT INTO `waiting_client_approval_list` (`waiting_client_approval_list_id`, `report_indexes_id`, `generate_rule`, `user_id`, `jrp_account_no`, `category`, `col4`, `col5`, `col6`, `create_date`) 
                  VALUES (NULL, '$report_indexes_id', '$generate_rule', '$last_id', '$user_excol2', '0', '', '', '', NOW());";
$result_report_rule_set=mysqli_query($con, $report_rule_set) or die( 'Couldnot execute query'. mysql_error());


//================= end insert into report_rule_set table ============================






//------------------------------------------ Search and fetch from bv-----------------------------------------------------
include("bv_connect.php");
//--------------------- BV CUSTOMER Table -------------------------------
$results_customer = odbc_exec($connection, "select NAME from CUSTOMER where CUS_NO = '$user_excol2'");
$row_customer = @odbc_fetch_array($results_customer);
$NAME = $row_customer['NAME'];
//--------------------- BV ADDRESS Table -------------------------------

//profile_id user_id jrp_account_no company_name address1 city postal_code state contact_no col1col2col3col4col5col6col7
$results_address = odbc_exec($connection, "select * from ADDRESS where CEV_NO = '$user_excol2'");
$row_address = @odbc_fetch_array($results_address);
$BVADDR1 = TRIM($row_address['BVADDR1']);
$BVCITY = TRIM($row_address['BVCITY']);
$BVPOSTALCODE = TRIM($row_address['BVPOSTALCODE']);
$BVPROVSTATE = TRIM($row_address['BVPROVSTATE']);
$BVADDRTELNO1 = TRIM($row_address['BVADDRTELNO1']);
//------------------------------------------ Search and fetch from bv-----------------------------------------------------

//------------------------------------------ Insert Into Profile Table Mysql------------------------------------------------------------
$col1 = '';
$col2 = '';
$col3 = '';
$col4 = '';
$col5 = '';
$col6 = '';
$col7 = '';

$sql_profile="INSERT INTO
  `profile`(
    `profile_id`,
    `user_id`,
    `jrp_account_no`,
    `company_name`,
    `address1`,
    `city`,
    `postal_code`,
    `state`,
    `contact_no`,
    `col1`,
    `col2`,
    `col3`,
    `col4`,
    `col5`,
    `col6`,
    `col7`
  )
VALUES(
  NULL,
  '$last_id',
  '$user_excol2',
  '$NAME',
  '$BVADDR1',
  '$BVCITY',
  '$BVPOSTALCODE',
  '$BVPROVSTATE',
  '$BVADDRTELNO1',
  '$col1',
  '$col2',
  '$col3',
  '$col4',
  '$col5',
  '$col6',
  '$col7'
);
";
$result_profile=mysqli_query($con, $sql_profile) or die( 'Couldnot execute query'. mysql_error());

//------------------------------------------ Insert Into Profile Table Mysql------------------------------------------------------------

//------------------------------------------ Sending user activation email -------------------------------------------------------------
//include ("notify.php");

//------------------------------------------------End of activation email code-----------------------------------------------------------

if($result2 && $result_profile){
    print("<script>window.alert('JRP Datapoint Client information added successfully');</script>");
    print("<script>window.location='../superadmin/dashboard.php'</script>");
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