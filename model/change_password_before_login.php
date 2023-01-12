
<?php
include ("../model/connect.php");
error_reporting(0);
$user_excol2 = $_REQUEST['user_excol2'];
$email = $_REQUEST['email'];
$password = MD5($_REQUEST['password']);
$sql1="UPDATE `user` SET `password` = '$password' WHERE `user`.`user_excol2` = '$user_excol2'";

$result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());

if($result2){   

    print("<script>window.alert('Password reset successful!!');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>