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
//error_reporting(0);
$report_indexes_id = $_REQUEST['report_indexes_id'];
$index_name = $_REQUEST['index_name'];
$opt = $_REQUEST['opt'];
//$password = MD5($_REQUEST['password']);



$sql1="DELETE FROM `template` WHERE `report_indexes_id`= '$report_indexes_id'";
$result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());

// $sql_wrh="DELETE FROM `assign_warehouse` WHERE `jrp_account_no` = '$user_excol2'";
// $result2_wrh=$result2=mysqli_query($con, $sql_wrh) or die( 'Couldnot execute query'. mysql_error());


if($result2){
    //print("<script>window.alert('Record deleted successfully');</script>");
    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='.$user_excol2.'</script>");
    if($opt=='list'){
        header("Location: ../superadmin/assign_template_list.php");
    }
    if($opt=='s'){
        header("Location: ../superadmin/template_create_step_edit.php?index_name=$index_name&report_indexes_id=$report_indexes_id");
    }
    if($opt=='b'){
    header("Location: ../superadmin/template_bunch_create_step2.php?index_name=$index_name&report_indexes_id=$report_indexes_id");
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