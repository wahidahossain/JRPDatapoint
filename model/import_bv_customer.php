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
//error_reporting(0);
include("bv_connect.php");
include("connect.php");
//--------------------- BV CUSTOMER Table -------------------------------
$sql = "TRUNCATE TABLE bv_customer"; 
mysqli_query($con, $sql);
$import = odbc_exec($connection, "
SELECT
    ADDRESS.CEV_NO as jrp_account_no,
    CUSTOMER.NAME as company_name,
    ADDRESS.BVADDR1 as address1,
    ADDRESS.BVADDR2 as address2,
    ADDRESS.BVCITY as city,
    ADDRESS.BVPROVSTATE as state,
    ADDRESS.BVPOSTALCODE as postal_code,
    ADDRESS.BVCOCONTACT1NAME as customer_name,
    ADDRESS.BVCOCONTACT1EMAIL as email,
    ADDRESS.BVADDRTELNO1 as contact_no
    
FROM
    ADDRESS
    LEFT JOIN CUSTOMER ON ADDRESS.CEV_NO=CUSTOMER.CUS_NO
WHERE

    RECORD_TYPE = 'CUST' AND ADDR_TYPE = 'B'");
//$row_qty = @odbc_fetch_array($p1);
        while ($row_import = @odbc_fetch_array($import))
        {
                    $jrp_account_no = trim($row_import['jrp_account_no']);
                    $company_name1 =  trim($row_import['company_name']);
                    $company_name = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $company_name1));

                    $address = trim($row_import['address1']);
                    $address1 = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $address));

                    $address22 =  trim($row_import['address2']);
                    $address2 = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $address22));

                    $city1 = trim($row_import['city']);
                    $city = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $city1));

                    $state1 =  trim($row_import['state']);
                    $state = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $state1));

                    $postal_code1 = trim($row_import['postal_code']);
                    $postal_code = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $postal_code1));

                    $customer_name1 =  trim($row_import['customer_name']);
                    $customer_name = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $customer_name1));

                    //$email1 = trim($row_import['email']);
                    //$email = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $email1));

                    $Email01 = mb_convert_encoding($row_import['email'], "UTF-8", "iso-8859-1");

                    //eliminate extra e-mails, keeps only first one------------------
                    $email = $Email01;
                    $keywords = preg_split('/[;]/', $email,-1, PREG_SPLIT_NO_EMPTY);
                    $final_email = trim($keywords[0]);
                    //end of eliminate extra e-mails, keeps only first one-----------

                    $contact_no1 =  trim($row_import['contact_no']); 
                    $contact_no = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $contact_no1)); 

                    $sql1="INSERT INTO `bv_customer`(
                        `bv_user_id`,
                        `jrp_account_no`,
                        `customer_name`,
                        `company_name`,
                        `address1`,
                        `address2`,
                        `city`,
                        `postal_code`,
                        `state`,
                        `contact_no`,
                        `email`,
                        `col_1`,
                        `col_2`,
                        `col_3`,
                        `col_4`,
                        `col_5`,
                        `last_import`
                    )
                    VALUES(
                        NULL,
                        '$jrp_account_no',
                        '$customer_name',
                        '$company_name',
                        '$address1',
                        '$address2',
                        '$city',
                        '$postal_code',
                        '$state',
                        '$contact_no',
                        '$final_email',
                        '',
                        '',
                        '',
                        '',
                        '',
                        NOW());
                    ";
                    $result2=mysqli_query($con, $sql1);
        }
//=================================== QTY =========================================
//select SUM(ONHAND) as ONHAND, SUM(INV_COMMITTED) as Comitted from "INVENTORY" where MISC_1='aFe Power' and WHSE in ('00','03','04');
//=================================== QTY =========================================

if($result2>'0'){
    print("<script>window.alert('Customer table record reloaded successfully');</script>");
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