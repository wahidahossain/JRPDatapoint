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
//error_reporting(0);
// --------------------- Fetch Warehouse ---------------------

$result_wh = mysqli_query($con, "SELECT GROUP_CONCAT(`warehouse`) as 'warehouse' FROM `warehouse` WHERE `flag`='1'; ");
$row_wh = mysqli_fetch_array($result_wh);
$warehouse = $row_wh['warehouse'];
       
$result_wh_cnt = mysqli_query($con, "SELECT COUNT(*) as 'count' FROM `warehouse` WHERE `flag`='1'; ");
$row_wh_cnt = mysqli_fetch_array($result_wh_cnt);
$count_wh = $row_wh_cnt['count'];

//--------------------- BV Table -------------------------------

if($count_wh > '0')
{
$sql = "TRUNCATE TABLE stock"; 
mysqli_query($con, $sql);
/*
$test_qry = "SELECT PRICING . BVSPECPRICEPARTNO   jrpsku ,
PRICING . BVRTLPRICE02   map ,
PRICING . BVRTLPRICE04   cost ,
PRICING . BVSPECPRICEWHSE   WHSE ,
INVENTORY . INV_DESCRIPTION   description ,
INVENTORY . ONHAND   onhand ,
INVENTORY . INV_COMMITTED   commited ,
INVENTORY . MISC_1   brand,
INVENTORY . PROD   prod,  
SPECIAL_PRICING . BVSPECPRICEPARTNO,
SPECIAL_PRICING . VENDOR_CODE   oemsku
FROM PRICING, INVENTORY, SPECIAL_PRICING
WHERE PRICING . BVSPECPRICEWHSE  =  INVENTORY . WHSE AND
SPECIAL_PRICING . BVSPECPRICEPARTNO  =  PRICING . BVSPECPRICEPARTNO AND
PRICING . BVSPECPRICESOURCEID  =  INVENTORY . PRICESOURCECONST AND
PRICING . BVSPECPRICEPARTNO  =  INVENTORY . CODE AND
INVENTORY . HOLD = '0' AND
INVENTORY . E_COMMERCE = '1' AND PRICING . BVSPECPRICEWHSE IN ($warehouse) AND SPECIAL_PRICING . BVSPECPRICESOURCEID='V'";
*/

/*$test_qry = "SELECT PRICING . BVSPECPRICEPARTNO   jrpsku ,
PRICING . BVRTLPRICE02   map ,
PRICING . BVRTLPRICE04   cost ,
PRICING . BVSPECPRICEWHSE   WHSE ,
INVENTORY . INV_DESCRIPTION   description ,
INVENTORY . ONHAND   onhand ,
INVENTORY . INV_COMMITTED   commited ,
INVENTORY . MISC_1   brand,
INVENTORY . PROD   prod
FROM PRICING, INVENTORY
WHERE PRICING . BVSPECPRICEWHSE  =  INVENTORY . WHSE AND
PRICING . BVSPECPRICESOURCEID  =  INVENTORY . PRICESOURCECONST AND
PRICING . BVSPECPRICEPARTNO  =  INVENTORY . CODE AND
INVENTORY . HOLD = '0' AND
INVENTORY . E_COMMERCE = '1' AND PRICING . BVSPECPRICEWHSE IN ($warehouse)";
*/
                //PRICING . BVSPECPRICESOURCEID  = 'I' AND  PRICING . BVSPECPRICEWHSE  = '00'
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

    // $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
    //                                                       $row_special_pricing = mysqli_fetch_array($result_special_pricing);                                                          
    //                                                       $oemsku = TRIM($row_special_pricing['oemsku']); 
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

if($result2 == TRUE){
    $con -> close();
    print("<script>window.alert('Stock table record reloaded successfully');</script>");
    //print("<script>window.location='update_stock_table.php'</script>");
    print("<script>window.location='../superadmin/dashboard.php'</script>");
}

}
else
{
    print("<script>window.alert('Sorry No warehouse list found in database, Add Warehouse List First!!');</script>");
    //print("<script>window.location='update_stock_table.php'</script>");
    print("<script>window.location='../superadmin/filter_warehouse.php'</script>");
}

if(connection_aborted()){
    exit;
}

?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}

?>