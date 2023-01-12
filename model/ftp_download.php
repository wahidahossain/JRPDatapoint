<?php

//================== Working codes for file Upload from ftp ===================================
error_reporting(0);
$user_id1 = $_REQUEST['user_id1'];
$user_excol2 = $_REQUEST['user_excol2'];
//================================== EXCEL FILE CREATOR =======================================
include_once 'connect.php';

$delimiter = ','; 
$filename=$user_excol2.".csv";
$f = fopen('../uploads/'.$user_excol2.'.csv', 'w+'); 
if ($f == false) {
    die('Error opening the file ' . $filename);
}
$fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'QTY', 'COST', 'MAP'); 
fputcsv($f, $fields, $delimiter); 
    
$result_assign_brand = mysqli_query($con, "SELECT * FROM `assign_brands` WHERE `user_id`='$user_id1'");
while ($row_assign_brand = mysqli_fetch_array($result_assign_brand))
{    
    
    //===========================BRAND TABLE===========================	
    $jrp_account_no = $row_assign_brand['jrp_account_no'];
    $brands = $row_assign_brand['brandname'];
    //==============================END================================

    $query = "SELECT * FROM `stock` WHERE `brand`='$brands';";
    $result_stock = mysqli_query($con, $query);
   
    while($row_stock = mysqli_fetch_array($result_stock)){ 

    // $brand = $row_stock['brand'];
    // $jrpsku = $row_stock['jrpsku'];
    // $oemsku = $row_stock['oemsku'];
    // $description = $row_stock['description'];
    $onhand = $row_stock['onhand'];
    $commited = $row_stock['commited'];
    // $cost = $row_stock['cost'];
    // $map = $row_stock['map'];

    $description1 = str_replace("||||","'",$row_stock['description']);
    $qty = $onhand - $commited;

    $lineData = array($row_stock['brand'], $row_stock['jrpsku'], $row_stock['oemsku'], $description1, $row_stock['onhand'], $row_stock['cost'], $row_stock['map']); 
    //fputcsv($f, $lineData);
    $string = preg_replace('/\s+/', '', $lineData);
    //fputcsv($f, $string,',',chr(0));
    fputcsv($f, $string,',');    
    } 
}
   // header('Content-Type: text/csv'); 
   // header('Content-Disposition: attachment; filename="'. $filename .'";'); 
    fclose($f);

//================================== EXCEL FILE CREATOR =======================================

//$ftp_server = "192.168.0.31";
$ftp_server = "192.168.0.14";
// $ftp_username = "jrpdatapoint";
// $ftp_userpass = "Wki8&Kmz5F";
$ftp_username = "datapoint";
$ftp_userpass = "datapoint123#MH";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

// open file for reading
$file = '../uploads/'.$user_excol2.'.csv';
$fp = fopen($file,"r");

// upload file
// if (ftp_fput($ftp_conn, "/public_html/ftp/adraud/test.txt", $fp, FTP_ASCII))

// $fp = fopen('php://temp', 'r+');
// fwrite($fp, $string);
// rewind($fp);

if (ftp_fput($ftp_conn, $user_excol2.'/'.$user_excol2.'.csv', $fp, FTP_ASCII))
  {
  //echo "Successfully uploaded $file.";
  print("<script>window.alert('Export Success!!!');</script>");
  print("<script>window.location='../superadmin/assign_brands_list.php'</script>");
  }
else
  {
  echo "Error uploading $file.";
  }

// close this connection and file handler
ftp_close($ftp_conn);
fclose($fp);
//========================== Working codes for file Upload from ftp END ========================

?>
