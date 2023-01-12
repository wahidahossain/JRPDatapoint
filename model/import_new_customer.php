<?php

//=============================== IMPORT from file ========================================================

include_once 'connect.php';
error_reporting(0);
 
if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $first_name   = $line[1];
                 $last_name  = $line[2];
                 $username  = $line[3];
                 $password = $line[4];
                 $email = $line[5];
                 $user_excol2 = $line[12];
                
               
                  $db->query("INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `email`, `account_status`, `logcount`, `last_login`, `ip`, `account_type`, 
                  `user_excol1`, `user_excol2`, `user_excol3`, `user_excol4`) VALUES ('0', '".$first_name."', '".$last_name."', '".$username."', '".$password."', 
                  '".$email."', '1', '0', '2022-05-20 17:13:49', '0', 'customer', 'unblock', '".$user_excol2."', '0', '0')");
                    
                    //------------------------------------------ COUNT max user id for profile table------------------------------------------------------------
                    $result = mysqli_query($con, "SELECT MAX(`user_id`) as 'user_id' FROM `user` ");
                    $row = mysqli_fetch_array($result);
                    $user_id_profile = $row['user_id'];
                    //------------------------------------------ COUNT max user id for profile table------------------------------------------------------------


                    //------------------------------------------ Search and fetch from bv-----------------------------------------------------
                    include("bv_connect.php");
                    //--------------------- BV CUSTOMER Table -------------------------------
                    $results_customer = odbc_exec($connection, "select NAME from CUSTOMER where CUS_NO = '$user_excol2'");
                    $row_customer = @odbc_fetch_array($results_customer);
                    $NAME = $row_customer['NAME'];
                    //--------------------- BV ADDRESS Table -------------------------------

                    //profile_id user_id jrp_account_no company_name address1 city postal_code state contact_no col1col2col3col4col5col6col7
                    $results_address = odbc_exec($connection, "select * from ADDRESS where CEV_NO = '$user_excol2'");
                    $row_address = @odbc_fetch_array($results_address);
                    $BVADDR1 = $row_address['BVADDR1'];
                    $BVCITY = $row_address['BVCITY'];
                    $BVPOSTALCODE = $row_address['BVPOSTALCODE'];
                    $BVPROVSTATE = $row_address['BVPROVSTATE'];
                    $BVADDRTELNO1 = $row_address['BVADDRTELNO1'];
                    //------------------------------------------ Search and fetch from bv-----------------------------------------------------

                    //------------------------------------------ Insert Into Profile Table Mysql------------------------------------------------------------

                    $col1 = '';
                    $col2 = '';
                    $col3 = '';
                    $col4 = '';
                    $col5 = '';
                    $col6 = '';
                    $col7 = '';

                    $sql_profile="INSERT
                    INTO
                    `profile`(
                        `profile_id`,
                        `user_id`,
                        `jrp_account_no`,
                        `company_name`,
                        `address1`,
                        `city`,
                        `postal_code`,
                        `state`,
                        `contact_no`,
                        `col1`,
                        `col2`,
                        `col3`,
                        `col4`,
                        `col5`,
                        `col6`,
                        `col7`
                    )
                    VALUES(
                    NULL,
                    '$user_id_profile',
                    '$user_excol2',
                    '$NAME',
                    '$BVADDR1',
                    '$BVCITY',
                    '$BVPOSTALCODE',
                    '$BVPROVSTATE',
                    '$BVADDRTELNO1',
                    '$col1',
                    '$col2',
                    '$col3',
                    '$col4',
                    '$col5',
                    '$col6',
                    '$col7'
                    );
                    ";

                    $result_profile=mysqli_query($con, $sql_profile);

                    //------------------------------------------ Insert Into Profile Table Mysql------------------------------------------------------------
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}
header("Location: ../superadmin/add_new_customer.php".$qstring);
?>