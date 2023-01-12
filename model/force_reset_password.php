<?php
include ("../model/connect.php");
error_reporting(0);
$user_excol2 = $_REQUEST['user_excol2'];
$password = MD5($_REQUEST['password']);

$sql1="UPDATE `user` SET `password` = '$password' WHERE `user`.`user_excol2` = '$user_excol2'";


$result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
//http://localhost/jrpdatapoint/client_application/model/activate_email.php?user_excol2=HCMOT&email=&logcount=0
if($result2>0){
    include ("notify_ftp.php");

    print("<script>window.alert('Check your e-mail for FTP access information. \n Password reset & account activation successful, ready to login!!!');</script>");
    //print("<script>window.alert('JRP Datapoint login password reset & account activation successful, ready to login!!!');</script>");
    print("<script>window.location='../index.php'</script>");
}
else{
    print("<script>window.alert('Password reset not successful, Try again!');</script>");
    print("<script>window.location='https://jrpdatapoint.com/customer/force_reset_password.php?user_excol2=".$user_excol2."'</script>");
}
?>