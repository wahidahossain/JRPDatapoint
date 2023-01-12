<?php

include_once 'connect.php';
//error_reporting(0);


$result_assign_brand1 = mysqli_query($con, "SELECT `jrp_account_no` FROM `assign_brands` GROUP BY `jrp_account_no`; ");
while ($row_assign_brand1 = mysqli_fetch_array($result_assign_brand1))
{
              //$user_id1 = $row_assign_brand1['user_id'];
              $jrp_account_no = $row_assign_brand1['jrp_account_no'];
              //================================== EXCEL FILE CREATOR =======================================
              $delimiter = ','; 
              //$jrp_account_no_rename = str_replace("/","-",$jrp_account_no);
              $jrp_account_no_rename = trim(preg_replace('/[^A-Za-z0-9\-]/', '', $jrp_account_no));
              $filename=TRIM($jrp_account_no_rename).".csv";

              // if(!is_file($filename)){
              // file_put_contents('../uploads/'.$filename, " ");
              // }

              $f = fopen('../uploads/'.$jrp_account_no_rename.'.csv', 'w+'); 
              if ($f == false) {
                  die('Error opening the file ' . $filename);
              }

              $fields = array('BRAND', 'JRPSKU', 'OEMSKU', 'DESCRIPTION', 'QTY', 'COST', 'MAP'); 
              fputcsv($f, $fields, $delimiter); 
              
              $result_assign_brand = mysqli_query($con, "SELECT * FROM `assign_brands` WHERE `jrp_account_no`='$jrp_account_no'");
              while ($row_assign_brand = mysqli_fetch_array($result_assign_brand))
                {    
                    
                        //===========================BRAND TABLE===========================	
                        // $jrp_account_no = $row_assign_brand['jrp_account_no'];
                        $brands = $row_assign_brand['brandname'];
                        $category_code = $row_assign_brand['category_code'];
                        //==============================END================================

                        $query = "SELECT SUM(`onhand`) as onhand,SUM(`commited`) as commited, `brand`,`jrpsku`,`description`,`cost`,`map`,`prod`,`col_1` 
                                  FROM `stock` WHERE `brand`LIKE '%$brands%' AND `prod`='$category_code' GROUP BY `jrpsku`;";
                        $result_stock = mysqli_query($con, $query);            
                        while($row_stock = mysqli_fetch_array($result_stock))
                        {
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
                                    
                                    /*if($qty>0){
                                    $qty_message = "Yes";
                                    }
                                    else{
                                      $qty_message = "No";
                                    }
                                    */
                                    //===========================Special_pricing TABLE checking===========================	
                                    $result_special_pricing_checking = mysqli_query($con, "SELECT COUNT(*) as 'check' FROM `special_pricing`; ");
                                    $row_special_pricing_checking = mysqli_fetch_array($result_special_pricing_checking);
                                    $check = $row_special_pricing_checking['check'];
                                    if($check>0)
                                    {
                                        //==============================END================================
                                        //===========================Special_pricing TABLE===========================	
                                        $result_special_pricing = mysqli_query($con, "SELECT `oemsku` FROM `special_pricing` WHERE `code_specialprice`='$jrpsku'");
                                        while ($row_special_pricing = mysqli_fetch_array($result_special_pricing))
                                        {
                                          $oemsku = TRIM($row_special_pricing['oemsku']);
                                          //==============================END================================
                                          $lineData = array($brand, $jrpsku, $oemsku, $description2, $qty, $cost, $map); 
                                          //fputcsv($f, $lineData);
                                          $string = preg_replace('/\s+/', '', $lineData);
                                          //fputcsv($f, $string,',',chr(0));
                                          fputcsv($f, $string,',');
                                        } 
                                  } // end of $check>0
                                  else
                                  {
                                    print("<script>window.alert('Sorry special pricing table is empty, Import the table first (Go to: Leftmenu > Import Special Pricing)!!');</script>");
                                    print("<script>window.location='../superadmin/dashboard.php'</script>");
                                  }
                          } 
                              

              //================================== EXCEL FILE & FOLDER CREATOR (FTP SERVER) =======================================
              
              $path = 'Wholesale/'.$jrp_account_no_rename;              
              include ('connect_ftp.php');
              // open file for reading

              $file = '../uploads/'.$jrp_account_no_rename.'.csv';
              $fp = fopen($file,"r");
              //if (ftp_fput($ftp_conn, $jrp_account_no.'/'.$jrp_account_no.'.csv', $fp, FTP_BINARY))
              if(ftp_put($ftp_conn, 'Wholesale/'.$jrp_account_no_rename.'/'.$jrp_account_no_rename.'.csv', $file, FTP_ASCII))
                {
                //echo "Successfully uploaded $file.";
                print("<script>window.alert('Export Success!!!');</script>");
                print("<script>window.location='../superadmin/dashboard.php'</script>");
                }
              else
                {
                //echo "Error uploading $file.";
                //print("<script>window.alert('Error uploading .csv file to the FTP Folder, Please be sure FTP Folder is created or Folder Name matches with JRP account no.');</script>");
                //print("<script>window.location='../superadmin/dashboard.php'</script>");
                }
                // close this connection and file handler
                
                // fclose($fp);
            }
            
//========================== Working codes for file Upload from ftp END ========================
}
ftp_close($ftp_conn);
fclose($f);

?>
