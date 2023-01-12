<?php

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
error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set('error_log', '../logs/errors.log'); // Logging file path


$result_assign_template = mysqli_query($con, "SELECT `jrp_account_no` FROM `assign_template` WHERE `report_indexes_id`='0'");
while ($row_assign_template = mysqli_fetch_array($result_assign_template))
{
  $jrp_account_no = $row_assign_template['jrp_account_no'];
  //$generate_rule = $row_assign_template['generate_rule'];

  //Checking rule set of qty column for specific client---------------------
  $result_check_rule = mysqli_query($con, "SELECT `generate_rule` FROM `assign_template` WHERE `jrp_account_no`='$jrp_account_no' AND `col_1`='1'");
  $row_check_rule = mysqli_fetch_array($result_check_rule);
  $generate_rule = $row_check_rule['generate_rule'];
  //------------------------- End



//creating .csv file with header--------------------
  $delimiter = ','; 
  $jrp_account_no_rename = trim(preg_replace('/[^A-Za-z0-9\-]/', '', $jrp_account_no));
  $filename=TRIM($jrp_account_no_rename).".csv"; 

  $f = fopen('../uploads/'.$jrp_account_no_rename.'.csv', 'w+'); 
  if ($f == false) {
      die('Error opening the file ' . $filename);
  }
  if($generate_rule=='1'){
  $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'COST', 'MAP');
  fputcsv($f, $fields, $delimiter);
  }
  if($generate_rule=='2'){ 
  $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'IN-STOCK', 'COST', 'MAP');
  fputcsv($f, $fields, $delimiter);
  }
  if($generate_rule=='3'){
  $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'QTY', 'COST', 'MAP');
  fputcsv($f, $fields, $delimiter);
  }




  $result_assign_brand1 = mysqli_query($con, "SELECT `category_code`,`brandname` FROM `assign_brands` WHERE `jrp_account_no`='$jrp_account_no'");
  while ($row_assign_brand1 = mysqli_fetch_array($result_assign_brand1))
  {
    $category_code = $row_assign_brand1['category_code'];
    $brandname = $row_assign_brand1['brandname'];




  $query = "SELECT `brand`,`jrpsku`,`description`, SUM(`onhand`) as onhand, SUM(`commited`) as commited,`cost`,`map`,`col_1`, `oemsku` FROM `stock` 
  WHERE `brand` = '$brandname' AND `prod` = '$category_code' GROUP BY `jrpsku`;";
  $result_stock = mysqli_query($con, $query);            
                        while($row_stock = mysqli_fetch_array($result_stock))
                        {
                                    $brand = ($row_stock['brand']);
                                    $jrpsku = ($row_stock['jrpsku']);
                                    $oemsku = ($row_stock['oemsku']);
                                    $onhand = ($row_stock['onhand']);
                                    $commited = ($row_stock['commited']);
                                    $cost = ($row_stock['cost']);
                                    $map = ($row_stock['map']);
                                    $wh = ($row_stock['col_1']);

                                    $description1 = str_replace("||||","'",$row_stock['description']);
                                    $description2 = str_replace(","," ",$description1);
                                    $qty = $onhand - $commited;
                                    

                                    // OPTION 1        
                                    if($generate_rule=='1'){                                      
                                      if($qty>'0') // Print only rows got more than 0
                                      {                                        
                                          //==============================END================================
                                          $lineData = array($brand, $jrpsku, $oemsku, $description2, $cost, $map); 
                                          $string = preg_replace('/\s+/', ' ', $lineData);
                                          fputcsv($f, $string,',');                                      
                                      }
                                }


                            // OPTION 2
                                if($generate_rule=='2'){
                                  if($qty>0){
                                    $qty_message = "Yes";
                                    }
                                    else{
                                      $qty_message = "No";
                                    }
                                    $lineData = array($brand, $jrpsku, $oemsku, $description2, $qty_message, $cost, $map); 
                                    $string = preg_replace('/\s+/', ' ', $lineData);
                                    fputcsv($f, $string,',');
                            }


                            // OPTION 3
                            if($generate_rule=='3'){
                                  $lineData = array($brand, $jrpsku, $oemsku, $description2, $qty, $cost, $map); 
                                  $string = preg_replace('/\s+/', ' ', $lineData);
                                  fputcsv($f, $string,',');
                                }
                            } 
}
}
fclose($f);

?>
