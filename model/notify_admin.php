<?php
include ("connect.php");

$email_new = $_REQUEST['email'];
$user_excol2_new = $_REQUEST['type'];

//================= in mysql table checking for duplicate admin ============================
$user_list = mysqli_query($con, "SELECT * FROM `user` WHERE `email`='$email_new' AND `user_excol2`='$user_excol2_new'; ");
$row_user_list = mysqli_fetch_array($user_list);
$first_name_new = $row_user_list['first_name'];
$last_name_new = $row_user_list['last_name'];
$username_new = $row_user_list['username'];
$password_new = $row_user_list['password'];
$user_excol3_new = $row_user_list['user_excol3'];
$user_excol4_new = $row_user_list['user_excol4'];
$logcount  = $row_user_list['logcount'];
$flag_1 = "1";

//------ FLAG ------------


// $sql = "INSERT INTO `flags` (`jrp_account_no`, `flag_1`, `flag_2`, `flag_3`, `flag_4`, `flag_5`, `flag_6`, `flag_7`, `flag_8`) VALUES (?,?,?,?,?,?,?,?,?)";
// $stmt= $con->prepare($sql);
// $stmt->bind_param("sssssssss", $user_excol2, $flag_1, $flag_2, $flag_3, $flag_4, $flag_5, $flag_6, $flag_7, $flag_8);
// $stmt->execute();


$sql1="INSERT INTO `flags` (`flags_id`, `jrp_account_no`, `flag_1`, `flag_2`, `flag_3`, `flag_4`, `flag_5`, `flag_6`, `flag_7`, `flag_8`) 
VALUES (NULL, '$user_excol2_new', '1', '', '', '', '', '', '', '');
";

// $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());
$result2=mysqli_query($con, $sql1);

//------ END FLAG ------------

//================= in mysql table checking for duplicate admin ============================


//ini_set('SMTP', "exchange.jrponline.com");
ini_set('SMTP', "exch2019.jrponline.com");
// ini_set('smtp_port', "587");
ini_set('sendmail_from', "SteveS@jrponline.com");

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: JRP Inc. <SteveS@jrponline.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

//$to = "wahida@jrponline.com";
$to = $email_new;
$subject = "JRP Datapoint Account Activation!!!";
$body = "
Dear ".$first_name_new.",<br><br>

Your jrpdatapoint.com account is almost ready, ".$first_name_new.".<br>
To activate your account, please click the following link.<br><br>

<a href='https://www.jrpdatapoint.com/model/activate_email_admin.php?user_excol2=".$user_excol2_new."&email=".$email_new."&logcount=".$logcount."'>Account Activation Link</a><br>
Your User Name for the jrpdatapoint.com account is: ".$username_new."<br>

Sincerely,<br>
JRP Management.<br><br>
 
";

mail($to, $subject, $body, $headers);
    print("<script>window.alert('Account activation link send to account owner's e-mail address');</script>");
    print("<script>window.location='../superadmin/add_new_admin.php'</script>");

//On activation, you will receive a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.<br><br>

?> 
