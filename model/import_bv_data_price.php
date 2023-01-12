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
error_reporting(0);
//--------------------- BV CUSTOMER Table -------------------------------
$sql = "TRUNCATE TABLE pricing"; 
mysqli_query($con, $sql);

// $results_inventort = odbc_exec($connection, "select WHSE, INV_COMMITTED, ONHAND, CODE, MISC_1, INV_DESCRIPTION  from INVENTORY where WHSE!='10'");
// while ($row_inventort = @odbc_fetch_array($results_inventort))
//{
//$row_inventort = @odbc_fetch_array($results_inventort);
//while (odbc_fetch_row($result)) {
//   echo odbc_result($result, "ProductName"), "\n";
//}
//================================================

/*
$pricing = "select BVSPECPRICEWHSE, BVSPECPRICEPARTNO, BVRTLPRICE04, BVRTLPRICE02  from PRICING where BVSPECPRICEWHSE='00'";
$sql = iconv('UTF-8','ISO-8859-1',$pricing); 
$result1 = @odbc_fetch_array($connection, $sql);

while (odbc_fetch_row($result1)) {
 
$code_price = odbc_result($result1, "BVSPECPRICEPARTNO");
$warehouse =  odbc_result($result1, "BVSPECPRICEWHSE");
$cost = odbc_result($result1, "BVRTLPRICE04");
$map = odbc_result($result1, "BVRTLPRICE02");

*/

//$sql_pricing = "select BVSPECPRICEWHSE, BVSPECPRICEPARTNO, BVRTLPRICE04, BVRTLPRICE02  from PRICING where BVSPECPRICEWHSE='00' AND BVSPECPRICESOURCEID='I'";
$sql_pricing = "SELECT
PRICING . BVSPECPRICEWHSE   BVSPECPRICEWHSE ,
PRICING . BVSPECPRICEPARTNO   BVSPECPRICEPARTNO ,
VENDORPARTNO . OEMSKU   OEMSKU ,
PRICING . BVRTLPRICE02   BVRTLPRICE02 ,
PRICING . BVRTLPRICE04   BVRTLPRICE04 
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
PRICING . BVSPECPRICEPARTNO";

$p1 = odbc_exec($connection, $sql_pricing);
//$row_qty = @odbc_fetch_array($p1);
while ($row_qty = @odbc_fetch_array($p1))
{

$code_price = trim($row_qty['BVSPECPRICEPARTNO']);
$warehouse =  trim($row_qty['BVSPECPRICEWHSE']);
$cost = trim($row_qty['BVRTLPRICE04']);
$map = trim($row_qty['BVRTLPRICE02']);
$vendor_code = trim($row_qty['OEMSKU']);





// $special_price = "select VENDOR_CODE from SPECIAL_PRICING where BVSPECPRICEPARTNO = '$code_price'";
// $result2 = odbc_exec($connection, $special_price);

// $vendor_code = odbc_result($result2, "VENDOR_CODE");

/*
$results_qty = odbc_exec($connection, "select SUM(ONHAND) as ONHAND, SUM(INV_COMMITTED) as Comitted from INVENTORY where CODE='$code' and WHSE in ('00','03','04');");
$row_qty = @odbc_fetch_array($results_qty);
$onhand_qty = $row_qty['ONHAND'];
$comitted_qty = $row_qty['Comitted'];
*/          

$sql1="INSERT INTO `pricing`(
    `pricing_id`,
    `code_price`,    
    `warehouse`,
    `cost`,
    `map`,
    `vendor_code`,
    `p_col1`,
    `p_col2`,
    `p_col3`,
    `p_col4`,
    `p_col5`,
    `p_col6`,
    `p_col7`,
    `import_time`
)
VALUES(
    NULL,
    '$code_price',
    '$warehouse',
    '$cost',
    '$map',
    '$vendor_code',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    NOW());
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

if($row_qty){
    print("<script>window.alert('Price table record reloaded successfully');</script>");
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