<?php
  include('../model/connect.php');
$jrp_account_no = $_REQUEST['jrp_account_no'];
error_reporting(0);
ini_set('display_errors', 0);
              //$path = 'C:/FTP/Wholesale/'.$jrp_account_no;

              //get report type assigned for this client
              $result_template_name = mysqli_query($con, "SELECT * FROM `assign_template` WHERE `jrp_account_no`='$jrp_account_no'");
              $row_template_name = mysqli_fetch_array($result_template_name);
              $generate_rule = $row_template_name['generate_rule']; 
              $report_indexes_id = $row_template_name['report_indexes_id'];
              
              // get template name here for matching file names--------------------------------------
                $result_template_name = mysqli_query($con, "SELECT `index_name` FROM `report_indexes` WHERE `report_indexes_id`='$report_indexes_id'");
                $row_template_name = mysqli_fetch_array($result_template_name);
                $index_name = $row_template_name['index_name'];
                //end


              //when its static template report
              if($report_indexes_id!='0'){

                    if($generate_rule=='1'){
                        $index_name_filename = $index_name.'_qtyg0';
                    }
                    if($generate_rule=='2'){
                        $index_name_filename = $index_name.'_y_n';
                    }
                    if($generate_rule=='3'){
                        $index_name_filename = $index_name.'_realdata';
                    }
                    
                    $path = 'C:/FTP/Wholesale/'.$jrp_account_no.'/'.$jrp_account_no.'.csv';
                    $newfile = $index_name_filename.'.csv';
                    if(isset($path)){
                    print("<script>window.alert('Client Feed Downloaded Successfully!!');</script>");
                    //header("Content-type:application/pdf");
                    // header('Content-Disposition: attachment; filename=' . $jrp_account_no.'.csv');
                    // readfile( $path );
                    }
                    if(!isset($path)){
                      print("<script>window.alert('No client feed downloaded yet, please try again!');</script>");
                    }
                    
            }
            //when its manual report
            if($report_indexes_id=='0'){
                $path = 'C:/FTP/Wholesale/'.$jrp_account_no.'/'.$jrp_account_no.'.csv';
                $newfile = $jrp_account_no.'.csv';            
                //header("Content-type:application/pdf");
                
                //header("Location: $path");
                // echo readfile( $path );
                // print("<script>window.alert('Client Feed Downloaded Successfully!!');</script>");
                if(isset($path)){
                  print("<script>window.alert('Client Feed Downloaded Successfully!!');</script>");
                  //header("Content-type:application/pdf");
                  //header('Content-Disposition: attachment; filename=' . $jrp_account_no.'.csv');
                  header('Content-Disposition: attachment; filename=' . $jrp_account_no.'.csv');
                  readfile( $path );
                  }
                  if(!isset($path)){
                    print("<script>window.alert('No client feed downloaded yet, please try again!');</script>");
                  }
            
            }


            //$path = 'yourpath/file.pdf';
            

?>