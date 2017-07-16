
<?php

// To
$to = 'Jonathan2.Maturana@live.uwe.ac.uk';

// Subject
$subject = 'Developpez.com - Test Mail';

// Headers
$headers = 'Mime-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "\r\n";

// Message
$msg = file_get_contents('mailTemplate.php');

$mail_sent = mail($to, $subject, $msg, $headers);
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>

