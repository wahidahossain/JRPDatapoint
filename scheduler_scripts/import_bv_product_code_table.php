<?php
//------------------------------------------ Search and fetch from bv INVENTORY-----------------------------------------------------
//$serverDSN = 'BVSTAGING';
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
        
}
//include_once('import_bv_data_special_price.php');

include_once('import_bv_data_stock_table.php');
include_once('import_new_customer.php');
include_once('creating_directories.php');
include_once('general_ftp_export.php');
include_once('generate_template_option1.php');
include_once('generate_template_option2.php');
include_once('generate_template_option3.php');
sleep(2);
include_once('copy_reports_folders.php');
?>