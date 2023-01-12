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
//------------------------------------------ Search and fetch from bv INVENTORY-----------------------------------------------------
include("bv_connect.php");
include("connect.php");
//--------------------- BV CUSTOMER Table -------------------------------
$sql = "TRUNCATE TABLE inventory"; 
mysqli_query($con, $sql);
error_reporting(0);

// $results_inventort = odbc_exec($connection, "select WHSE, INV_COMMITTED, ONHAND, CODE, MISC_1, INV_DESCRIPTION  from INVENTORY where WHSE!='10'");
// while ($row_inventort = @odbc_fetch_array($results_inventort))
//                 {


//$row_inventort = @odbc_fetch_array($results_inventort);
//while (odbc_fetch_row($result)) {
 //   echo odbc_result($result, "ProductName"), "\n";
//}

//================================================
//$test_qry = "select WHSE, INV_COMMITTED, ONHAND, CODE, MISC_1, INV_DESCRIPTION  from INVENTORY where WHSE!='10'";
$test_qry = "SELECT
PRICING . BVSPECPRICEWHSE   WHSE ,
PRICING . BVSPECPRICEPARTNO   CODE ,
INVENTORY . INV_DESCRIPTION   INV_DESCRIPTION ,
INVENTORY . ONHAND   ONHAND ,
INVENTORY . INV_COMMITTED   INV_COMMITTED ,
INVENTORY . MISC_1   MISC_1,
INVENTORY . PROD   prod 
FROM
PRICING   PRICING 
LEFT OUTER JOIN  INVENTORY   INVENTORY  ON
PRICING . BVSPECPRICEWHSE  =  INVENTORY . WHSE  AND  PRICING . BVSPECPRICESOURCEID  =  INVENTORY . PRICESOURCECONST  AND  PRICING . BVSPECPRICEPARTNO  =  INVENTORY . CODE 
LEFT OUTER JOIN  PRODUCT_CODE   PRODUCT_CODE  ON
INVENTORY . PROD  =  PRODUCT_CODE . CODE 
LEFT OUTER JOIN  VENDORPARTNO   VENDORPARTNO  ON
PRICING . BVSPECPRICEPARTNO  =  VENDORPARTNO . JRPSKU 
WHERE
PRICING . BVSPECPRICESOURCEID  = 'I' AND  PRICING . BVSPECPRICEWHSE  = '00'
ORDER BY
PRICING . BVSPECPRICEPARTNO ";
$sql = iconv('UTF-8','ISO-8859-1',$test_qry); 
$result = odbc_exec($connection, $sql);
//$sql = iconv('UTF-8','ISO-8859-1',$sql);  
while (odbc_fetch_row($result)) {
    $code = odbc_result($result, "CODE");

//===============================================
//$code = $row_inventort['CODE'];
// $brands = $row_inventort['MISC_1'];
// $description = $row_inventort['INV_DESCRIPTION'];
// $onhand_qty = $row_inventort['ONHAND'];
// $comitted_qty = $row_inventort['INV_COMMITTED'];
// $i_col1 = $row_inventort['WHSE'];

$brands = odbc_result($result, "MISC_1");
$description = odbc_result($result, "INV_DESCRIPTION");
$description1 = str_replace("'","||||",$description);
//$description = mysqli_real_escape_string($connection, $des);
$onhand_qty = odbc_result($result, "ONHAND");
$comitted_qty = odbc_result($result, "INV_COMMITTED");
$i_col1 = odbc_result($result, "WHSE");
$i_col2 = odbc_result($result, "prod");

/*
$results_qty = odbc_exec($connection, "select SUM(ONHAND) as ONHAND, SUM(INV_COMMITTED) as Comitted from INVENTORY where CODE='$code' and WHSE in ('00','03','04');");
$row_qty = @odbc_fetch_array($results_qty);
$onhand_qty = $row_qty['ONHAND'];
$comitted_qty = $row_qty['Comitted'];
 */           


$sql1="INSERT INTO `inventory`(
    `inventory_id`,
    `code`,
    `brands`,
    `description`,
    `onhand_qty`,
    `comitted_qty`,
    `i_col1`,
    `i_col2`,
    `i_col3`,
    `i_col4`,
    `i_col5`,
    `i_import_time`
)
VALUES(
    NULL,
    '$code',
    '$brands',
    '$description1',
    '$onhand_qty',
    '$comitted_qty',
    '$i_col1',
    '$i_col2',
    '',
    '',
    '',
    NOW())
";
$result2=mysqli_query($con, $sql1);
                }

//------------------------------------------ Search and fetch from bv-----------------------------------------------------



//------------------------------------------ Insert Into Mysql------------------------------------------------------------
/*
$sql1="INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `email`, `account_status`, `logcount`, 
`last_login`, `ip`, `account_type`, `user_excol1`, `user_excol2`, `user_excol3`, `user_excol4`) 
VALUES (NULL, '$first_name', '$last_name', '$username', '$password', '$email', '$account_status', '$logcount', 
CURRENT_TIMESTAMP, '$ip', '$account_type', '$user_excol1', '$user_excol2', '$user_excol3', '$user_excol4');
";

$result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
*/
//------------------------------------------ Insert Into User Table Mysql------------------------------------------------------------






//=================================== QTY =========================================
//select SUM(ONHAND) as ONHAND, SUM(INV_COMMITTED) as Comitted from "INVENTORY" where MISC_1='aFe Power' and WHSE in ('00','03','04');
//=================================== QTY =========================================

if($result && $result2){
    print("<script>window.alert('Inventory reloaded successfully');</script>");
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