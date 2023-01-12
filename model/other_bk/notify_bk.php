<?php
include ("connect.php");

//$email = $_REQUEST['email'];
$user_excol2 = $_REQUEST['type'];

//================= in mysql table checking for duplicate admin ============================
$user_list = mysqli_query($con, "SELECT * FROM `user` WHERE `user_excol2`='$user_excol2'; ");
$row_user_list = mysqli_fetch_array($user_list);
$first_name = $row_user_list['first_name '];
$last_name = $row_user_list['last_name'];
$username = $row_user_list['username'];
$password = $row_user_list['password'];
$user_excol3 = $row_user_list['user_excol3'];
$user_excol4 = $row_user_list['user_excol4'];
$logcount  = $row_user_list['logcount'];
//================= in mysql table checking for duplicate admin ============================


ini_set('SMTP', "exchange.jrponline.com");
// ini_set('smtp_port', "587");
ini_set('sendmail_from', "SteveS@jrponline.com");

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: JRP Inc. <SteveS@jrponline.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

//$to = "wahida@jrponline.com";
$to = $email = "wahida@jrponline.com";
$subject = "JRP Datapoint Account Activation!!!";
$body = "
Dear ".$first_name." ".$last_name.",

Your jrpdatapoint.com account is almost ready, ".$first_name.".
To activate your account, please click the following link.
<a href='http://localhost/jrpdatapoint/client_application/model/activate_email.php?user_excol2=".$user_excol2."&email=".$email."&logcount=".$logcount."'>Account Activation Link</a><br>

Your User Name for the jrpdatapoint.com account is: ".$username."
On activation, you will recieve a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.

Sincerely,
JRP Management











Login Information:<br>
    UserName: ".$username."<br>
    FTP Login Information:<br>
    UserName: ".$user_excol3."<br>
    Password: ".$user_excol4."<br>
Please click the link below to activate your JRP Datapoint account <br>
<a href='http://localhost/jrpdatapoint/client_application/model/activate_email.php?user_excol2=".$user_excol2."&email=".$email."&logcount=".$logcount."'>Client Account Activation Link</a><br>
Thank you <br>
        JRP Datapoint Team. (JRP Online Inc.) <br>
        Contact us for more information.<br>
        Address:<br>
        Phone: 
";

mail($to, $subject, $body, $headers);
    print("<script>window.alert('Account activation link send to customer e-mail address');</script>");
    print("<script>window.location='../superadmin/dashboard.php'</script>");

?> 
