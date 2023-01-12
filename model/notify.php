<?php
include ("connect.php");

$email = $_REQUEST['email'];
$user_excol2 = $_REQUEST['type'];

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
$flag_1 = "1";

//------ FLAG ------------


// $sql = "INSERT INTO `flags` (`jrp_account_no`, `flag_1`, `flag_2`, `flag_3`, `flag_4`, `flag_5`, `flag_6`, `flag_7`, `flag_8`) VALUES (?,?,?,?,?,?,?,?,?)";
// $stmt= $con->prepare($sql);
// $stmt->bind_param("sssssssss", $user_excol2, $flag_1, $flag_2, $flag_3, $flag_4, $flag_5, $flag_6, $flag_7, $flag_8);
// $stmt->execute();


$sql1="INSERT INTO `flags` (`flags_id`, `jrp_account_no`, `flag_1`, `flag_2`, `flag_3`, `flag_4`, `flag_5`, `flag_6`, `flag_7`, `flag_8`) 
        VALUES (NULL, '$user_excol2', '1', '', '', '', '', '', '', '');";
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

$to = "wahida@jrponline.com";
//$to = $email;
$subject = "JRP Datapoint Account Activation!!!";
$body = "
Dear ".$first_name.",<br><br>

Your jrpdatapoint.com account is almost ready, ".$first_name.".<br>
To activate your account, please click the following link.<br><br>

<a href='https://www.jrpdatapoint.com/model/activate_email.php?user_excol2=".$user_excol2."&email=".$email."&logcount=".$logcount."'>Account Activation Link</a><br>
Your User Name for the jrpdatapoint.com account is: ".$username."<br>

Sincerely,<br>
JRP Management.<br><br>
 
";

mail($to, $subject, $body, $headers);
    print("<script>window.alert('Account activation link send to customer e-mail address');</script>");
    print("<script>window.location='../superadmin/dashboard.php'</script>");
//On activation, you will receive a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.<br><br>

?> 
