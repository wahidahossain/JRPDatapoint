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

$result_special_pricing = mysqli_query($con, "SELECT * FROM `special_pricing` GROUP BY `code_specialprice`");
    while($row_special_pricing = mysqli_fetch_array($result_special_pricing)){
    $code_specialprice = $row_special_pricing['code_specialprice'];
    $oemsku = $row_special_pricing['oemsku'];

$sql1="UPDATE `stock` SET `oemsku` = '$oemsku' WHERE `stock`.`jrpsku`='$code_specialprice'";
$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysqli_error($con));
//break 1;
   
//exit();
}

if($result2){
    print("<script>window.alert('Updated successfully');</script>");
    print("<script>window.location='../superadmin/dashboard.php'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>