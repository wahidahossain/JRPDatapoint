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
            $vl=$_REQUEST['vl'];
            $report_indexes_id=$_REQUEST['report_indexes_id'];
            $jrp_account_no=$_REQUEST['jrp_account_no'];
            $waiting_client_approval_list_id = $_REQUEST['waiting_client_approval_list_id'];            
            //$category_code1=implode(',',$category_code);
                foreach($_REQUEST['waiting_client_approval_list_id'] as $waiting_client_approval_list_id){
                $sql1="DELETE FROM `waiting_client_approval_list` WHERE `waiting_client_approval_list_id`='$waiting_client_approval_list_id'";
                $result2=$result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
                }
if($result2){
    if($vl==1){
        print("<script>window.location='../superadmin/waiting_list_details.php?jrp_account_no=".$jrp_account_no."&vl=1&report_indexes_id=".$report_indexes_id."'</script>"); 
    }
    //print("<script>window.alert('Record updated successfully');</script>");
    else{
    print("<script>window.location='../superadmin/waiting_list_details.php?report_indexes_id=".$report_indexes_id."'</script>");
    }
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>