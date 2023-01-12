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
$sql = "TRUNCATE TABLE special_pricing"; 
mysqli_query($con, $sql);
// $p1 = odbc_exec($connection, "select BVSPECPRICEPARTNO,VENDOR_CODE  from SPECIAL_PRICING where BVSPECPRICEWHSE = '00'");
$p1 = odbc_exec($connection, "select BVSPECPRICEPARTNO,VENDOR_CODE  from SPECIAL_PRICING where BVSPECPRICESOURCEID='V' AND BVSPECPRICEWHSE = '00'");
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

                   $oem_list=mysqli_query($con, "UPDATE `stock` SET `oemsku`='$oemsku' WHERE `jrpsku`='$code_specialprice'");                  
                   //$row_oem_list=  mysqli_fetch_assoc($oem_list); 
                   
                    
        }
//=================================== QTY =========================================
//select SUM(ONHAND) as ONHAND, SUM(INV_COMMITTED) as Comitted from "INVENTORY" where MISC_1='aFe Power' and WHSE in ('00','03','04');
//=================================== QTY =========================================

if($result2>'0'){
    print("<script>window.alert('Special Price table record reloaded successfully');</script>");
    print("<script>window.location='../superadmin/dashboard.php'</script>");
}
exit('Done');
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}

?>