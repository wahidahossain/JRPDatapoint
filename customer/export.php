<?php

session_start();

  
include('includes/session.php'); 
//$login=$_SESSION['login'];
$account_type=$_SESSION['account_type'];
$first_name=$_SESSION['first_name'];
$user_id=$_SESSION['user_id'];
if($login=="customer"){
        $login=$_SESSION['login'];
        $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];
    ?>



<?php

include_once '../model/connect.php';
    
$result_assign_brand = mysqli_query($con, "SELECT * FROM `assign_brands` WHERE `user_id`='$user_id'");
while ($row_assign_brand = mysqli_fetch_array($result_assign_brand))
{    
    //===========================BRAND TABLE===========================	
    $jrp_account_no = $row_assign_brand['jrp_account_no'];
    $brandname = $row_assign_brand['brandname'];
    //==============================END==========================
    
    
    $query = "SELECT
    `inventory`.`code` JRPSKU,
    `inventory`.`brands` BRANDS,
    `inventory`.`description` DESCRIPTION,
    `inventory`.`onhand_qty` onhand_qty,
    `inventory`.`comitted_qty` comitted_qty,    
    `pricing`.`cost` COST,
    `pricing`.`map` MAP,
    `pricing`.`vendor_code` OEMSKU
FROM
    `inventory`
LEFT JOIN pricing ON `inventory`.`code` = `pricing`.`code_price`
WHERE
    `inventory`.`brands` = '$brandname';";      






    $delimiter = ','; 
    $filename="jrpinsightsreport.csv";
     
    // Create a file pointer 
    //$f = fopen ('C:\wamp2\www\jrp_client_solution\client_application\customer\jrpinsightsreport.csv','w');
    $f = fopen ('jrpinsightsreport.csv','w+');
    //$f = fopen('php://memory', 'w+'); 
    if ($f == false) {
        die('Error opening the file ' . $filename);
    }
     //BRAND	JRPSKU	OEMSKU	DESCRIPTION	QTY	COST	MAP

    // Set column headers 
    $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'QTY', 'COST', 'MAP'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    $result_inventory = mysqli_query($con, $query);
    while($row_inventory = mysqli_fetch_array($result_inventory)){ 

        //$result_inventory = mysqli_query($con, $query);
        //$row_inventory = mysqli_fetch_array($result_inventory);
        $code = $row_inventory['JRPSKU'];
        $brands = $row_inventory['BRANDS'];
        $description = $row_inventory['DESCRIPTION'];
        $cost = $row_inventory['COST'];
        $map = $row_inventory['MAP'];
        $vendor_code = $row_inventory['OEMSKU'];
        $onhand_qty = $row_inventory['onhand_qty'];
        $comitted_qty = $row_inventory['comitted_qty'];
        $qty = $onhand_qty - $comitted_qty;



        $lineData = array($brands, $code, $vendor_code, $description, $qty, $cost, $map); 
        fputcsv($f, $lineData,',',chr(0)); 


    }
} 
     
    // Move back to beginning of file 
    //fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="'. $filename .'";'); 
     
    //output all remaining data on a file pointer 
    //fpassthru($f); 
//} 
fclose($f);
//exit;
?>


<?php
        }            
else{    
    print("<script>window.location='../index_warning.php?pass=message'</script>");  
}
?>