<?php
function send_mail($subject,$body){

require 'plugins/phpMailer/PHPMailerAutoload.php';
global  $send_email;

$mail = new PHPMailer;

$mail->CharSet = $send_email['charset'];                  // Nhớ thêm
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $send_email['smtp_host'];  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $send_email['smtp_user'];                 // SMTP username
$mail->Password = $send_email['smtp_pass'];                           // SMTP password
$mail->SMTPSecure = $send_email['protocol'];                            // Enable TLS encryption, ssl also accepted
$mail->Port = $send_email['smtp_port'];                                    // TCP port to connect to

$mail->setFrom($send_email['smtp_user'], 'Thời trang Sport');
$mail->addAddress('hanghia04051999@gmail.com', 'Hà Thi Nghĩa');     // Add a recipient
$mail->addAddress('hanghia04051999@gmail.com');               // Name is optional
$mail->addReplyTo($send_email['smtp_user'], 'Hà Nghĩa');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $body;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    return FALSE;
} else {
    echo 'Message has been sent';
    return TRUE;
}
}