<?php

include_once 'connect.php';
error_reporting(0);

//$result_template = mysqli_query($con, "SELECT `report_indexes_id`,`brand_name`,`product_code_id`,GROUP_CONCAT(`warehouse`) as `warehouse` FROM `template` WHERE `flag`='1' GROUP BY `product_code_id`;");
$result_template = mysqli_query($con, "SELECT `report_indexes_id`,`brand_name`,`product_code_id` FROM `template` WHERE `flag`='1' GROUP BY `product_code_id`;");

while ($row_template = mysqli_fetch_array($result_template))
{              
              
  $report_indexes_id = $row_template['report_indexes_id'];
  $brand_name = $row_template['brand_name'];
  echo $brand_name;
  $product_code_id = $row_template['product_code_id'];
  //$warehouse = $row_template['warehouse'];



  $result_template_name = mysqli_query($con, "SELECT `index_name` FROM `report_indexes` WHERE `report_indexes_id`='$report_indexes_id' AND `flag`='1'");
  $row_template_name = mysqli_fetch_array($result_template_name);
              $index_name = $row_template_name['index_name'];
              $index_name_filename = $index_name.'qtyg0';
              //================================== EXCEL FILE CREATOR =======================================
              $delimiter = ',';          
              $f = fopen('../templates/'.$index_name_filename.'.csv', 'w+'); 
              if ($f == false) {
                  die('Error opening the file ' . $index_name_filename);
              }

              
              $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'COST', 'MAP'); 
              fputcsv($f, $fields, $delimiter);
              //===================== template name
              // $result_template = mysqli_query($con, "SELECT `brand_name`,`product_code_id`,`warehouse` FROM `template` WHERE `flag`='1' AND `report_indexes_id`='$report_indexes_id'; ");
              // //$result_template_name = mysqli_query($con, "SELECT `index_name` FROM `report_indexes` WHERE `report_indexes_id`='$report_indexes_id' ");
              // While($row_template = mysqli_fetch_array($result_template))
              // {             

              //               $brand_name = $row_template['brand_name'];
              //               $product_code_id = $row_template['product_code_id'];
              //               $warehouse = $row_template['warehouse'];
              //               //============

                            //===================== product_code
                            $result_product_code = mysqli_query($con, "SELECT `category_code` FROM `product_code` WHERE `product_code_id`='$product_code_id' AND `flag`='0'");
                            $row_product_code = mysqli_fetch_array($result_product_code);
                            $category_code = $row_product_code['category_code'];
                            echo $category_code;
                            
                            $result_stock = mysqli_query($con, "SELECT SUM(`onhand`) as onhand,SUM(`commited`) as commited, `brand`,`jrpsku`,`description`,`cost`,`map`,`prod`,`col_1` 
                                                                FROM `stock` WHERE `brand`= '$brand_name' AND `prod`='$category_code'  GROUP BY `jrpsku`;");
                            while ($row_stock = mysqli_fetch_array($result_stock))              
                            {                                               
                                                  $brand = TRIM($row_stock['brand']);
                                                  $jrpsku = TRIM($row_stock['jrpsku']);
                                                  $onhand = TRIM($row_stock['onhand']);
                                                  $commited = TRIM($row_stock['commited']);
                                                  $cost = TRIM($row_stock['cost']);
                                                  $map = TRIM($row_stock['map']);
                                                  $wh = TRIM($row_stock['col_1']);

                                                  $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
                                                          $row_special_pricing = mysqli_fetch_array($result_special_pricing);                                                         
                                                          $oemsku = TRIM($row_special_pricing['oemsku']);
                                                  

                                                  $description1 = str_replace("||||","'",$row_stock['description']);
                                                  $description2 = str_replace(","," ",$description1);
                                                  $qty = $onhand - $commited;
                                                  
                                                  // if($qty>0){
                                                  // $qty_message = "Yes";
                                                  // }
                                                  // else{
                                                  //   $qty_message = "No";
                                                  // }
                                                      //==============================END================================
                                                      //===========================Special_pricing TABLE===========================	
                                                      //if($qty>'0')
                                                                                                                
                                                            //==============================END================================                                                            
                                                            $lineData = array($brand, $jrpsku, $oemsku, $description2, $cost, $map);
                                                            $string = preg_replace('/\s+/', ' ', $lineData);
                                                            fputcsv($f, $string,',');
                                                         
                                                   // }                                 
                                } 
                          
                 //}
              //================================== EXCEL FILE & FOLDER CREATOR (FTP SERVER) =======================================                                                   
                //print("<script>window.alert('Export Success!!!');</script>");         
} 
fclose($f);  
print("<script>window.alert('Export Success!!!');</script>"); 

?>
