<?php
include ("connect.php");

$user_id = $_REQUEST['user_id'];
$sql1=mysqli_query($con, "SELECT `user_excol2`, `first_name` FROM `user` WHERE `user_id`='$user_id'");
$row2 = mysqli_fetch_array($sql1);
    
    $user_excol2 = $row2['user_excol2'];
    $first_name = $row2['first_name'];
//if brand name is not selected----------------------------------
    if(!isset($_REQUEST['brand_name'])){
        print("<script>window.alert('Must select Brand Names From The List.');</script>");
        print("<script>window.location='../customer/request_brand.php?jrp_account_no=$user_excol2'</script>");
    }
    else
    {
//------ END FLAG ------------

//================= in mysql table checking for duplicate admin ============================

$brand_name = $_REQUEST['brand_name'];
//ini_set('SMTP', "exchange.jrponline.com");
ini_set('SMTP', "exch2019.jrponline.com");
// ini_set('smtp_port', "587");
ini_set('sendmail_from', "SteveS@jrponline.com");

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: JRP Inc. <SteveS@jrponline.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
//----------- Requested e-mail id ---------------------
$result_request_email = mysqli_query($con, "SELECT `request_email` FROM `request_email` where `request_email_id`='1';");                    
                                                $row_request_email = mysqli_fetch_array($result_request_email);
                                                $request_email = $row_request_email['request_email'];


//----------- Requested e-mail id ---------------------
//$to = "wahida@jrponline.com";
$to = $request_email;
$subject = "JRP Datapoint Brands Addition Request!";
$body1 = "
Requested Brands From: $first_name,<br /> JRP Client Account No.: $user_excol2<br><br>
List of Brands: <br>";
$brand_name_new = '';
foreach($_REQUEST['brand_name'] as $brand_name){

    $brand_name_new .= $brand_name.', ';

}
$body2 = "$brand_name_new";
$body3 = "
<br><br>
Sincerely,<br>
JRP Management.<br><br>
 
";
$body = $body1.$body2.$body3;
mail($to, $subject, $body, $headers);
    print("<script>window.alert('Request Send to the Authority!!!');</script>");
    print("<script>window.location='../customer/request_brand.php'</script>");

//On activation, you will receive a confirmation email, which will include your ftp access details for your approved daily Product Feed data from Johnston Research and Performance, Inc.<br><br>
    }
?> 
