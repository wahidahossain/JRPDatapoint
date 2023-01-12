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
//error_reporting(E_ERROR);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//===========================USER TABLE===========================

          $jrp_account_no = false;
          if(isset($_REQUEST['jrp_account_no']))
          {

                  $jrp_account_no = $_REQUEST['jrp_account_no'];         
                  $report_indexes_id = $_REQUEST['report_indexes_id'];
                  $generate_rule = $_REQUEST['generate_rule'];
                    foreach($_REQUEST['jrp_account_no'] as $jrp_account_no)
                          {                            
                                        $query="select `user_id` FROM `user` WHERE `user_excol2`='$jrp_account_no'";
                                        $result=mysqli_query($con, $query);
                                        $row=mysqli_fetch_array($result) ;      
                                        $user_id11 = $row['user_id'];

                                        $report_rule_set_check_existing ="SELECT COUNT(*) as 'cnt' FROM `waiting_client_approval_list` WHERE `jrp_account_no`='$jrp_account_no'";
                                        $result_report_rule_set_check_existing=mysqli_query($con, $report_rule_set_check_existing) or die( 'Couldnot execute query'. mysql_error());
                                        $row_cnt = mysqli_fetch_array($result_report_rule_set_check_existing);
                                        $cnt = $row_cnt['cnt'];
                                            if($cnt=='0')
                                                {
                                                    $update_client_group =   mysqli_query($con, "INSERT INTO `waiting_client_approval_list` (`waiting_client_approval_list_id`, `report_indexes_id`, `generate_rule`, `user_id`, `jrp_account_no`, `category`, `col4`, `col5`, `col6`, `create_date`) 
                                                                              VALUES (NULL, '$report_indexes_id', '$generate_rule', '$user_id11', '$jrp_account_no', '1', '', '', '', NOW());");
                                                      if($update_client_group=='1')
                                                      {
                                                        //print("<script>window.alert('Client group moved to new template section successfully!!!');</script>");
                                                        print("<script>window.location='../superadmin/assign_template_list.php'</script>");
                                                      }
                                                }
                                              else
                                                  {
                                                      print("<script>window.alert('Rule set for this client waiting for approval.')</script>");
                                                      print("<script>window.location='../superadmin/assign_template_list.php'</script>");
                                                  }
                            }
           }

          else
          {
            print("<script>window.alert('Please select a client first.');</script>");
            print("<script>window.location='../superadmin/assign_template_list.php'</script>");
          }
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>