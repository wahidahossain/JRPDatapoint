<?php
include ("connect.php");

//'$report_indexes_id', '$generate_rule', '$user_id', '$user_excol2_e'
// ============ getting template name ==============
// if($report_indexes_id != '0'){
// $query_report_indexes="SELECT `index_name` FROM `report_indexes` WHERE `report_indexes_id` = '$report_indexes_id'";
//                                         $result_report_indexes=mysqli_query($con, $query_report_indexes);
//                                         $row_report_indexes = mysqli_fetch_array($result_report_indexes) ;      
//                                         $index_name = $row_report_indexes['index_name'];
// }
// else 
// {
//     $index_name = "Manual Template";
// }
// ============ END template name ==============

//----------- Client Name ---------------------------------------------------------------------------------------
$result_first_name = mysqli_query($con, "SELECT `first_name`, `email` FROM `user` WHERE `user_excol2`='$jrp_account_no';");                    
                        $row_first_name = mysqli_fetch_array($result_first_name);
                        $first_name = $row_first_name['first_name'];
                        $email = $row_first_name['email'];
//----------- Client Name ---------------------------------------------------------------------------------------

// ============= email details ============= 
//ini_set('SMTP', "exchange.jrponline.com");
ini_set('SMTP', "exch2019.jrponline.com");
// ini_set('smtp_port', "587");
ini_set('sendmail_from', "SteveS@jrponline.com");

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: JRP Inc. <SteveS@jrponline.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

$to = "wahida@jrponline.com";
//$to = $email;
$subject = "JRPDatapoint Feed - New Brands & Product Category Approval Notification!!!";
$body = "
Hello $first_name,<br>
The Brands & Product Categories of your Daily JRPDatapoint feed were updated. We are requesting to check the JRP Datapoint Feed report for the newly updated list.<br><br>

Sincerely,<br>
JRP Management.<br><br> 
";

mail($to, $subject, $body, $headers);
  //  print("<script>window.alert('Account activation link send to customer e-mail address');</script>");
  //  print("<script>window.location='../superadmin/dashboard.php'</script>");
//On activation, you will receive a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.<br><br>

?> 
