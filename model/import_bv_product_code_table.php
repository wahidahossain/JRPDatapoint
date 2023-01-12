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
//------------------------------------------ Search and fetch from bv INVENTORY  -----------------------------------------------------
include("bv_connect.php");
include("connect.php");
error_reporting(0);
//--------------------- BV Table -------------------------------
$sql = "TRUNCATE TABLE product_code"; 
mysqli_query($con, $sql);
//SELECT * FROM `product_code` WHERE `product_desc` REGEXP BINARY '^[A-Z]+$';  ------------------------- filter heads -------------
$product_code_query = "select CODE, PRD_DESC from PRODUCT_CODE Where CODE NOT LIKE '%00'";

$sql = iconv('UTF-8','ISO-8859-1',$product_code_query); 
$result = odbc_exec($connection, $sql);
//$sql = iconv('UTF-8','ISO-8859-1',$sql);  
while (odbc_fetch_row($result)) {
    $category_code = trim(odbc_result($result, "CODE"));
    $product_desc = trim(odbc_result($result, "PRD_DESC"));
    $product_desc1 = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $product_desc));

        $sql1="INSERT INTO `product_code`(
            `product_code_id`,
            `category_code`,
            `product_desc`,
            `flag`,
            `date`
        )
        VALUES(
            NULL,
            '$category_code',
            '$product_desc1',
            '0',
            NOW());
        ";
        $result2=mysqli_query($con, $sql1);
        
        $sql_product_code ="UPDATE `product_code` SET `flag` = '1' WHERE `product_code`.`product_code_id` = '$product_code_id'; ";                
        $result_product_code=mysqli_query($con, $sql_product_code) or die( 'Couldnot execute query'. mysql_error());
}
    //update product code that matches ----------
    $sql ="SELECT `category_code`,`product_desc` FROM `filter_product_code`";                
    $result=mysqli_query($con, $sql) or die( 'Couldnot execute query'. mysql_error());
    while($row_product_code = mysqli_fetch_array($result)){
    $category_code = $row_product_code['category_code'];
    $product_desc = $row_product_code['product_desc'];

    $sql_update_product_code = "UPDATE `product_code` SET `flag`='1' WHERE `category_code`='$category_code' AND `product_desc`='$product_desc'; ";                
    $result_update_product_code = mysqli_query($con, $sql_update_product_code) or die( 'Couldnot execute query'. mysql_error());
    }

if($result2){
    print("<script>window.alert('Product Code table record reloaded successfully');</script>");
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