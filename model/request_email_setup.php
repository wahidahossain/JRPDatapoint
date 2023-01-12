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
$request_email = $_REQUEST['request_email'];

$sql1="UPDATE `request_email` SET `request_email` = '$request_email' WHERE `request_email_id`='1';";
$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysqli_error($con));

if($result2){
    //print("<script>window.alert('Updated successfully');</script>");
    print("<script>window.location='../superadmin/request_email_setup.php'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>