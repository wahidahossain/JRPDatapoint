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
//--------------------- BV Table -------------------------------
$sql = "TRUNCATE TABLE stock"; 
mysqli_query($con, $sql);
$test_qry = "SELECT
                PRICING . BVSPECPRICEPARTNO   jrpsku ,
                VENDORPARTNO . OEMSKU   oemsku ,
                PRICING . BVRTLPRICE02   map ,
                PRICING . BVRTLPRICE04   cost ,
                PRICING . BVSPECPRICEWHSE   WHSE ,
                INVENTORY . INV_DESCRIPTION   description ,
                INVENTORY . ONHAND   onhand ,
                INVENTORY . INV_COMMITTED   commited ,
                INVENTORY . MISC_1   brand,
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
                PRICING . BVSPECPRICESOURCEID  = 'I'
                ORDER BY
                PRICING . BVSPECPRICEPARTNO";
                //PRICING . BVSPECPRICESOURCEID  = 'I' AND  PRICING . BVSPECPRICEWHSE  = '00'



//SELECT CODE, ONHAND, INV_COMMITTED from "INVENTORY" where CODE = '03382410'
$sql = iconv('UTF-8','ISO-8859-1',$test_qry); 
$result = odbc_exec($connection, $sql);
//$sql = iconv('UTF-8','ISO-8859-1',$sql);  
while (odbc_fetch_row($result)) {
    $brand = odbc_result($result, "brand");
    $jrpsku = odbc_result($result, "jrpsku");
    $oemsku = odbc_result($result, "oemsku");
    $description1 = odbc_result($result, "description");
    $description = str_replace("'","||||",$description1);
    $onhand = odbc_result($result, "onhand");
    $commited = odbc_result($result, "commited");
    $cost = odbc_result($result, "cost");
    $map = odbc_result($result, "map");
    $prod = odbc_result($result, "prod");
    $WHSE = odbc_result($result, "WHSE");

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

if($result2){
    print("<script>window.alert('Stock table record reloaded successfully');</script>");
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