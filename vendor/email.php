<html>
   
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
         // ini_set('SMTP','myserver');
         // ini_set('smtp_port',25);

//192.168.0.13 port 25
        //   ini_set('SMTP', "exchange.jrponline.com");
        //   ini_set('smtp_port', "587");
        //   ini_set('sendmail_from', "wahida@jrponline.com");
        //   $firstname = "Test";
        //   $lastname = "Test111";
        //   $to = "wahida@jrponline.com";
        //   $headers  = "MIME-Version: 1.0" . "\r\n";
        //   $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        //   $headers  .= "From: NO-REPLY<no-reply@jrponline.com>" . "\r\n";
        //   $subject = "Confirmation For Request";
        //   $message = "<html>
        //                   <body>
        //                       <p>Hi '.$firstname.' '.$lastname.'</p>
        //                       <p>
        //                           We recieved below details from you. Please use given Request/Ticket ID for future follow up:
        //                       </p>
        //                       <p>
        //                           Your Request/Ticket ID: <b>''</b>
        //                       </p>
        //                       <p>
        //                       Thanks,<br>
                              
        //                       </p>
        //                   </body>
        //               </html>";
        //   mail( $to, $subject, $message, $headers );
      
      
    //     var sClient = new SmtpClient("domain-com.mail.protection.outlook.com");
    //     var message = new MailMessage();

    //     sClient.Port = 587;
    //     sClient.EnableSsl = true;
    //     sClient.Credentials = new NetworkCredential("user", "password");
    //     sClient.UseDefaultCredentials = false;

    //     message.Body = "Test";
    //     message.From = new MailAddress("wahida@jrponline.com");
    //     message.Subject = "Test";
    //    // message.CC.Add(new MailAddress("dude@good.com"));

    //     sClient.Send(message);
//-------------------------------------------------------------------
        //   ini_set('SMTP', "192.168.0.13");
        //   ini_set('smtp_port', "587");
        //   ini_set('sendmail_from', "wahida@jrponline.com");
        //   $firstname = "Test";
        //   $lastname = "Test111";
        //   $to = "wahida@jrponline.com";
        //   $headers  = "MIME-Version: 1.0" . "\r\n";
        //   $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        //   $headers  .= "From: wahida@jrponline.com" . "\r\n";
        //   $subject = "Confirmation For Request";
        //   $message = "<html>
        //                   <body>
        //                       <p>Hi '.$firstname.' '.$lastname.'</p>
        //                       <p>
        //                           We recieved below details from you. Please use given Request/Ticket ID for future follow up:
        //                       </p>
        //                       <p>
        //                           Your Request/Ticket ID: <b>''</b>
        //                       </p>
        //                       <p>
        //                       Thanks,<br>                              
        //                       </p>
        //                   </body>
        //               </html>";
        //   mail( $to, $subject, $message, $headers );  
//=================================== Working code =======================================
/*
        ini_set('SMTP', "exchange.jrponline.com");
        // ini_set('smtp_port', "587");
        ini_set('sendmail_from', "wahida@jrponline.com");
        
        $headers =  'MIME-Version: 1.0' . "\r\n"; 
        $headers .= 'From: Your name <wahida@jrponline.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

        $to = "wahida@jrponline.com";
        $subject = "My subject";
        $body = "Hello world!";        
        mail($to, $subject, $body, $headers);
        */
//======================================working code======================================

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/phpmailer/src/Exception.php';
require 'PHPMailer/phpmailer/src/PHPMailer.php';
require 'PHPMailer/phpmailer/src/SMTP.php';

$email = new PHPMailer();
$email->SetFrom('wahida@jrponline.com', 'Your Name'); //Name is optional
$email->Subject   = 'Message Subject';
$bodytext = "Test details";
$email->Body      = $bodytext;
$email->AddAddress( 'wahida@jrponline.com' );

$file_to_attach = 'https://jrpdatapoint.com/file/';

$email->AddAttachment( $file_to_attach , 'jrp_solutions_reports.xlsx' );

return $email->Send();

//        https://jrpdatapoint.com/file/jrp_solutions_reports.xlsx





// $to = "wahida@jrponline.com";
// $subject = "My subject";
// $txt = "Hello world!";
// $headers = "From: wahida@jrponline.com" . "\r\n" .
// "CC: somebodyelse@example.com";

// mail($to,$subject,$txt,$headers);



      ?>      
   </body>
</html>