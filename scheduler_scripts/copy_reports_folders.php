<?php
include('connect.php');

// get template assignment list for clients --------------------------------------
$result_assignment = mysqli_query($con, "SELECT `report_indexes_id`,`jrp_account_no`,`generate_rule` FROM `assign_template` WHERE `report_indexes_id`!='0'");
while ($row_assignment = mysqli_fetch_array($result_assignment))
{              
              $report_indexes_id = $row_assignment['report_indexes_id'];
              $jrp_account_no = $row_assignment['jrp_account_no'];
              $generate_rule = $row_assignment['generate_rule'];
    
    // get template name here for matching file names--------------------------------------
    $result_template_name = mysqli_query($con, "SELECT `index_name` FROM `report_indexes` WHERE `report_indexes_id`='$report_indexes_id'");
    $row_template_name = mysqli_fetch_array($result_template_name);
    $index_name = $row_template_name['index_name'];
    //end

    //match template files according to rule set-----------------------------
    //Rule set: 1: qty>0 2: qty=y/n 3: qty=real stock 	
    if($generate_rule=='1'){
        $index_name_filename = $index_name.'_qtyg0';
    }
    if($generate_rule=='2'){
        $index_name_filename = $index_name.'_y_n';
    }
    if($generate_rule=='3'){
        $index_name_filename = $index_name.'_realdata';
    }
    //end


    //delete files before coping in the folder-----------------------------
    $files = glob('C:/FTP/Wholesale/'.$jrp_account_no.'/*');  // get all file names    
    foreach($files as $file){ // iterate files
      if(is_file($file)) {
        unlink($file); // delete file
      }
    }


    //copying template files to client folders
            $newfile = 'C:/FTP/Wholesale/'.$jrp_account_no.'/'.$jrp_account_no.'.csv';
            $oldfile = '../templates/'.$index_name_filename.'.csv';           
            copy($oldfile, $newfile);
    //end

}

$result_assignment = mysqli_query($con, "SELECT `report_indexes_id`,`jrp_account_no`,`generate_rule` FROM `assign_template` WHERE `report_indexes_id`='0'");
while ($row_assignment = mysqli_fetch_array($result_assignment))
{              
              $report_indexes_id = $row_assignment['report_indexes_id'];
              $jrp_account_no = $row_assignment['jrp_account_no'];
              $generate_rule = $row_assignment['generate_rule'];
              
//delete files before coping in the folder-----------------------------
$files = glob('C:/FTP/Wholesale/'.$jrp_account_no.'/*');  // get all file names    
foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
  }
}

 //copying template files to client folders
 $newfile = 'C:/FTP/Wholesale/'.$jrp_account_no.'/'.$jrp_account_no.'.csv';
 $oldfile = '../uploads/'.$jrp_account_no.'.csv';           
 copy($oldfile, $newfile);
 //end
}

?>