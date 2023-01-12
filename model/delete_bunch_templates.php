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
error_reporting(0);
$brandname = $_REQUEST['brandname'];
$report_indexes_id = $_REQUEST['report_indexes_id'];
$index_name = $_REQUEST['index_name'];

//foreach($_GET['assign_brands_id'] as $assign_brands_id){ 
    
    // $result_explode = explode('|', $report_rule_set_no);
    //         $report_indexes_id = $result_explode[0];
    //         $generate_rule = $result_explode[1];



    $brands1=implode(',',$brandname); 
    foreach($_REQUEST['brandname'] as $brandname){
        $sql_wrh="DELETE FROM `template` WHERE `brand_name`='$brandname' AND `report_indexes_id`='$report_indexes_id'";
        $result2_wrh=mysqli_query($con, $sql_wrh) or die( 'Couldnot execute query'. mysqli_error($con));                
}    
if($result2_wrh){
     //print("<script>window.alert('Record deleted successfully');</script>");
    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='".$jrp_account_no."</script>");
    header("Location: ../superadmin/template_bunch_create_step2.php?index_name=$index_name&report_indexes_id=$report_indexes_id");
}
else{
    print("<script>window.location='../superadmin/template_bunch_create_step2.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");
    //header("Location: ../superadmin/new_bunch_assignment_clients.php?jrp_account_no='".$user_excol2."");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}   
?>
   

   