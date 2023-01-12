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

$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$username = $_REQUEST['username'];
$password = MD5($_REQUEST['password']);
$email = $_REQUEST['email'];
$account_status = '0';
$logcount = '0';
$ip = $_SERVER['REMOTE_ADDR'];
$account_type = $_REQUEST['account_type'];
//$account_type = 'superadmin';
$user_excol1 = 'unblock';
$user_excol2 = $username;
$user_excol3 = '';
$user_excol4 = '';



$timezone_offset = +6; // BD central time (gmt+6) for me
$create_date = gmdate('d-m-Y', time()+$timezone_offset*60*60);

//================= in mysql table checking for duplicate admin ============================
$check_admin_list = mysqli_query($con, "SELECT COUNT(*) as `username` FROM `user` WHERE `username`='$username'; ");
$row_check_admin_list = mysqli_fetch_array($check_admin_list);
$username_count = $row_check_admin_list['username'];
if($username_count>0){
    print("<script>window.alert('Sorry Username already in use, Try another username!!');</script>");
    print("<script>window.location='../superadmin/add_new_admin.php'</script>");

}
else{
//=========================== end of in mysql table ================================


//------------------------------------------ Insert Into Mysql------------------------------------------------------------

$sql1="INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `email`, `account_status`, `logcount`, 
`last_login`, `ip`, `account_type`, `user_excol1`, `user_excol2`, `user_excol3`, `user_excol4`) 
VALUES (NULL, '$first_name', '$last_name', '$username', '$password', '$email', '$account_status', '$logcount', 
CURRENT_TIMESTAMP, '$ip', '$account_type', '$user_excol1', '$user_excol2', '$user_excol3', '$user_excol4');
";

$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysqli_error($con));
//------------------------------------------ Insert Into User Table Mysql------------------------------------------------------------

if($result2){
    print("<script>window.alert('Admin account successfully created!!!');</script>");
    print("<script>window.location='../superadmin/add_new_admin.php'</script>");
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