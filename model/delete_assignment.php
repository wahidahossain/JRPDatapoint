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
error_reporting(0);
$user_excol2 = $_REQUEST['user_excol2'];
//$password = MD5($_REQUEST['password']);
$flag = $_REQUEST['flag'];


$sql1="DELETE FROM `assign_brands` WHERE `assign_brands`.`jrp_account_no` = '$user_excol2'";
$result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());

$sql_wrh="DELETE FROM `assign_warehouse` WHERE `jrp_account_no` = '$user_excol2'";
$result2_wrh=$result2=mysqli_query($con, $sql_wrh) or die( 'Couldnot execute query'. mysql_error());


if($result2){
    print("<script>window.alert('Record deleted successfully');</script>");
    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='.$user_excol2.'</script>");
    if($flag=='1'){
    header("Location: ../superadmin/assign_brands_list.php");
    }
    if($flag=='2'){
        header("Location: ../superadmin/new_bunch_assignment_clients.php?jrp_account_no=$user_excol2");
        }
        if($flag=='3'){
            header("Location: ../superadmin/new_assignment_clients.php?jrp_account_no=$user_excol2");
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