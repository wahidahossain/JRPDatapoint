<?php

include_once 'connect.php';
//error_reporting(0);
//real qty
$result_template_name = mysqli_query($con, "SELECT `index_name`, `report_indexes_id` FROM `report_indexes` WHERE `flag`='1'");

while ($row_template_name = mysqli_fetch_array($result_template_name))
{              
              $report_indexes_id = $row_template_name['report_indexes_id'];
              $index_name = $row_template_name['index_name'];
              $index_name_filename = $index_name.'_realdata';
              //================================== EXCEL FILE CREATOR =======================================
              $delimiter = ',';            

              $f = fopen('../templates/'.$index_name_filename.'.csv', 'w+'); 
              if ($f == false) {
                  die('Error opening the file ' . $index_name_filename);
              }

              $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'QTY', 'COST', 'MAP'); 
              fputcsv($f, $fields, $delimiter); 




              //===================== template name
              $result_template = mysqli_query($con, "SELECT `brand_name`,`product_code_id`,`warehouse` FROM `template` WHERE `flag`='1' AND `report_indexes_id`='$report_indexes_id' GROUP BY `brand_name`; ");
              While($row_template = mysqli_fetch_array($result_template)){             

              $brand_name = $row_template['brand_name'];
              $product_code_id = $row_template['product_code_id'];
              $warehouse = $row_template['warehouse'];
              //============

              //===================== product_code
              $result_product_code = mysqli_query($con, "SELECT `category_code` FROM `product_code` WHERE `product_code_id`='$product_code_id' AND `flag`='0'");
              $row_product_code = mysqli_fetch_array($result_product_code);
              $category_code = $row_product_code['category_code'];
              
              
              $result_stock = mysqli_query($con, "SELECT SUM(`onhand`) as onhand,SUM(`commited`) as commited, `brand`,`jrpsku`,`description`,`cost`,`map`,`prod`,`col_1`,`oemsku` 
                                                  FROM `stock` WHERE `brand`= '$brand_name' AND `prod`='$category_code'  GROUP BY `jrpsku`;");
              while ($row_stock = mysqli_fetch_array($result_stock))              
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
                                    
                                    if($qty>0){
                                    $qty_message = "Yes";
                                    }
                                    else{
                                      $qty_message = "No";
                                    }
                                        //===========================Special_pricing TABLE===========================	
                                        // $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
                                        // $row_special_pricing = mysqli_fetch_array($result_special_pricing);
                                        //   $oemsku = TRIM($row_special_pricing['oemsku']);
                                          //==============================END================================
                                          $lineData = array($brand, $jrpsku, $oemsku, $description2, $qty, $cost, $map); 
                                          $string = preg_replace('/\s+/', ' ', $lineData);
                                          fputcsv($f, $string,',');                                                                         
                          }                           
                        }
                                        
                //print("<script>window.alert('Export Success!!!');</script>");         
//========================== Working codes for file Upload from ftp END ========================
} 
fclose($f);  
//print("<script>window.alert('Export Success!!!');</script>"); 
?>
