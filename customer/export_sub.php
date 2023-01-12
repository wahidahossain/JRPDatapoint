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
        $user_excol2=$_SESSION['user_excol2'];
    ?>
<?php

include_once '../model/connect.php';

 header('Content-Type: text/csv; charset=utf-8');
 header('Content-Disposition: attachment; filename=jrpdatapointreport.csv');

$delimiter = ','; 
$filename="jrpdatapointreport.csv";
$f = fopen('php://output', 'w+'); 
if ($f == false) {
    die('Error opening the file ' . $filename);
}
$fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'QTY', 'COST', 'MAP'); 
fputcsv($f, $fields, $delimiter); 
    
$result_assign_brand = mysqli_query($con, "SELECT * FROM `assign_brands` WHERE `jrp_account_no`='$user_excol2'");
while ($row_assign_brand = mysqli_fetch_array($result_assign_brand))
{    
    
    //===========================BRAND TABLE===========================	
    $jrp_account_no = $row_assign_brand['jrp_account_no'];
    $brands = $row_assign_brand['brandname'];
    $category_code = $row_assign_brand['category_code'];
    //==============================END==========================

    $query = "SELECT SUM(`onhand`) as onhand,SUM(`commited`) as commited, `brand`,`jrpsku`,`description`,`cost`,`map`,`prod`,`col_1` 
    FROM `stock` WHERE `brand`='$brands' AND `prod`='$category_code' GROUP BY `jrpsku`;";
    $result_stock = mysqli_query($con, $query);
   
    while($row_stock = mysqli_fetch_array($result_stock)){ 

        $brand = TRIM($row_stock['brand']);
        $jrpsku = TRIM($row_stock['jrpsku']);
        // $oemsku = $row_stock['oemsku'];
        // $description = $row_stock['description'];
        $onhand = TRIM($row_stock['onhand']);
        $commited = TRIM($row_stock['commited']);
        $cost = TRIM($row_stock['cost']);
        $map = TRIM($row_stock['map']);
        $wh = TRIM($row_stock['col_1']);

        $description1 = str_replace("||||","'",$row_stock['description']);
        $description2 = str_replace(","," ",$description1);
        $qty = $onhand - $commited;

        //===========================Special_pricing TABLE===========================	
        $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
        while ($row_special_pricing = mysqli_fetch_array($result_special_pricing)){
        $oemsku = TRIM($row_special_pricing['oemsku']);
        //==============================END================================

    $lineData = array($brand, $jrpsku, $oemsku, $description2, $qty, $cost, $map); 
    //fputcsv($f, $lineData);
    $string = preg_replace('/\s+/', '', $lineData);
    //fputcsv($f, $string,',',chr(0));
    fputcsv($f, $string,',');
    }
} 
}
    //header('Content-Type: text/csv'); 
   // header('Content-Disposition: attachment; filename="'. $filename .'";'); 
fclose($f);
?>


<?php
        }            
else{    
    print("<script>window.location='../index_warning.php?pass=message'</script>");  
}
?>