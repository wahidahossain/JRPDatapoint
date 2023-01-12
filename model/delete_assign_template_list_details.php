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
$opt = $_REQUEST['opt'];
$report_indexes_id2 = $_REQUEST['report_indexes_id'];

if (isset($_REQUEST['template_id'])) {
$template_id1 = $_REQUEST['template_id'];
                    foreach($template_id1 as $template_id)
                    {
                                $result_del = mysqli_query($con, "SELECT `report_indexes_id`,`brand_name`,`product_code_id` FROM `template` WHERE `template_id`='$template_id';");
                                while($row_del = mysqli_fetch_array($result_del))
                        {
                                    $report_indexes_id = $row_del['report_indexes_id'];
                                    $brand_name = $row_del['brand_name'];
                                    $product_code_id = $row_del['product_code_id'];

                        $sql1="DELETE FROM `template` WHERE `report_indexes_id`='$report_indexes_id' AND `brand_name`='$brand_name' AND `product_code_id`='$product_code_id'";
                        $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
                        } 
                }   
                if($result2)
                {
                    print("<script>window.alert('Record deleted successfully');</script>");
                    //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no='.$user_excol2.'</script>");
                    if($opt=='2'){
                    header("Location: ../superadmin/assign_template_list_details.php?report_indexes_id=$report_indexes_id2");
                    }
                    if($opt=='1'){
                        header("Location: ../superadmin/waiting_list_details.php?report_indexes_id=$report_indexes_id2");
                        }
                }
            }
            else{                               
                    if($opt=='2'){
                    print("<script>window.alert('Please select one option to delect from the list.');</script>");
                    header("Location: ../superadmin/assign_template_list_details.php?report_indexes_id=$report_indexes_id2");
                    //print("<script>window.location='../superadmin/assign_template_list_details.php?report_indexes_id=$report_indexes_id2</script>");
                    }

                    if($opt=='1'){
                    print("<script>window.alert('Please select one option to delect from the list.');</script>");
                    header("Location: ../superadmin/waiting_list_details.php?report_indexes_id=$report_indexes_id2");
                   //print("<script>window.location='../superadmin/waiting_list_details.php?report_indexes_id=$report_indexes_id2</script>");
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