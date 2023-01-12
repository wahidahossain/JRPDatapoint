
<?php
include ("connect.php");
error_reporting(0);
$user_excol2 = $_REQUEST['user_excol2'];
$account_status = $_REQUEST['account_status'];
if($account_status=='1')
    {
    $sql1="UPDATE `user` SET `account_status` = '0' WHERE `user`.`user_excol2` = '$user_excol2'";
    }
if($account_status=='0')
    {
    $sql1="UPDATE `user` SET `account_status` = '1' WHERE `user`.`user_excol2` = '$user_excol2'";
    }
$result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());

if($result2)
{
    if (isset($_REQUEST['tmp'])) {
        print("<script>window.location='../superadmin/add_new_admin.php'</script>");
      }
    else{
    print("<script>window.location='../superadmin/dashboard.php'</script>");
    }
}
?>
