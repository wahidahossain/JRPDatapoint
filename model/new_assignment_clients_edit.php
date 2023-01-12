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

            $jrp_account_no = $_REQUEST['jrp_account_no'];
            $brandname = $_REQUEST['brandname'];
            $category_code = $_REQUEST['category_code'];
            $category_code1=implode(',',$category_code);
                foreach($_REQUEST['category_code'] as $category_code){
                $sql1="DELETE FROM `assign_brands` WHERE `jrp_account_no` = '$jrp_account_no' AND `brandname`= '$brandname' AND `category_code`='$category_code'";
                $result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
                }
if($result2){
    print("<script>window.alert('Record updated successfully');</script>");
    print("<script>window.location='../superadmin/new_assignment_clients_e.php?user_excol2=".$jrp_account_no."'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>