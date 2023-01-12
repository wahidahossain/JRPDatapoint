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
//error_reporting(E_ERROR);

//===========================USER TABLE===========================

if (isset($_REQUEST['brand'])) {
$brand = $_REQUEST['brand'];
foreach($_REQUEST['brand'] as $brand){
    
    
    $sql1 ="INSERT INTO `filter_brands`(
        `filter_brands_id`,
        `brand`,
        `create_date`
    )
    VALUES(NULL, '$brand', NOW());";                
    $result2=mysqli_query($con, $sql1) or die('Couldnot execute query'. mysqli_error($con));
}
if($result2){
    //print("<script>window.alert('Product category filtered successfully');</script>");
    print("<script>window.location='../superadmin/filter_brands.php'</script>");
}
}
else {
    print("<script>window.alert('Please select brand name from the list to filter it.');</script>");
    print("<script>window.location='../superadmin/filter_brands.php'</script>");    
      } 
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>