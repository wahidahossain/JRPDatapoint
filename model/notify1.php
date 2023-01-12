<?php
include ("connect.php");
//================= in mysql table checking for duplicate admin ============================


//ini_set('SMTP', "exchange.jrponline.com");
//ini_set('SMTP', "exch2019.jrponline.com");
// ini_set("SMTP","exch2019.jrponline.com");
// // ini_set('smtp_port', "587");
// ini_set('sendmail_from', "info@jrpdatapoint.com");



// // ini_set("SMTP","http://ns1.easysoftco.com");
// // ini_set("sendmail_from","info@saj.ir");
// $headers= 'MIME-Version: 1.0' . "\r\n";
// $headers.= 'Content-type: text/html; charset=utf8' . "\r\n";
// //$headers .= 'From: www.saj.ir' . "\r\n";



// $headers =  'MIME-Version: 1.0' . "\r\n"; 
// $headers .= 'From: JRP Inc. <info@jrpdatapoint.com>' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

// $to = "eng.wahida.hossain@gmail.com";
// //$to = $email;
// $subject = "JRP Datapoint Account Activation!!!";
// $body = "
// Thank you
 
// ";

// mail($to, $subject, $body, $headers);
  //  print("<script>window.alert('Account activation link send to customer e-mail address');</script>");
 //   print("<script>window.location='../superadmin/dashboard.php'</script>");
//On activation, you will receive a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.<br><br>

$emailFrom = "SteveS@jrponline.com"; // match this to the domain you are sending email from
$email = "eng.wahida.hossain@gmail.com";
$subject = "Email Request";
$headers = 'From:' . $emailFrom . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Return-path: " . $email;
 $message = "Your password is ";
mail($email, $subject, $message, $headers);


?> 
