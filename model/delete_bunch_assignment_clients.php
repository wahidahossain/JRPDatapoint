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
$assign_brands_id = $_GET['assign_brands_id'];
$jrp_account_no = $_GET['jrp_account_no'];
$brandname = $_GET['brandname'];
$assign_brands_id1=implode(',',$assign_brands_id);

//foreach($_GET['assign_brands_id'] as $assign_brands_id){  
    $brands1=implode(',',$brandname); 
    foreach($_GET['brandname'] as $brandname){
        $sql_wrh="DELETE FROM `assign_warehouse` WHERE `brand`='$brandname' AND `jrp_account_no`='$jrp_account_no'";
        $result2_wrh=mysqli_query($con, $sql_wrh) or die( 'Couldnot execute query'. mysqli_error($con));        

        //delete assign_brands
        $sql1="DELETE FROM `assign_brands` WHERE`assign_brands`.`brandname` = '$brandname' ";
        $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysqli_error($con));
        }
//}    

if($result2_wrh){
    //print("<script>window.alert('Record deleted successfully');</script>");
    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='".$jrp_account_no."</script>");
    header("Location: ../superadmin/new_bunch_assignment_clients.php?jrp_account_no=$jrp_account_no");
}
else{
    print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='".$jrp_account_no."</script>");
    //header("Location: ../superadmin/new_bunch_assignment_clients.php?jrp_account_no='".$user_excol2."");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}

 //delete warehouse
    // $result3 = mysqli_query($con, "SELECT `jrp_account_no`,`brandname` FROM `assign_brands` WHERE `assign_brands_id`='$assign_brands_id'");                
    // $row3 = mysqli_fetch_array($result3);
    // $jrp_account_no = $row3['jrp_account_no'];
    // $brandname = $row3['brandname'];
    
?>
   

   