<?php
session_start();
include('session.php'); 
$account_type=$_SESSION['account_type'];
$first_name=$_SESSION['first_name'];
$user_id=$_SESSION['user_id'];
$email=$_SESSION['email'];
$user_excol2=$_SESSION['user_excol2'];



if($login=="superadmin"){
        $login=$_SESSION['login'];
        $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];
    ?>
<?php
include ("../model/connect.php");
error_reporting(E_ALL);
$report_indexes_id = $_REQUEST['report_indexes_id'];
$results_waiting_client_approval_list = mysqli_query($con, "SELECT * FROM `waiting_client_approval_list` WHERE `report_indexes_id` = '$report_indexes_id' ");
                              while($row_waiting_client_approval_list = mysqli_fetch_array($results_waiting_client_approval_list)){ 
                              $report_indexes_id = $row_waiting_client_approval_list['report_indexes_id']; 
                              $generate_rule = $row_waiting_client_approval_list['generate_rule'];
                              $jrp_account_no = $row_waiting_client_approval_list['jrp_account_no'];
                              $user_id11 = $row_waiting_client_approval_list['user_id'];
                              $col3 = $row_waiting_client_approval_list['category'];


if($col3 == '0')
//new client adding to assign_template table ===============================
{ 
    $result_user_id = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `user_excol2` = '$jrp_account_no' ");
    $row_user_id = mysqli_fetch_array($result_user_id); 
    $user_id = $row_user_id['user_id']; 
    // adding into assign_template table when its a new client =======================
    $insert_assign_template="INSERT INTO  `assign_template`(`assign_template_id`, `report_indexes_id`, `generate_rule`, `user_id`, `jrp_account_no`, `col3`, `col4`, `col5`, `col6`, `create_date`) 
                            VALUES (NULL, '$report_indexes_id', '$generate_rule', '$user_id11', '$jrp_account_no', '', '', '', '', NOW());";
    $result_assign_template=mysqli_query($con, $insert_assign_template) or die( 'Couldnot execute query'. mysqli_error($con));

    // client notification start ==========================
    // include('notify_approval_clients.php');
    // client notification end ============================
    
}


if($col3 == '1')
//update existing client to assign_template table ===============================
{   // updating into assign_template table when its an existing client ===============
    $report_rule_set = "UPDATE `assign_template` SET `report_indexes_id`='$report_indexes_id',`generate_rule`='$generate_rule',`user_id`='$user_id11', `create_date`= NOW() WHERE  `jrp_account_no` = '$jrp_account_no'";
    $result_report_rule_set = mysqli_query($con, $report_rule_set) or die( 'Couldnot execute query'. mysqli_error($con));

    // client notification start ==========================
    include('notify_approval_clients.php');
    // client notification end ============================
}
     $report_delete_client_list = "DELETE FROM `waiting_client_approval_list` WHERE `waiting_client_approval_list`.`report_indexes_id` = '$report_indexes_id' AND `jrp_account_no`='$jrp_account_no'";
     $result_delete_client_list = mysqli_query($con, $report_delete_client_list) or die( 'Couldnot execute query'. mysqli_error($con));   
    
} //End of while loop ==============

// checking static template is updating or not ==================
    $result_template = mysqli_query($con, "SELECT COUNT(*) as 'total' FROM `template` WHERE `report_indexes_id`='$report_indexes_id' AND `flag` = '0'; ");
        while($row_template = mysqli_fetch_array($result_template)){
            $total = $row_template['total'];
            if($total=='0'){

            }
            if($total!='0'){
                // client notification start ==========================
                $result_jrp_account_no = mysqli_query($con, "SELECT `jrp_account_no` FROM `assign_template` WHERE `report_indexes_id` = '$report_indexes_id'");
                while($row_jrp_account_no = mysqli_fetch_array($result_jrp_account_no)){
                $jrp_account_no = $row_jrp_account_no['jrp_account_no'];
                include('notify_approval_clients.php');
                }
                // client notification end ============================
            }
        }
// checking static template is updating or not ==================

    // chaging template flags to 1 after approval ===================================
    $update_template = "UPDATE `template` SET `flag` = '1' WHERE `template`.`report_indexes_id` = '$report_indexes_id'";
    $result_template = mysqli_query($con, $update_template) or die( 'Couldnot execute query'. mysqli_error($con));

if($result_template){     

    print("<script>window.alert('Successfully Approved!!');</script>");
    // print("<script>window.location='../superadmin/waiting_list_details.php?report_indexes_id=$report_indexes_id'</script>");    
    print("<script>window.location='../superadmin/waiting_list.php'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>
