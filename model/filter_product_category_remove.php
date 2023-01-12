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
$product_code_id = $_REQUEST['product_code_id'];
foreach($_REQUEST['product_code_id'] as $product_code_id){
    
    $sql1 ="UPDATE `product_code` SET `flag` = '0' WHERE `product_code`.`product_code_id` = '$product_code_id'; ";                
    $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());


    //filter_product_category table
    $sql1 ="SELECT `category_code`,`product_desc` FROM `product_code` WHERE `product_code_id` = '$product_code_id'; ";                
    $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
    $row_product_code = mysqli_fetch_array($result2);
    $category_code = $row_product_code['category_code'];
    $product_desc = $row_product_code['product_desc'];

    $sql_filter_product_code="DELETE FROM filter_product_code WHERE `category_code` = '$category_code' AND `product_desc`='$product_desc'";
    $result_filter_product_code=mysqli_query($con, $sql_filter_product_code) or die( 'Couldnot execute query'. mysql_error());

}
if($result2){
    print("<script>window.alert('Product category filter removed successfully');</script>");
    print("<script>window.location='../superadmin/filter_product_category.php'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>