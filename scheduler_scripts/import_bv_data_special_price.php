

<?php
//------------------------------------------ Search and fetch from bv INVENTORY-----------------------------------------------------
$serverDSN = 'BVSTAGING'; 
$connection = odbc_connect($serverDSN, '', '');
//-------------------END BV Connection -------------------
$dbname="jrp_customer_solution";
$con = mysqli_connect("localhost","wahida","kdjk75Djds%4dF29");
if (!$con)
{    
    echo "Can't Connect";
}
mysqli_select_db($con, "jrp_customer_solution");
$con1=mysqli_connect("localhost","wahida","kdjk75Djds%4dF29","jrp_customer_solution");
//-------------------END MySQL Connection -------------------

error_reporting(0);
//--------------------- BV CUSTOMER Table -------------------------------
$sql = "TRUNCATE TABLE special_pricing"; 
mysqli_query($con, $sql);
$p1 = odbc_exec($connection, "select BVSPECPRICEPARTNO,VENDOR_CODE  from SPECIAL_PRICING where BVSPECPRICEWHSE = '00'");
//$row_qty = @odbc_fetch_array($p1);
        while ($row_qty = @odbc_fetch_array($p1))
        {
                    $code_specialprice = trim($row_qty['BVSPECPRICEPARTNO']);
                    $oemsku =  trim($row_qty['VENDOR_CODE']);                          
                    $sql1="INSERT INTO `special_pricing`(
                        `special_pricing_id`,
                        `code_specialprice`,
                        `oemsku`,
                        `last_import_time`
                    )
                    VALUES(
                        NULL,
                        '$code_specialprice',
                        '$oemsku',
                        NOW());
                    ";
                    $result2=mysqli_query($con, $sql1);
                   //echo  $code_specialprice = trim($row_qty['BVSPECPRICEPARTNO'])."<br>";
                    
        }
//=================================== QTY =========================================
//select SUM(ONHAND) as ONHAND, SUM(INV_COMMITTED) as Comitted from "INVENTORY" where MISC_1='aFe Power' and WHSE in ('00','03','04');
//=================================== QTY =========================================

?>