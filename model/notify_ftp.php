<?php
include ("connect.php");

//$email = $_REQUEST['email'];
$user_excol2 = $_REQUEST['user_excol2'];

//================= in mysql table checking for duplicate admin ============================
$user_list = mysqli_query($con, "SELECT * FROM `user` WHERE `user_excol2`='$user_excol2'; ");
$row_user_list = mysqli_fetch_array($user_list);
$first_name = $row_user_list['first_name'];
$last_name = $row_user_list['last_name'];
$username = $row_user_list['username'];
$password = $row_user_list['password'];
$user_excol3 = $row_user_list['user_excol3'];
$user_excol4 = $row_user_list['user_excol4'];
$logcount  = $row_user_list['logcount'];
//================= in mysql table checking for duplicate admin ============================


//ini_set('SMTP', "exchange.jrponline.com");
ini_set('SMTP', "exch2019.jrponline.com");
// ini_set('smtp_port', "587");
ini_set('sendmail_from', "SteveS@jrponline.com");

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: JRP Inc. <SteveS@jrponline.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

//$to = "wahida@jrponline.com";
$to = $email = "wahida@jrponline.com";
$subject = "JRP Datapoint Account Activation!!!";
$body = "Dear ".$first_name.",<br><br>

Your Account Activation for JRPDatapoint.com was successful, and will allow you limited control over your daily Product Feeds from JRP.<br>
Admin Site URL: https://jrpdatapoint.com<br><br>

Note: Access to your Product feed file is done via FTP.<br>
Please find below your FTP account information, which can be shared with your Data team for automating receipt of the daily JRP Product feeds:<br><br>


Domain name: ftp.jrpdatapoint.com<br>
Port: 21<br>
UserName: ".$user_excol3."<br>
Password: ".$user_excol4."<br><br>

For logging into 'ftp.jrpdatapoint.com' please use whichever FTP Client software is preferred by your organisation e.g. Filezilla, CuteFTP, custom Coding etc.<br>
Note: As an alternative, the feed file(s) may also be downloaded manually from within your login to the Admin Site: https://jrpdatapoint.com<br><br>


Sincerely,<br>
JRP Management.<br><br>
";

mail($to, $subject, $body, $headers);
    print("<script>window.alert('Password reset successful, Check your e-mail for FTP access information');</script>");
    print("<script>window.location='../index.php'</script>");

?> 
