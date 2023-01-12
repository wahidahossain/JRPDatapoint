<?php
include ("connect.php");

//'$report_indexes_id', '$generate_rule', '$user_id', '$user_excol2_e'
// ============ getting template name ==============
if($report_indexes_id != '0'){
$query_report_indexes="SELECT `index_name` FROM `report_indexes` WHERE `report_indexes_id` = '$report_indexes_id'";
                                        $result_report_indexes=mysqli_query($con, $query_report_indexes);
                                        $row_report_indexes = mysqli_fetch_array($result_report_indexes) ;      
                                        $index_name = $row_report_indexes['index_name'];
}
else 
{
    $index_name = "Manual Template";
}
// ============ END template name ==============

// ============ getting generate_rule ==============
//1: qty>0 2: qty=y/n 3: qty=real stock
if($generate_rule=='1'){
    $generate_rule1 = "Quantity more than 0";
}
if($generate_rule=='2'){
    $generate_rule1 = "Quantity In Stock: Y/N";
}
if($generate_rule=='3'){
    $generate_rule1 =  "Quantity: Shows all real numbers";
}
else{
    $generate_rule1 =  "Static Template";
}
// ============ END generate_rule ==============



//----------- Requested e-mail id ---------------------------------------------------------------------------------------
$result_request_email = mysqli_query($con, "SELECT `request_email` FROM `request_email` where `request_email_id`='2';");                    
                        $row_request_email = mysqli_fetch_array($result_request_email);
                        $request_email = $row_request_email['request_email'];


//----------- Requested e-mail id ---------------------------------------------------------------------------------------



// ============= email details ============= 
ini_set('SMTP', "exchange.jrponline.com");
//ini_set('SMTP', "exch2019.jrponline.com");
// ini_set('smtp_port', "587");
ini_set('sendmail_from', "SteveS@jrponline.com");

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: JRP Inc. <SteveS@jrponline.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

$to = "wahida@jrponline.com";
//$to = $request_email;
$subject = "JRP Datapoint - Waiting Approval!!!";
$body = "
Template Name: $index_name,<br>
Rule: $generate_rule1,<br>
Client Acc. : $user_excol2_e.<br><br>


Sincerely,<br>
JRP Management.<br><br> 
";

mail($to, $subject, $body, $headers);
  //  print("<script>window.alert('Account activation link send to customer e-mail address');</script>");
  //  print("<script>window.location='../superadmin/dashboard.php'</script>");
//On activation, you will receive a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.<br><br>

?> 
