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
$assign_brands_id = $_REQUEST['assign_brands_id'];
$jrp_account_no = $_REQUEST['jrp_account_no'];
//$password = MD5($_REQUEST['password']);

            $assign_brands_id1=implode(',',$assign_brands_id);
                foreach($_REQUEST['assign_brands_id'] as $assign_brands_id){
                $sql1="DELETE FROM `assign_brands` WHERE `assign_brands_id`='$assign_brands_id'";
                $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
                }
    

if($result2){
    //print("<script>window.alert('Record deleted successfully');</script>");
    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='.$user_excol2.'</script>");
    header("Location: ../superadmin/new_assignment_clients.php?jrp_account_no=$jrp_account_no");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>