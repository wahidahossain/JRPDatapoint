<?php

include_once 'connect.php';
//error_reporting(0);


$result_assign_brand1 = mysqli_query($con, "SELECT `jrp_account_no` FROM `assign_template` WHERE `report_indexes_id`='0'");
while ($row_assign_brand1 = mysqli_fetch_array($result_assign_brand1))
{
              $jrp_account_no = $row_assign_brand1['jrp_account_no'];
              //================================== EXCEL FILE CREATOR =======================================
              $delimiter = ','; 
              $jrp_account_no_rename = trim(preg_replace('/[^A-Za-z0-9\-]/', '', $jrp_account_no));
              $filename=TRIM($jrp_account_no_rename).".csv";
              
              
              $f = fopen('../uploads/'.$jrp_account_no_rename.'.csv', 'w+'); 
              if ($f == false) {
                  die('Error opening the file ' . $filename);
              }

              $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'IN-STOCK', 'COST', 'MAP'); 
              fputcsv($f, $fields, $delimiter); 
              
              $result_assign_brand = mysqli_query($con, "SELECT `brandname`,`category_code` FROM `assign_brands` WHERE `jrp_account_no`='$jrp_account_no'");
              while ($row_assign_brand = mysqli_fetch_array($result_assign_brand))
                {    
                    
                        //===========================BRAND TABLE===========================	
                        $brands = $row_assign_brand['brandname'];
                        $category_code = $row_assign_brand['category_code'];
                        //==============================END================================
                        $query = "SELECT SUM(`onhand`) as onhand,SUM(`commited`) as commited, `brand`,`jrpsku`,`description`,`cost`,`map`,`prod`,`col_1` 
                                  FROM `stock` WHERE `brand`= '$brands' AND `prod`='$category_code' GROUP BY `jrpsku`;";

                        $result_stock = mysqli_query($con, $query);            
                        while($row_stock = mysqli_fetch_array($result_stock))
                        {
                                    $brand = TRIM($row_stock['brand']);
                                    $jrpsku = TRIM($row_stock['jrpsku']);
                                    $onhand = TRIM($row_stock['onhand']);
                                    $commited = TRIM($row_stock['commited']);
                                    $cost = TRIM($row_stock['cost']);
                                    $map = TRIM($row_stock['map']);
                                    $wh = TRIM($row_stock['col_1']);

                                    $description1 = str_replace("||||","'",$row_stock['description']);
                                    $description2 = str_replace(","," ",$description1);
                                    $qty = $onhand - $commited;
                                    
                                    //checking rule set of qty column for specific client---------------------
                                    $result_check_rule = mysqli_query($con, "SELECT `generate_rule` FROM `assign_template` WHERE `jrp_account_no`='$jrp_account_no'");
                                    $row_check_rule = mysqli_fetch_array($result_check_rule);
                                    $generate_rule = $row_check_rule['generate_rule'];

                                    //Rule set: 1: qty>0 2: qty=y/n 3: qty=real stock 
                                    //------------RULE 1-------------------------------------------------------	
                                    if($generate_rule=='1'){
                                          if($qty>'0'){
                                            $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
                                            while ($row_special_pricing = mysqli_fetch_array($result_special_pricing))
                                            {
                                              $oemsku = TRIM($row_special_pricing['oemsku']);
                                              //==============================END================================
                                              $lineData = array($brand, $jrpsku, $oemsku, $description2, $cost, $map); 
                                              $string = preg_replace('/\s+/', ' ', $lineData);
                                              fputcsv($f, $string,',');
                                            }
                                          }
                                    }
                                    //------------RULE 2-------------------------------------------------------
                                    if($generate_rule=='2'){
                                      if($qty>0){
                                        $qty_message = "Yes";
                                        }
                                        else{
                                          $qty_message = "No";
                                        }
                                        $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
                                        while ($row_special_pricing = mysqli_fetch_array($result_special_pricing))
                                        {
                                          $oemsku = TRIM($row_special_pricing['oemsku']);
                                          //==============================END================================
                                          $lineData = array($brand, $jrpsku, $oemsku, $description2, $qty_message, $cost, $map); 
                                          //fputcsv($f, $lineData);
                                          $string = preg_replace('/\s+/', ' ', $lineData);
                                          //fputcsv($f, $string,',',chr(0));
                                          fputcsv($f, $string,',');
                                        }                                       

                                    }
                                    //------------RULE 3-------------------------------------------------------
                                    if($generate_rule=='3'){
                                      $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
                                        while ($row_special_pricing = mysqli_fetch_array($result_special_pricing))
                                        {
                                          $oemsku = TRIM($row_special_pricing['oemsku']);
                                          //==============================END================================
                                          $lineData = array($brand, $jrpsku, $oemsku, $description2, $qty, $cost, $map); 
                                          //fputcsv($f, $lineData);
                                          $string = preg_replace('/\s+/', ' ', $lineData);
                                          //fputcsv($f, $string,',',chr(0));
                                          fputcsv($f, $string,',');
                                        }
                                        //ob_flush();
                                    }                                                                                                         
                                  
                              }                
                            }
                //coping file to client folders----------------     
                $newfile = '../Wholesale/'.$jrp_account_no.'/'.$jrp_account_no_rename.'.csv';
                $oldfile = '../uploads/'.$jrp_account_no_rename.'.csv'; 
                copy($oldfile, $newfile);
//========================== Working codes for file Upload from ftp END ========================
}
fclose($f);
print("<script>window.alert('Export Success!!!');</script>"); 


?>
