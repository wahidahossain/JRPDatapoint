<?php
session_start();
include('session.php'); 
//$login=$_SESSION['login'];
        $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];

 if($login=="superadmin"){
 $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];
    ?>
<?php
include ("../model/connect.php");
//error_reporting(0);
$report_indexes_id_old = $_REQUEST['report_indexes_id_old'];
$report_indexes_id_new = $_REQUEST['report_indexes_id_new'];
$index_name = $_REQUEST['index_name'];

                     
    $result = mysqli_query($con, "SELECT * FROM `template` WHERE `report_indexes_id`='$report_indexes_id_old'");
    while ($row = mysqli_fetch_array($result))
        {               
        $report_indexes_id = $report_indexes_id_new;
        $brand_name = $row['brand_name'];
        $product_code_id = $row['product_code_id'];
        $warehouse = $row['warehouse'];

                      $insert_query =  mysqli_query($con, "INSERT INTO `template` (`template_id`, `report_indexes_id`, `brand_name`, `product_code_id`, `warehouse`, `col2`, `col3`, `col4`, `flag`, `last_imported`) 
                                                                           VALUES (NULL, '$report_indexes_id_new', '$brand_name', '$product_code_id', '$warehouse', '', '', '', '0', NOW());") or die( mysqli_error($con));
        
    }       
                    if($insert_query){
                        //print("<script>window.alert('Product category assigned to client accounts successfully');</script>");
                        //print("<script>window.location='../superadmin/template_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id_new."'</script>");
                        print("<script>window.location='../superadmin/assign_template_list.php'</script>");

                    }
           

// else
// {
//     print("<script>window.location='../superadmin/template_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id_new."'</script>");

// }
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>