<?php
include ("../model/connect.php");

$email = $_REQUEST['email'];
$user_excol2 = $_REQUEST['user_excol2'];

$sql1=mysqli_query($con, "SELECT COUNT(*) as 'matched' FROM `user` WHERE `email`= '$email' AND `user_excol2`='$user_excol2'");
$row = mysqli_fetch_array($sql1);
    $matched = $row['matched'];
    
    if($matched == FALSE){
        print("<script>window.alert('Sorry provided information does not match with our records, try agaian!!!');</script>"); 
        print("<script>window.location='../customer/reset_password_email.php'</script>");
    }
    else if($matched >'0'){

        //----------- name -----------------
        $sql2=mysqli_query($con, "SELECT `first_name`, `last_name` FROM `user` WHERE `user_excol2`='$user_excol2'");
        $row2 = mysqli_fetch_array($sql2);
        $first_name = $row2['first_name'];
        $last_name = $row2['last_name'];
        //------------ End of name --------------



        
        //ini_set('SMTP', "exchange.jrponline.com");
        ini_set('SMTP', "exch2019.jrponline.com");
        // ini_set('smtp_port', "587");
        ini_set('sendmail_from', "SteveS@jrponline.com");

        $headers =  'MIME-Version: 1.0' . "\r\n"; 
        $headers .= 'From: JRP Inc. <SteveS@jrponline.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

        //$to = "wahida@jrponline.com";    
        $to = $email;
        $subject = "JRP Datapoint Password Reset Link";
        $body = "

        <p>Hello ".$first_name." ".$last_name.",</p>
        <p>A request has been received to change the paassword for your JRP Datapoint account.</p>
        <p>
        <strong><a href='https://www.jrpdatapoint.com/customer/change_password_before_login.php?user_excol2=".$user_excol2."&email=".$email."'>Reset Password</a></strong></p>
        <p>If you did not initiate this request, please contact us at SteveS@jrponline.com.</p>
        <p>Thank you,<br>
        JRP Datapoint Team.</p>
        ";

            mail($to, $subject, $body, $headers);
            print("<script>window.alert('Account activation link send to your e-mail address');</script>");
            print("<script>window.location='../index.php'</script>");

    }
    
    else{
        print("<script>window.alert('System error, please contact with system administrator!!!');</script>");
        print("<script>window.location='../reset_password_email.php'</script>");
    }
?>