<?php
//------------------------------------------ Search and fetch from bv INVENTORY-----------------------------------------------------
// $serverDSN = 'BVSTAGING'; 
$serverDSN = 'BVSQL'; 
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
// --------------------- Fetch Warehouse ---------------------

$result_wh = mysqli_query($con, "SELECT GROUP_CONCAT(`warehouse`) as 'warehouse' FROM `warehouse` WHERE `flag`='1'; ");
$row_wh = mysqli_fetch_array($result_wh);
$warehouse = $row_wh['warehouse'];       

$sql = "TRUNCATE TABLE stock"; 
mysqli_query($con, $sql);
$test_qry = "SELECT
PRICING.BVSPECPRICEWHSE WHSE,
INVENTORY . PROD   prod,
INVENTORY.INV_DESCRIPTION description,
INVENTORY.CODE jrpsku,
PRICING.BVRTLPRICE02 map,
PRICING.BVRTLPRICE04 cost,
INVENTORY.ONHAND onhand,
INVENTORY.INV_COMMITTED commited,
INVENTORY.MISC_1 brand,
SPECIAL_PRICING.VENDOR_CODE oemsku
FROM
    PRICING PRICING
LEFT OUTER JOIN INVENTORY INVENTORY ON
    (
        PRICING.BVSPECPRICEWHSE = INVENTORY.WHSE
    ) AND(
        PRICING.BVSPECPRICEPARTNO = INVENTORY.CODE
    )
LEFT OUTER JOIN SPECIAL_PRICING SPECIAL_PRICING ON
(INVENTORY.WHSE = SPECIAL_PRICING.BVSPECPRICEWHSE) AND(
    INVENTORY.CODE = SPECIAL_PRICING.BVSPECPRICEPARTNO
) 
WHERE
PRICING.BVSPECPRICEWHSE IN ($warehouse) AND PRICING.BVSPECPRICESOURCEID = 'I'
AND NOT SPECIAL_PRICING.BVSPECPRICEADDRTYPE IN ('S', 'B')
AND INVENTORY . HOLD = '0' AND INVENTORY . E_COMMERCE = '1'
ORDER BY
INVENTORY.CODE";
                //PRICING . BVSPECPRICESOURCEID  = 'I' AND  PRICING . BVSPECPRICEWHSE  = '00'

//preg_replace('/[^A-Za-z0-9\-]/', ' ', $product_desc)
$sql_bv = iconv('UTF-8','ISO-8859-1',$test_qry); 
$result = odbc_exec($connection, $sql_bv);
//$sql = iconv('UTF-8','ISO-8859-1',$sql);  
while (odbc_fetch_row($result)) {
    $brand = TRIM(odbc_result($result, "brand"));
    $jrpsku = TRIM(odbc_result($result, "jrpsku"));
    $oemsku = TRIM(odbc_result($result, "oemsku"));
    $description1 = TRIM(odbc_result($result, "description"));
    $description = TRIM(str_replace("'","||||",$description1));
    $onhand = TRIM(odbc_result($result, "onhand"));
    $commited = TRIM(odbc_result($result, "commited"));
    $cost = TRIM(odbc_result($result, "cost"));
    $map = TRIM(odbc_result($result, "map"));
    $prod = TRIM(odbc_result($result, "prod"));
    $WHSE = TRIM(odbc_result($result, "WHSE"));
  
        $sql1="INSERT INTO `stock`(
            `stock_id`,
            `brand`,
            `jrpsku`,
            `oemsku`,
            `description`,
            `onhand`,
            `commited`,
            `cost`,
            `map`,
            `prod`,
            `col_1`,
            `col_2`,
            `col_3`
        )
        VALUES(
            NULL,
            '$brand',
            '$jrpsku',
            '$oemsku',
            '$description',
            '$onhand',
            '$commited',
            '$cost',
            '$map',
            '$prod',
            '$WHSE',
            '',
            ''
        );
        ";
        $result2=mysqli_query($con, $sql1);

}


?>