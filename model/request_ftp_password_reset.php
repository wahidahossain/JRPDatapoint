<?php
include ("connect.php");

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$jrp_account_no = $_REQUEST['jrp_account_no'];

//================= in mysql table checking for duplicate admin ============================


//ini_set('SMTP', "exchange.jrponline.com");
ini_set('SMTP', "exch2019.jrponline.com");
// ini_set('smtp_port', "587");
ini_set('sendmail_from', "SteveS@jrponline.com");

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: JRPDatapoint Inc.' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

//$to = "wahida@jrponline.com";
//----------- Requested e-mail id ---------------------
$result_request_email = mysqli_query($con, "SELECT `request_email` FROM `request_email` where `request_email_id`='1';");                    
                                                $row_request_email = mysqli_fetch_array($result_request_email);
                                                $request_email = $row_request_email['request_email'];


//----------- Requested e-mail id ---------------------
//$to = "wahida@jrponline.com";
$to = $request_email;


$subject = "JRPDatapoint FTP Password Reset Request!!!";
$body = "
Requested By (JRP Acc no.)".$jrp_account_no.",<br />
Client e-mail address: ".$email.",<br />
Requested Password:".$password."<br /><br />
 
";

mail($to, $subject, $body, $headers);
    print("<script>window.alert('FTP password reset request send to JRPDatapoint authority');</script>");
    print("<script>window.location='../customer/dashboard.php'</script>");

//On activation, you will receive a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.<br><br>

?> 
