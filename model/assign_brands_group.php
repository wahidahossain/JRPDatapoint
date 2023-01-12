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
error_reporting(E_ERROR);

//===========================USER TABLE===========================
$user_id1 = $_REQUEST['user_id'];
$result_user_table = mysqli_query($con, "SELECT * FROM `user` where user_id='$user_id1'");

               $row_user_table = mysqli_fetch_array($result_user_table);
               $user_excol2 = $row_user_table['user_excol2'];
//==============================END==========================

//===========================BRAND TABLE===========================
$brands=$_REQUEST['brands'];
$brands1=implode(',',$brands);
mysqli_query($con, "insert into assign_brands values((NULL, $user_id1, '$user_excol2', $brands, '', '')");
foreach($_REQUEST['brands'] as $brands){
    mysqli_query($con, "insert into assign_brands values(NULL, '$user_id1', '$user_excol2', '$brands', '', '')");
}

if($brands1){
    print("<script>window.alert('Brands assigned to customers successfully');</script>");
    print("<script>window.location='../superadmin/assign_brands_list.php'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>