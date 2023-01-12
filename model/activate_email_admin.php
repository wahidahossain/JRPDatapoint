<?php
include ("../model/connect.php");
error_reporting(0);
$user_excol2 = $_REQUEST['user_excol2'];
$email = $_REQUEST['email'];
$logcount = $_REQUEST['logcount'];
if($logcount=='0'){

$sql1="UPDATE `user` SET `account_status` = '1' WHERE `user`.`user_excol2` = '$user_excol2' AND `user`.`email` = '$email'";
$result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());

if($result2){
   // print("<script>window.alert('Account activation successful, reset account password please!!!');</script>");
    print("<script>window.location='https://jrpdatapoint.com/superadmin/force_reset_password.php?user_excol2=".$user_excol2."'</script>");
}
}
else{

    $sql1="UPDATE `user` SET `account_status` = '1' WHERE `user`.`user_excol2` = '$user_excol2' AND `user`.`email` = '$email'";
    $result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
    
    if($result2){
        print("<script>window.alert('Account activation successful, login please!!!');</script>");
        print("<script>window.location='https://jrpdatapoint.com/index.php'</script>");
    }
    }

?>
